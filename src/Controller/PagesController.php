<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;

/**
 * Pages Controller
 *
 * @property \App\Model\Table\PagesTable $Pages
 *
 */
class PagesController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['view']);
    }

    public function view($slug): void
    {
        $page = $this->Pages
            ->find('slugged', ['slug' => $slug])
            ->find('published')
            ->contain('MetaTags.Image')
            ->firstOrFail();

        $this->set('page', $page);
    }
}
