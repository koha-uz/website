<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Pages Controller
 *
 * @property \App\Model\Table\PagesTable $Pages
 */
class PagesController extends AppController
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
        $this->Pages->setLocale(Configure::read('I18n.defaultLanguage'));
        $pages = $this->Pages
            ->find('translations')
            ->contain([
                'ParentPages' => function ($query) {
                    return $query->find('translations');
                }
            ]);

        $this->set(compact('pages'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pagesTable = $this->Pages->removeBehavior('Translate');
        $pagesTable->MetaTags->removeBehavior('Translate');
        $page = $pagesTable->newEmptyEntity();
        if ($this->request->is('post')) {
            $page = $pagesTable->patchEntity($page, $this->request->getData());

            if ($pagesTable->save($page)) {
                $this->Flash->success(__('The page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The page could not be saved. Please, try again.'));
        }
        $parents = $this->Pages->find('treeList');
        $this->set(compact('page', 'parents'));
    }

    public function translate($id, $locale)
    {
        $this->Pages->setLocale(Configure::read('I18n.defaultLanguage'));
        $page = $this->Pages->findById($id)
            ->find('translations', locales: [$locale])
            ->contain([
                'MetaTags' => function ($q) {
                    return $q->find('translations');
                }
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $page = $this->Pages->patchEntity($page, $this->request->getData());
            if ($this->Pages->save($page)) {
                $this->Flash->success(__('The page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The page could not be saved. Please, try again.'));
        }

        $this->set(compact('page'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Page id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pagesTable = $this->Pages->removeBehavior('Translate');
        $pagesTable->MetaTags->removeBehavior('Translate');
        $page = $pagesTable->get($id, contain: ['MetaTags']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $page = $pagesTable->patchEntity($page, $this->request->getData());
            if ($pagesTable->save($page)) {
                $this->Flash->success(__('The page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The page could not be saved. Please, try again.'));
        }
        $parents = $this->Pages->find('treeList');
        $this->set(compact('page', 'parents'));
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
     * @param string|null $id Page id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $page = $this->Pages->get($id);
        if ($this->Pages->delete($page)) {
            $this->Flash->success(__('The page has been deleted.'));
        } else {
            $this->Flash->error(__('The page could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}