<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ads Controller
 *
 * @property \App\Model\Table\AdsTable $Ads
 * @method \App\Model\Entity\Ad[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdsController extends AppController
{
    public $paginate = [
        'limit' => 7,
        'order' => [
            'Ads.date_published' => 'desc'
        ]
    ];

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('SystemicPages');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $ads = $this->Ads->find('public')
            ->contain(['AdCategories', 'Cover', 'MetaTags.Image']);

        $this->set('ads', $this->paginate($ads));

        $this->SystemicPages->setupPage();
    }

    /**
     * View method
     *
     * @param string|null $slug Ad slug.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $ad = $this->Ads->find('slugged', compact('slug'))
            ->find('public')
            ->contain(['AdCategories', 'Cover', 'MetaTags.Image'])
            ->firstOrFail();

        $this->set(compact('ad'));
    }
}
