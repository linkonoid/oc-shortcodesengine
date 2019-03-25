<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class SpanShortcode extends Shortcode
{

    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function init()
    {
		$this->manager->getHandlers()->add('span', function(ShortcodeInterface $sc) {
			$id = $sc->getParameter('id');
			$class = $sc->getParameter('class');

			$id_output = $id ? 'id="' . $id . '" ': '';
			$class_output = $class ? 'class="' . $class . '"' : '';
			return '<span ' . $id_output . ' ' . $class_output . '>'.$sc->getContent().'</span>';
		});		
    }
}
