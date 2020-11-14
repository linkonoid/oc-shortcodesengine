<?php namespace Linkonoid\ShortcodesEngine;

use Less_Parser;
use Event;
use Response;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;
use Linkonoid\ShortcodesEngine\Classes\ShortcodesManager;
use Linkonoid\ShortcodesEngine\Classes\Shortcode;
use Linkonoid\ShortcodesEngine\Classes\ShortcodeObject;

/**
 * @package linkonoid\shortcodesEngine
 * @author Max Barulin (https://github.com/linkonoid)
 */

class Plugin extends PluginBase
{

    protected $shortcodesManager;
	
    protected $shortcodeHandlersIsInit;

    /**
     * @var array Plugin dependencies
     */
    public $require = [];

    public function pluginDetails()
    {
        return [
            'name' => 'ShortcodesEngine',
            'description' => 'Shortcodes engine for OctoberCMS',
            'author' => 'Linkonoid',
			'icon' => 'icon-code',
			'homepage'    => 'https://github.com/linkonoid'
        ];
    }

    public function registerPermissions()
    {
 	return [
            'linkonoid.shortcodesengine.access_settings'  => [
            'tab'   => 'linkonoid.shortcodesengine::lang.plugin.settings.permissions.tab',
            'label' => 'linkonoid.shortcodesengine::lang.plugin.settings.permissions.label',
		],
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'linkonoid.shortcodesengine::lang.plugin.settings.label',
                'description' => 'linkonoid.shortcodesengine::lang.plugin.settings.description',
                'category' => 'Shortcodes',
                'icon' => 'icon-code',
                'class' => 'Linkonoid\ShortcodesEngine\Models\Settings',
				'keywords' => 'linkonoid.shortcodesengine::lang.plugin.settings.keywords',
                'order' => 550,
                'permissions' => ['linkonoid.shortcodesengine.access_settings']
            ]
        ];
	}

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'shortcodes' => [$this->shortcodesManager, 'processshortcodes']
            ]
        ];
    }
 
    public function boot()
    {
        $shortcodesManager = $this->shortcodesManager = new shortcodesManager();

        Event::listen('cms.page.init', function ($controller, $page) {
            $this->shortcodesManager->resetObjects();
            $this->shortcodesManager->resetAssets();
            if(!$this->shortcodeHandlersIsInit){
                Event::fire('linkonoid.shortcodesengine.onshortcodeHandlers',[$this->shortcodesManager]);
                $this->shortcodeHandlersIsInit = true;
            }
        });

        Event::listen('linkonoid.shortcodesengine.onshortcodeHandlers', function () {
            $this->shortcodesManager->registerUsershortcodes();
            $this->shortcodesManager->registerAllshortcodes(__DIR__.'/shortcodes');
        });

        Event::listen('cms.page.start', function ($controller) {
            $shortcode_assets = $this->shortcodesManager->getAssets();
            if (!empty($shortcode_assets)) {
                if (array_key_exists('css',$shortcode_assets)) foreach ($shortcode_assets['css'] as $key => $value) if (!empty($value)) $controller->addCss($value,'core');
                if (array_key_exists('js',$shortcode_assets)) foreach ($shortcode_assets['js'] as $key => $value) if (!empty($value)) $controller->addJs($value);
                //plugins/linkonoid/shortcodesengine/assets/js/test.js  - alert test function
            }
        });

		Event::listen('cms.page.postprocess', function ($controller, $url, $page, $dataHolder) {
		    $dataHolder->content = $this->shortcodesManager->processContent($dataHolder->content);
		});
   }
}
