<?php
declare(strict_types=1);

namespace Frontend\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Template helper
 */
class TemplateHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected array $_defaultConfig = [];

    public function headerList()
    {
        return [
            HEADER_THEME_LIGHT => __('Light'),
            HEADER_THEME_GRAY => __('Gray'),
            HEADER_THEME_ABSOLUTE => __('Absolute'),
            HEADER_THEME_PRIMARY => __('Primary')
        ];
    }
}
