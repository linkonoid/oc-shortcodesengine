<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class SizeShortcode extends Shortcode
{

    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function init()
    {
        $this->manager->getHandlers()->add('size', function(ShortcodeInterface $sc) {
            $size = $sc->getParameter('size', $sc->getBbCode());
            return '<span style="font-size: '.$size.'px;">'.$sc->getContent().'</span>';
        });
    }
}
