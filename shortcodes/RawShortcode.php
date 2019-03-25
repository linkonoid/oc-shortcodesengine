<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Thunder\Shortcode\EventHandler\FilterRawEventHandler;
use Thunder\Shortcode\Events;

class RawShortcode extends Shortcode
{

    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function init()
    {
        $this->manager->getHandlers()->add('raw', function(ShortcodeInterface $sc) {
            return trim($sc->getContent());
        });

        $this->manager->getEvents()->addListener(Events::FILTER_SHORTCODES, new FilterRawEventHandler(array('raw')));
    }
}
