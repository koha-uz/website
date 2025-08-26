<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\EventInterface;
use Cake\Core\App;

/**
 * SystemicPages Controller
 *
 * @property \App\Model\Table\SystemicPagesTable $SystemicPages
 *
 * @method \App\Model\Entity\SystemicPage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SystemicPagesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('SystemicPagesComponent', [
            'className' => 'SystemicPages'
        ]);
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    public function display()
    {
        $this->SystemicPagesComponent->setupPage();
    }

    public function robots()
    {
        $this->request->addDetector('extTxt', function ($request) {
            return $request->getParam('_ext') === 'txt';
        });

        if (!$this->request->is('extTxt')) {
            throw new RecordNotFoundException(__('Page not found'));
        }
    }

    public function sitemap()
    {
        $pages = $this->getTableLocator()->get('Pages')->find('published');
        $posts = $this->getTableLocator()->get('Posts')->find('public');
        $this->set(compact('pages', 'posts'));
    }
}
