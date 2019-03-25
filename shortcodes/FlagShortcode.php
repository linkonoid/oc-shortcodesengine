<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class FlagShortcode extends Shortcode
{

    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function init()
    {
        $this->manager->getHandlers()->add('flag', function(ShortcodeInterface $shortcode) {
            $flag = $sc->getParameter('flag');
            return '<i class="flag-'.$flag.'">'.$shortcode->getContent().'</i>';
        });
        

    }
}
