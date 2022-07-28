<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * PostCategories Controller
 *
 * @property \App\Model\Table\PostCategoriesTable $PostCategories
 * @method \App\Model\Entity\PostCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostCategoriesController extends AppController
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
        $postCategories = $this->PostCategories->find();
        $this->set('postCategories', $postCategories);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $postCategory = $this->PostCategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $postCategory = $this->PostCategories->patchEntity($postCategory, $this->request->getData(),
                ['associated' => ['MetaTags.ImageBg', 'MetaTags.Image']]
            );

            if ($this->PostCategories->save($postCategory)) {
                $this->Flash->success(__('The post category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post category could not be saved. Please, try again.'));
        }
        $this->set(compact('postCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Post Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->PostCategories->setLocale('ru');
        $this->PostCategories->MetaTags->setLocale('ru');
        $postCategory = $this->PostCategories->findById($id)
            ->find('translations')
            ->contain([
                'Posts',
                'MetaTags' => function ($query) {
                    return $query->find('translations')
                        ->contain(['ImageBg', 'Image']);
                }
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $postCategory = $this->PostCategories->patchEntity($postCategory, $this->request->getData(),
                ['associated' => ['MetaTags.ImageBg', 'MetaTags.Image']]
            );
            if ($this->PostCategories->save($postCategory)) {
                $this->Flash->success(__('The post category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post category could not be saved. Please, try again.'));
        }
        $this->set(compact('postCategory'));
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
     * @param string|null $id Ad Category id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $postCategory = $this->PostCategories->get($id);
        if ($this->PostCategories->delete($postCategory)) {
            $this->Flash->success(__('The post category has been deleted.'));
        } else {
            $this->Flash->error(__('The post category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
