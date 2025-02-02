<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * PostCategories Controller
 *
 * @property \App\Model\Table\PostCategoriesTable $PostCategories
 * @method \App\Model\Entity\AdCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostCategoriesController extends AppController
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

        $this->Authentication->allowUnauthenticated(['view']);
    }

    /**
     * View method
     *
     * @param string|null $slug Post Category slug.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $postCategory = $this->PostCategories
            ->find('published')
            ->find('slugged', compact('slug'))
            ->contain('MetaTags.Image')
            ->firstOrFail();

        $posts = $this->PostCategories->Posts->find('public')
            ->where(['Posts.post_category_id' => $postCategory->id])
            ->contain(['PostCategories', 'Cover']);

        $this->set('postCategory', $postCategory);
        $this->set('posts', $this->paginate($posts));
    }
}
