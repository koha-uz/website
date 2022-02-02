<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

/**
 * Faqs Controller
 *
 * @property \App\Model\Table\FaqsTable $Faqs
 * @method \App\Model\Entity\Faq[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FaqsController extends AppController
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
        $faqs = $this->Faqs->find()->contain('FaqCategories');

        $this->set(compact('faqs'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $faq = $this->Faqs->newEmptyEntity();
        if ($this->request->is('post')) {
            $faq = $this->Faqs->patchEntity($faq, $this->request->getData());
            if ($this->Faqs->save($faq)) {
                $this->Flash->success(__d('panel', 'The faq has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__d('panel', 'The faq could not be saved. Please, try again.'));
        }
        $faqCategories = $this->Faqs->FaqCategories->find('list', ['limit' => 200]);
        $this->set(compact('faq', 'faqCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Faqs->setLocale('en');
        $faq = $this->Faqs->findById($id)
            ->find('translations')
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $faq = $this->Faqs->patchEntity($faq, $this->request->getData());
            if ($this->Faqs->save($faq)) {
                $this->Flash->success(__d('panel', 'The faq has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__d('panel', 'The faq could not be saved. Please, try again.'));
        }
        $faqCategories = $this->Faqs->FaqCategories->find('list', ['limit' => 200]);
        $this->set(compact('faq', 'faqCategories'));
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
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $faq = $this->Faqs->get($id);
        if ($this->Faqs->delete($faq)) {
            $this->Flash->success(__d('panel', 'The faq has been deleted.'));
        } else {
            $this->Flash->error(__d('panel', 'The faq could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
