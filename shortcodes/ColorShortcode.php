<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class ColorShortcode extends Shortcode
{
    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function init()
    {
        $this->manager->getHandlers()->add('color', function(ShortcodeInterface $sc) {
            $color = $sc->getParameter('color', $sc->getBbCode());
            return '<span style="color: '.$color.';">'.$sc->getContent().'</span>';
        });
    }
}