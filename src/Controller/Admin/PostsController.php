<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Service\Admin\PostsService as AdminPostsService;
use Cake\Core\Configure;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 * @method \App\Model\Entity\Ad[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Published');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Posts->setLocale(Configure::read('I18n.defaultLanguage'));
        $posts = $this->Posts
            ->find('translations')
            ->contain([
                'PostCategories' => function ($query) {
                    return $query->find('translations');
                }
            ]);

        $this->set(compact('posts'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(AdminPostsService $adminPosts)
    {
        $postsTable = $this->Posts->removeBehavior('Translate');
        $postsTable->MetaTags->removeBehavior('Translate');

        $post = $postsTable->newEmptyEntity();
        if ($this->request->is('post')) {
            if ($adminPosts->create($post, $this->request->getData())) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $postCategories = $postsTable->PostCategories->find('list')
            ->find('published')
            ->all();

        $this->set(compact('post', 'postCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ad id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $postsTable = $this->Posts->removeBehavior('Translate');
        $postsTable->MetaTags->removeBehavior('Translate');

        $post = $postsTable->findById($id)
            ->contain(['Cover', 'MetaTags', 'Tags'])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {

            $post = $this->Posts->patchEntity($post, $this->request->getData(),
                ['associated' => ['Cover', 'MetaTags', 'Tags']]
            );

            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $postCategories = $this->Posts->PostCategories->find('list')
            ->find('published')
            ->all();

        $tags = $this->Posts->Tags->find('list', ['keyField' => 'slug']);

        $this->set(compact('post', 'postCategories', 'tags'));
    }

    public function translate($id, $locale)
    {
        $this->Posts->setLocale(Configure::read('I18n.defaultLanguage'));
        $post = $this->Posts->findById($id)
            ->find('translations', locales: [$locale])
            ->contain([
                'MetaTags' => function ($q) {
                    return $q->find('translations');
                }
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $this->set(compact('post'));
    }

    /**
     * setPublished method
     *
     * @param string|null $slug Item slug.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function setPublished($slug = null)
    {
        $this->Published->setPublished($slug);
    }


    /**
     * Delete method
     *
     * @param string|null $id Ad id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
