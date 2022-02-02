<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * FaqCategories Controller
 *
 * @property \App\Model\Table\FaqCategoriesTable $FaqCategories
 * @method \App\Model\Entity\FaqCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FaqCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $faqCategories = $this->paginate($this->FaqCategories);

        $this->set(compact('faqCategories'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $faqCategory = $this->FaqCategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $faqCategory = $this->FaqCategories->patchEntity($faqCategory, $this->request->getData());
            if ($this->FaqCategories->save($faqCategory)) {
                $this->Flash->success(__d('panel', 'The faq category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__d('panel', 'The faq category could not be saved. Please, try again.'));
        }
        $this->set(compact('faqCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Faq Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->FaqCategories->setLocale('en');
        $faqCategory = $this->FaqCategories->findById($id)
            ->find('translations')
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $faqCategory = $this->FaqCategories->patchEntity($faqCategory, $this->request->getData());
            if ($this->FaqCategories->save($faqCategory)) {
                $this->Flash->success(__d('panel', 'The faq category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__d('panel', 'The faq category could not be saved. Please, try again.'));
        }
        $this->set(compact('faqCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Faq Category id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $faqCategory = $this->FaqCategories->get($id);
        if ($this->FaqCategories->delete($faqCategory)) {
            $this->Flash->success(__d('panel', 'The faq category has been deleted.'));
        } else {
            $this->Flash->error(__d('panel', 'The faq category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
