<?php return [

    'plugin' => [           
        'name' =>'Движок шорткодов',
        'description' => 'Движок шорткодов для OctoberCMS',        
        'settings' => [
            'label' => 'Настройки шорткодов',            
            'description' => 'Конфигурация и настройка ядра плагина шорткодов',
            'category' => 'Короткие коды',
            'keywords' => 'shortcodes, short, code, engine, BBCode, plugin, settings',
            'permissions' => [
                'tab'   => 'Разрешения для плагина шорткодов',
                'label' => 'Показывать вкладку настроек плагина шорткодов в панели администрирования', 
            ],  
        ],
    ], 

    'settings' => [
        'parser' => [
            'tab' => 'Настройки парсера',
            'parser' => 'Тип парсера',
            'syntax_opening_tag' => 'Открывающий тег (default syntax: [tag parameter="value"]data[/tag])',
            'syntax_closing_tag' => 'Закрывающий тег (default syntax: [tag parameter="value"]data[/tag])',      
            'syntax_closing_tag_marker' => 'Закрывающий маркер тега (default syntax: [tag parameter="value"]data[/tag])',
            'syntax_parameter_value_separator' => 'Сепаратор значений параметров (default syntax: [tag parameter="value"]data[/tag])',                         
            'syntax_parameter_value_delimiter' => 'Разделитель значений параметров (default syntax: [tag parameter="value"]data[/tag])',
        ],    
        'usershortcodes' => [
            'tab' => 'Мои шорткоды',
            'promt' => 'Добавить новый шорткод',
            'shortcode_name' => 'Название шорткода',
            'shortcode_unique_code' => 'Уникальный код шорткода',
            'shortcode_values_promt' => 'Добавить новый параметр',
            'shortcode_value_name' => 'Наименование параметра для функции коротких кодов',           
            'shortcode_value_default' => 'Значение по умолчанию',
            'shortcode_code' => 'Код PHP-функции для шорткода (только тело): return function unique_code($data,$par1,$par2...) {...}',
            'shortcode_assets' => 'Файлы js-скриптов и css для шорткода (все ссылки с новой строки)',
        ],
    ],

];