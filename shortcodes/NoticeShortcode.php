<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class NoticeShortcode extends Shortcode
{

    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
        $this->manager->addAssets('css', '/plugins/linkonoid/shortcodesengine/assets/css/shortcode-notice.css');
    }

    public function init()
    {
        $this->manager->getHandlers()->add('notice', function(ShortcodeInterface $sc){         
            $type = $sc->getParameter('notice', $sc->getBbCode()) ?: 'info';
            return '<div class="sc-notice '.$type.'"><div>'.$sc->getContent().'</div></div>';
        });
    }
}
