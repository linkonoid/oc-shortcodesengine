<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class FlashShortcode extends Shortcode
{
    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
        //$this->manager->addAssets('js','/modules/system/assets/ui/storm.js');
        //$this->manager->addAssets('css','/modules/system/assets/ui/storm.css');
        //$this->manager->addAssets('js','/modules/system/assets/ui/js/foundation.baseclass.js');
        //$this->manager->addAssets('js','/modules/system/assets/ui/js/foundation.controlutils.js');
        //$this->manager->addAssets('css','/modules/system/assets/ui/less/global.less');
        //$this->manager->addAssets('css','/modules/system/assets/ui/less/icon.close.less');
        $this->manager->addAssets('css','/modules/system/assets/ui/less/flashmessage.less');
        $this->manager->addAssets('js','/modules/system/assets/ui/js/flashmessage.js');
    }

    public function init()
    {

        $this->manager->getHandlers()->add('flash', function(ShortcodeInterface $sc) {

            $load = $sc->getParameter('load', $sc->getBbCode());
            $type = $sc->getParameter('type', $sc->getBbCode());
            $interval = $sc->getParameter('interval', $sc->getBbCode());

            switch ($load) {
                case 'static':
                    $data = 'class="flash-message static '.(!empty($type) ? $type : '').'"';
                    break;
                case 'onload':
                    $data = 'class="'.(!empty($type) ? $type : '').'" data-control="flash-message" data-interval="'.(!empty($interval) ? $interval : '').'"';
                    break;
            }

            return '<p '.$data.'>'.$sc->getContent().'</p>';

        });
    }
}