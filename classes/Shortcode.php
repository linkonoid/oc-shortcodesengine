<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

/**
 * @package linkonoid\shortcodesEngine
 * @author Max Barulin (https://github.com/linkonoid)
 */

class Shortcode
{
    protected $manager;

    public function __construct()
    {
    }

    public function init()
    {
        $this->manager->handlers->add('u', function(ShortcodeInterface $sc) {
            return strtoupper($sc->getContent());
        });
    }

    public function getName()
    {
        return get_class($this);
    }

}
