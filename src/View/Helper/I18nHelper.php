<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\Http\ServerRequest;
use Cake\View\Helper;

/**
 * I18n helper
 */
class I18nHelper extends Helper
{
    public array $helpers = ['Url', 'Html'];
    /**
     * Default configuration.
     *
     * @var array
     */
    protected array $_defaultConfig = [];

    protected ServerRequest $request;

    public function initialize(array $config): void
    {
        $this->request = $this->_View->getRequest();
    }

    public function changeLocaleUri($locale = 'ru')
    {
        $path = $this->request->getPath();
        $query = $this->request->getQuery();

        $path = substr_replace($path, $locale, 1, 2);

        return $query ? $path . '?' . $query : $path;
    }

    public function titleLocale($locale = null)
    {
        if (null === $locale) {
            $locale = $this->request->getParam('lang');
        }

        switch($locale) {
            case 'ru':
                return 'Русский';
            case 'en':
                return 'English';
            case 'uz':
                return 'O\'zbek';
        }
    }
}
