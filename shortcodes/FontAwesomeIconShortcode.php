<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class FontAwesomeIconShortcode extends Shortcode
{

    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function init()
    {
        $this->manager->getHandlers()->add('fa-icon', function(ShortcodeInterface $sc) {
           
            $icon = $sc->getParameter('icon');
			$size = $sc->getParameter('size');
            $output = '<i class="icon-'.$icon.' icon-'.$size.'">'.$sc->getContent().'</i>';

            return $output;

        });
    }
}
