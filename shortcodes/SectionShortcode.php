<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class SectionShortcode extends Shortcode
{

    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function init()
    {
        $this->manager->getHandlers()->add('section', function(ShortcodeInterface $sc) {
            $name = $sc->getParameter('name');
            $object = new ShortcodeObject($name, $sc->getContent());
            $this->shortcode->addObject($sc->getName(), $object);
        });
    }
}
