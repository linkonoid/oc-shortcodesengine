<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class UnderlineShortcode extends Shortcode
{

    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function init()
    {
        $this->manager->getHandlers()->add('u', function(ShortcodeInterface $shortcode) {
            return '<span style="text-decoration: underline;">'.$shortcode->getContent().'</span>';
        });
    }
}