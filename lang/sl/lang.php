<?php return [

    'plugin' => [           
        'name' =>'ShortcodesEngine',
        'description' => 'Shortcodes pogon za OctoberCMS',
        'settings' => [
            'label' => 'ShortcodesEngine nastavitve',
            'description' => 'ShortcodesEngine konfiguracija vtičnika',
            'category' => 'Shortcodes',
            'keywords' => 'shortcodes, short, code, engine, BBCode, plugin, settings',
            'permissions' => [
                'tab'   => 'Dovoljenja za nastavitve vtičnika ShortcodesEngine',
                'label' => 'Prikaži zavihek nastavitve vtičnika ShortcodesEngine v nadzorni plošči',
            ],
        ],
    ], 

    'settings' => [
        'parser' => [
            'tab' => 'Nastavitve razčlenjevalnika',
            'parser' => 'Tip razčlenjevalnika',
            'syntax_opening_tag' => 'Začetna oznaka (privzeta sintaksa: [tag parameter="value"]data[/tag])',
            'syntax_closing_tag' => 'Zaključna oznaka (privzeta sintaksa: [tag parameter="value"]data[/tag])',
            'syntax_closing_tag_marker' => 'Simbol zaključne oznake (privzeta sintaksa: [tag parameter="value"]data[/tag])',
            'syntax_parameter_value_separator' => 'Ločilnik vrednosti parametra (privzeta sintaksa: [tag parameter="value"]data[/tag])',
            'syntax_parameter_value_delimiter' => 'Mejnik vrednosti parametra (privzeta sintaksa: [tag parameter="value"]data[/tag])',
        ],    
        'usershortcodes' => [
            'tab' => 'Uporabniške kratke kode',
            'promt' => 'Dodaj novo kratko kodo',
            'shortcode_name' => 'Ime kratke kode',
            'shortcode_unique_code' => 'Edinstvena koda kratke kode',
            'shortcode_values_promt' => 'Dodaj novo vrednost',
            'shortcode_value_name' => 'Ime funkcijskega parametra kratke kode',
            'shortcode_value_default' => 'Privzeta vrednost funkcijskega parametra kratke kode',
            'shortcode_code' => 'PHP koda funkcije kratke kode (samo jedro): return function unique_code($data,$par1,$par2...) {...}',
            'shortcode_assets' => 'Povezave do sredstev kratke kode (vsaka povezava v novi vrstici)',
        ],
    ],

];