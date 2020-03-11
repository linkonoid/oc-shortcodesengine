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
        $this->manager->getHandlers()->add('flag', function(ShortcodeInterface $sc) {
            $flag = $sc->getParameter('flag', $sc->getBbCode());
            return '<i class="flag-'.$flag.' oc-flag-squared">'.$sc->getContent().'</i>';
        });


    }
}
