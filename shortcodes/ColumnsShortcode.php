<?php namespace Linkonoid\ShortcodesEngine\Classes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;
//use Thunder\Shortcode\Shortcode\ProcessedShortcode;

class ColumnsShortcode extends Shortcode
{
    public function __construct($manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function init()
    {
        $this->manager->getHandlers()->add('columns', function(ShortcodeInterface $sc) {

            $column_count = intval($sc->getParameter('count', 2));
            $column_width = $sc->getParameter('width', 'auto');
            $column_gap = $sc->getParameter('gap', 'normal');
            $column_rule = $sc->getParameter('rule', false);

            $css_style = 'columns:' . $column_count . ' ' . $column_width . ';-moz-columns:' . $column_count . ' ' . $column_width . ';';
            $css_style .= 'column-gap:' . $column_gap . ';-moz-column-gap:' . $column_gap . ';';

            if ($column_rule) {
                $css_style .= 'column-rule:' . $column_rule . ';-moz-column-rule:' . $column_rule . ';';
            }

            return '<div class="sc-columns" style="'.$css_style.'">'.$sc->getContent().'</div>';
        });

    }
}