<?php namespace Linkonoid\ShortcodesEngine\Models;

use Lang;
use Model;
use Event;
use Backend;
use BackendAuth;
use Backend\Classes\NavigationManager;
use Backend\FormWidgets\Repeater;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

/**
 * @package linkonoid\shortcodesEngine
 * @author Max Barulin (https://github.com/linkonoid)
 */ 

class Settings extends Model
{   
    public $implement = ['System.Behaviors.SettingsModel'];
    public $settingsCode = 'linkonoid_shortcodeEngine_settings';
    public $settingsFields = 'fields.yaml';

    public function __construct() {
        parent::__construct();        	       
    }  
}