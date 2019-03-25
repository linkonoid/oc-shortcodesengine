<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class LoaderShortcode extends Shortcode
{
    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager; 
 
        $this->manager->addAssets('js','/modules/system/assets/ui/js/foundation.baseclass.js');
        $this->manager->addAssets('js','/modules/system/assets/ui/js/foundation.controlutils.js');
        $this->manager->addAssets('css','/modules/system/assets/ui/less/global.less'); 
        $this->manager->addAssets('css','/modules/system/assets/ui/less/loader.less');  
        $this->manager->addAssets('js','/modules/system/assets/ui/js/loader.base.js');
        //$this->manager->addAssets('js','/modules/system/assets/ui/js/loader.stripe.js');
        //$this->manager->addAssets('js','/modules/system/assets/ui/js/loader.cursor.js');     
    }

    public function init()
    {
        $this->manager->getHandlers()->add('loader', function(ShortcodeInterface $sc) {

            $position = $sc->getParameter('position', $sc->getBbCode());
            $size = $sc->getParameter('size', $sc->getBbCode());          

            return '<div class="loading-indicator-container">
                        <div class="loading-indicator indicator-'.$position.' size-'.$size.'">
                            <span></span>
                            <div>'.$sc->getContent().'</div>
                        </div>
                    </div>';
        });
    }
}