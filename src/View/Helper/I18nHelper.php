<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\Http\ServerRequest;
use Cake\View\Helper;
use Cake\View\View;

/**
 * I18n helper
 */
class I18nHelper extends Helper
{
    public $helpers = ['Url', 'Html'];
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function changeLocaleUri($locale = 'en')
    {
        $request = new ServerRequest();
        $path = $request->getUri()->getPath();
        $query = $request->getUri()->getQuery();

        $path = substr_replace($path, $locale, 1, 2);

        return $query ? $path . '?' . $query : $path;
    }

}
