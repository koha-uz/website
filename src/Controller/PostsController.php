<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\PostsService;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 * @method \App\Model\Entity\Ad[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostsController extends AppController
{
    public $paginate = [
        'limit' => 7,
        'order' => [
            'Posts.date_published' => 'desc'
        ]
    ];

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('SystemicPages');

        $this->Authentication->allowUnauthenticated(['index', 'view']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index(PostsService $posts)
    {
        $posts = $this->Posts->find('public')
            ->contain(['PostCategories', 'Cover']);

        if (null !== $this->request->getQuery('tag')) {
            $tag = $this->Posts->Tags
                ->findBySlug($this->request->getQuery('tag'))
                ->firstOrfail();
            $this->set('tag', $tag);

            $posts->find('tagged', ['slug' => $tag->slug]);
        }

        $this->set('posts', $this->paginate($posts));

        $this->SystemicPages->setupPage();
    }

    /**
     * View method
     *
     * @param string|null $slug Post slug.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(PostsService $posts, $slug = null)
    {
        $post = $posts->viewed($slug);

        $this->set(compact('post'));
    }
}
