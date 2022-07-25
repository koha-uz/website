<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Http\Exception\InternalErrorException;

/**
 * SystemicPages component
 */
class SystemicPagesComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function setupPage()
    {
        $controller = $this->getController()->getRequest()->getParam('controller');
        $action = $this->getController()->getRequest()->getParam('action');

        $page = $this->getController()->getTableLocator()->get('SystemicPages')
            ->find('byNotation', [
                'notation' => "{$controller}.{$action}"
            ])
            ->contain('MetaTags.Image')
            ->firstOrFail();

        $this->getController()->set('page', $page);
    }
}
