<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class FontAwesomeButtonShortcode extends Shortcode
{
 
    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function init()
    {
        $this->manager->getHandlers()->add('fa-button', function(ShortcodeInterface $sc) {
           
            $icon = $sc->getParameter('icon');
            $size = $sc->getParameter('size');
            $href = $sc->getParameter('href');
            $output = '<a class="btn btn-primary'.((!empty($icon)) ? ' icon-'.$icon : '' ).((!empty($size)) ? ' icon-'.$size.'"' : '"' ).((!empty($href)) ? ' href='.$href : '' ).'>'.$sc->getContent().'</a>';

            return $output;
        });	
    } 
}