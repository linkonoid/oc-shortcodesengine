<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class DivShortcode extends Shortcode
{

    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function init()
    {
        $this->manager->getHandlers()->add('div', function(ShortcodeInterface $sc) {
            $id = $sc->getParameter('id');
            $class = $sc->getParameter('class');
            $style = $sc->getParameter('style');

            $id_output = $id ? ' id="' . $id . '" ': '';
            $class_output = $class ? ' class="' . $class . '"' : '';
            $style_output = $style ? ' style="' . $style . '"' : '';
            return '<div ' . $id_output . $class_output . $style_output . '>'.$sc->getContent().'</div>';
        });
    }
}
