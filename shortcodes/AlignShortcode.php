<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class AlignShortcode extends Shortcode
{
    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function init()
    {
        $this->manager->getHandlers()->add('center', function(ShortcodeInterface $sc) {
            return '<div style="text-align: center;">'.$sc->getContent().'</div>';
        });

        $this->manager->getHandlers()->add('left', function(ShortcodeInterface $sc) {
            return '<div style="text-align: left;">'.$sc->getContent().'</div>';
        });

        $this->manager->getHandlers()->add('right', function(ShortcodeInterface $sc) {
            return '<div style="text-align: right;">'.$sc->getContent().'</div>';
        });
    }
}