<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

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

        $this->loadComponent('Published.Published');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $posts = $this->Posts->find()
            ->contain([
                'PostCategories',
                'Cover'
            ]);

        $this->set(compact('posts'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEmptyEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData(),
                ['associated' => ['Cover', 'MetaTags.ImageBg', 'MetaTags.Image', 'Tags']]
            );
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'edit', $post->id]);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $postCategories = $this->Posts->PostCategories->find('list')
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
        $this->Posts->setLocale('en');
        $this->Posts->MetaTags->setLocale('en');
        $post = $this->Posts->findById($id)
            ->find('translations')
            ->contain([
                'Cover',
                'MetaTags' => function ($query) {
                    return $query->find('translations')
                        ->contain(['ImageBg', 'Image']);
                },
                'Tags'
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (!empty($this->request->getData('cover.file.tmp_name'))) {
                $post->set('cover', $this->Posts->Cover->newEmptyEntity());
            }

            $post = $this->Posts->patchEntity($post, $this->request->getData(),
                ['associated' => ['Cover', 'MetaTags.ImageBg', 'MetaTags.Image', 'Tags']]
            );

            //debug($this->request->getData());
            //debug($post);
            //exit;

            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'edit', $post->id]);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $postCategories = $this->Posts->PostCategories->find('list')
            ->find('published')
            ->all();
        $tags = $this->Posts->Tags->find('list', ['keyField' => 'slug']);

        $this->set(compact('post', 'postCategories', 'tags'));
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
