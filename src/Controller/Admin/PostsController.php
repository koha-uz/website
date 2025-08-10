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

    public function add(AdminPostsService $adminPosts)
    {
        $postsTable = $this->Posts->removeBehavior('Translate');
        $postsTable->MetaTags->removeBehavior('Translate');
        $postsTable->PostCategories->removeBehavior('Translate');

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

        $tags = $postsTable->Tags->find('list', keyField: 'slug');

        $this->set(compact('post', 'postCategories', 'tags'));
    }

    public function edit($id = null)
    {
        $postsTable = $this->Posts->removeBehavior('Translate');
        $postsTable->MetaTags->removeBehavior('Translate');
        $postsTable->PostCategories->removeBehavior('Translate');

        $post = $postsTable->findById($id)
            ->contain(['Cover', 'MetaTags', 'Tags'])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $postsTable->patchEntity($post, $this->request->getData(),
                ['associated' => ['Cover', 'MetaTags', 'Tags']]
            );

            if ($postsTable->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
            }

            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $postCategories = $postsTable->PostCategories->find('list')
            ->find('published')
            ->all();

        $tags = $postsTable->Tags->find('list', keyField: 'slug');

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

    public function setPublished($slug = null)
    {
        $this->Published->setPublished($slug);
    }

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
