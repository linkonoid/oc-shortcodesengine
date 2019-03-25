<?php return [

    'plugin' => [           
        'name' =>'ShortcodesEngine',
        'description' => 'Shortcodes engine for OctoberCMS',        
        'settings' => [
            'label' => 'ShortcodesEngine settings',            
            'description' => 'ShortcodesEngine plugin configuration',
            'category' => 'Shortcodes',
            'keywords' => 'shortcodes, short, code, engine, BBCode, plugin, settings',
            'permissions' => [
                'tab'   => 'Permissions for ShortcodesEngine plugin settings',
                'label' => 'Show ShortcodesEngine plugin settings tab in control panel', 
            ],  
        ],
    ], 

    'settings' => [
        'parser' => [
            'tab' => 'Parser settings',
            'parser' => 'Parser type',
            'syntax_opening_tag' => 'Opening tag (default syntax: [tag parameter="value"]data[/tag])',
            'syntax_closing_tag' => 'Closing tag (default syntax: [tag parameter="value"]data[/tag])',      
            'syntax_closing_tag_marker' => 'Closing tag marker (default syntax: [tag parameter="value"]data[/tag])',
            'syntax_parameter_value_separator' => 'Parameter value separator (default syntax: [tag parameter="value"]data[/tag])',                         
            'syntax_parameter_value_delimiter' => 'Parameter value delimiter (default syntax: [tag parameter="value"]data[/tag])',
        ],    
        'usershortcodes' => [
            'tab' => 'User shortcodes',
            'promt' => 'Add new shortcode',
            'shortcode_name' => 'Shortcode name',
            'shortcode_unique_code' => 'Shortcode unique code',
            'shortcode_values_promt' => 'Add new value',
            'shortcode_value_name' => 'Shortcode function parameter name',           
            'shortcode_value_default' => 'Shortcode function parameter default value',
            'shortcode_code' => 'Shortcode PHP function code (only body): return function unique_code($data,$par1,$par2...) {...}',
            'shortcode_assets' => 'Shortcode assets links (all links from a new line)',
        ],
    ],

];