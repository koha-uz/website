<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Faqs Controller
 *
 * @property \App\Model\Table\FaqsTable $Faqs
 * @method \App\Model\Entity\Faq[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FaqsController extends AppController
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

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Faqs->find('popular');

        $faqCategories = $this->Faqs->FaqCategories->find('withFaqs')->toArray();
        $this->set(compact('faqCategories'));

        $this->SystemicPages->setupPage();
    }
}
