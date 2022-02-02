<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\EventInterface;
use Cake\Core\App;
use Cake\Core\Configure;

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
        $this->loadComponent('SystemicPages');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    public function display()
    {
        //$result = $this->Authentication->getResult();
        $this->SystemicPages->setupPage();
    }

    public function sitemap()
    {
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
}
