<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * SystemicPages Controller
 *
 * @property \App\Model\Table\SystemicPagesTable $SystemicPages
 */
class SystemicPagesController extends AppController
{
    public function dashboard()
    {
        
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->SystemicPages->setLocale(Configure::read('I18n.defaultLanguage'));
        $systemicPages = $this->SystemicPages->find('translations');

        $this->set(compact('systemicPages'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $systemicPagesTable = $this->SystemicPages->removeBehavior('Translate');
        $systemicPagesTable->MetaTags->removeBehavior('Translate');

        $systemicPage = $systemicPagesTable->newEmptyEntity();
        if ($this->request->is('post')) {
            $systemicPage = $systemicPagesTable->patchEntity($systemicPage, $this->request->getData());
            if ($systemicPagesTable->save($systemicPage)) {
                $this->Flash->success(__('The systemic page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The systemic page could not be saved. Please, try again.'));
        }
        $this->set(compact('systemicPage'));
    }

    public function translate($id, $locale)
    {
        $this->SystemicPages->setLocale(Configure::read('I18n.defaultLanguage'));
        $systemicPage = $this->SystemicPages->findById($id)
            ->find('translations', locales: [$locale])
            ->contain([
                'MetaTags' => function ($q) {
                    return $q->find('translations');
                }
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $systemicPage = $this->SystemicPages->patchEntity($systemicPage, $this->request->getData());

            if ($this->SystemicPages->save($systemicPage)) {
                $this->Flash->success(__('The systemic page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The systemic page could not be saved. Please, try again.'));
        }

        $this->set(compact('systemicPage'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Service id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $systemicPagesTable = $this->SystemicPages->removeBehavior('Translate');
        $systemicPagesTable->MetaTags->removeBehavior('Translate');

        $systemicPage = $systemicPagesTable->get($id, contain: ['MetaTags']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $systemicPage = $systemicPagesTable->patchEntity($systemicPage, $this->request->getData());
            if ($systemicPagesTable->save($systemicPage)) {
                $this->Flash->success(__('The systemic page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The systemic page could not be saved. Please, try again.'));
        }
        $this->set(compact('systemicPage'));
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
        $systemicPage = $this->SystemicPages->get($id);
        if ($this->SystemicPages->delete($systemicPage)) {
            $this->Flash->success(__('The systemic page has been deleted.'));
        } else {
            $this->Flash->error(__('The systemic page could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}