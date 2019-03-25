<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\EventContainer\EventContainer;
use Thunder\Shortcode\HandlerContainer\HandlerContainer;
use Thunder\Shortcode\Processor\Processor;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Thunder\Shortcode\Syntax\CommonSyntax;
use Thunder\Shortcode\Syntax\Syntax;
use Thunder\Shortcode\Syntax\SyntaxBuilder;
use DirectoryIterator;
use ApplicationException;
use Linkonoid\ShortcodesEngine\Models\Settings;

/**
 * @package linkonoid\shortcodesEngine
 * @author Max Barulin (https://github.com/linkonoid)
 */

class ShortcodesManager
{
    protected $handlers;
    protected $events;
    protected $states;
    protected $assets;
    protected $objects;
    protected $parser;

    public function __construct()
    {
        $this->handlers = new HandlerContainer;
        $this->events = new EventContainer;
        $this->states = [];
        $this->assets = [];
        $this->objects = [];
        $this->parser = !empty($this->getParser(Settings::instance()->get('parser'))) ? $this->getParser(Settings::instance()->get('parser')) : 'regex';
        $this->syntax = !empty(Settings::instance()->get('syntax_opening_tag')) ? new Syntax(
            Settings::instance()->get('syntax_opening_tag'),
            Settings::instance()->get('syntax_closing_tag'),
            Settings::instance()->get('syntax_closing_tag_marker'),
            Settings::instance()->get('syntax_parameter_value_separator'),
            Settings::instance()->get('syntax_parameter_value_delimiter')
        ) : $this->syntax = new Syntax();
    }

   public function addAssets($action, $asset)
   {
       if (is_array($action)) {
           $this->assets['add'] [] = $action;
       } else {
           if (isset($this->assets[$action])) {
               if (in_array($asset, $this->assets[$action])) {
                   return;
               }
           }
           $this->assets[$action] [] = $asset;
       }
   }

   public function getAssets()
   {
       return $this->assets;
   }

   public function resetAssets()
   {
    $this->assets = [];
   }

   public function addObject($key, $object)
   {
       $new = [$object->name() => $object];
       if (array_key_exists($key, $this->objects)) {
           $current = (array)$this->objects[$key];
           $this->objects[$key] = $current + $new;
       } else {
        $this->objects[$key] = $new;
       }
   }

   public function setObjects($objects)
   {
    $this->objects = $objects;
   }

   public function getObjects() {
       return $this->objects;
   }

   public function resetObjects()
   {
    $this->objects = [];
   }

   public function getHandlers()
   {
       return $this->handlers;
   }

   public function getEvents()
   {
       return $this->events;
   }

   public function registerShortcode($name, $directory)
   {
       $path = rtrim($directory, '/').'/'.$name;
       require_once($path);
       $name = 'Linkonoid\\ShortcodesEngine\\Classes\\' . basename($name, '.php');
       if (class_exists($name)) {
            $shortcodesManager = new $name($this);
            $shortcodesManager->init();
       }
    }

   public function registerAllShortcodes($directory)
   {
        try {
            foreach (new DirectoryIterator($directory) as $file) {
                if ($file->isDot()) {
                   continue;
                }
               $this->registerShortcode($file->getFilename(), $directory);
            }
        } catch (ApplicationException $e) {
            throw new ApplicationException('ShortcodesEngine Plugin: Directory not found => ' . $directory);
        }
    }

    public function registerUserShortcodes()
    {
         if (!empty(Settings::instance()->get('shortcodes'))) try {
             foreach (Settings::instance()->get('shortcodes') as $key => $shortcode) {
                $scvalues = [];
                if (!empty($shortcode['shortcode_values'])) foreach ($shortcode['shortcode_values'] as $key => $value){
                    $scvalues += [$value['shortcode_value_name'] => $value['shortcode_value_default']];
                }
                $code = $shortcode['shortcode_code'];

                foreach (preg_split ('/\R/', $shortcode['shortcode_assets']) as $key => $asset)
                {
                    $asset = trim($asset);
                    $ext = pathinfo($asset, PATHINFO_EXTENSION);
                    if (strtolower($ext) == 'js') {
                        $this->addAssets('js',$asset);
                    } else $this->addAssets('css',$asset);
                }

                $this->getHandlers()->add($shortcode['shortcode_unique_code'], function(ShortcodeInterface $sc) use ($scvalues, $code) {
                    $data = $sc->getContent();
                    $args = '$data=\''.$data.'\'';
                    foreach ($scvalues as $key => $value){
                        if (!(${$key} = $sc->getParameter($key, $sc->getBbCode()))) ${$key} = $value;
                        $args .= ',$'.$key.'=\''.( !empty(${$key}) ? ${$key} : null ).'\'';
                    }
                    eval ('$userfunc = function('.$args.'){'.$code.'};');
                    return $userfunc();
                });
             }
         } catch (ApplicationException $e) {
             throw new ApplicationException('ShortcodesEngine Plugin: Compile user shortcode error => ' . $shortcode->shortcode_name);
         }
     }


   public function processContent($content)
   {
       if (!empty($content)) {
           $processor = new Processor(new $this->parser($this->syntax), $this->handlers);
           $processor = $processor->withEventContainer($this->events);
           return $processor->process($content);
       }
   }

   public function processShortcodes($str)
   {
        if (!empty($str)) {
            $processor = new Processor(new $this->parser($this->syntax), $this->handlers);
            return $processor->process($str);
        }
   }

   public function setStates($hash, ShortcodeInterface $shortcode)
   {
    $this->states[$hash][] = $shortcode;
   }

   public function getStates($hash)
   {
       if (array_key_exists($hash, $this->states)) {
           return $this->states[$hash];
       }
   }

   public function getId(ShortcodeInterface $shortcode)
   {
       return substr(md5($shortcode->getShortcodeText()), -10);
   }

   protected function getParser($parser)
   {
       switch($parser)
       {
           case 'regular':
               $parser = 'Thunder\Shortcode\Parser\RegularParser';
               break;
           case 'wordpress':
               $parser = 'Thunder\Shortcode\Parser\WordpressParser';
               break;
           default:
               $parser = 'Thunder\Shortcode\Parser\RegexParser';
               break;
       }
       return $parser;
   }
}
