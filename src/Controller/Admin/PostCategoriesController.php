<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;

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

        $this->loadComponent('Published');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->PostCategories->setLocale(Configure::read('I18n.defaultLanguage'));
        $postCategories = $this->PostCategories
            ->find('translations')
            ->contain([
                'ParentPostCategories' => function ($query) {
                    return $query->find('translations');
                }
            ]);

        $this->set('postCategories', $postCategories);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $postCategoriesTable = $this->PostCategories->removeBehavior('Translate');
        $postCategoriesTable->MetaTags->removeBehavior('Translate');

        $postCategory = $postCategoriesTable->newEmptyEntity();
        if ($this->request->is('post')) {
            $postCategory = $postCategoriesTable->patchEntity($postCategory, $this->request->getData());

            if ($postCategoriesTable->save($postCategory)) {
                $this->Flash->success(__('The post category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post category could not be saved. Please, try again.'));
        }

        $parents = $postCategoriesTable->find('treeList');
        $this->set(compact('parents', 'postCategory'));
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
        $postCategoriesTable = $this->PostCategories->removeBehavior('Translate');
        $postCategoriesTable->MetaTags->removeBehavior('Translate');

        $postCategory = $postCategoriesTable->get($id, contain: ['MetaTags']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postCategory = $this->PostCategories->patchEntity($postCategory, $this->request->getData());

            if ($this->PostCategories->save($postCategory)) {
                $this->Flash->success(__('The post category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post category could not be saved. Please, try again.'));
        }

        $parents = $postCategoriesTable
            ->find('treeList')
            ->where(['PostCategories.id !=' => $id]);

        $this->set(compact('parents', 'postCategory'));
    }

    public function translate($id, $locale)
    {
        $this->PostCategories->setLocale(Configure::read('I18n.defaultLanguage'));
        $postCategory = $this->PostCategories->findById($id)
            ->find('translations', locales: [$locale])
            ->contain([
                'MetaTags' => function ($q) {
                    return $q->find('translations');
                }
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $postCategory = $this->PostCategories->patchEntity($postCategory, $this->request->getData());
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
