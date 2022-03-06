<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Docs Controller
 *
 * @property \App\Model\Table\DocsTable $Docs
 * @method \App\Model\Entity\Doc[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $docs = $this->paginate($this->Docs);

        $this->set(compact('docs'));
    }

    /**
     * View method
     *
     * @param string|null $id Doc id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $doc = $this->Docs->get($id, [
            'contain' => ['MetaTags', 'Docs_title_translation', 'Docs_body_translation', 'DocVersions', 'I18n'],
        ]);

        $this->set(compact('doc'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $doc = $this->Docs->newEmptyEntity();
        if ($this->request->is('post')) {
            $doc = $this->Docs->patchEntity($doc, $this->request->getData());
            if ($this->Docs->save($doc)) {
                $this->Flash->success(__('The doc has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc could not be saved. Please, try again.'));
        }
        $this->set(compact('doc'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doc id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $doc = $this->Docs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $doc = $this->Docs->patchEntity($doc, $this->request->getData());
            if ($this->Docs->save($doc)) {
                $this->Flash->success(__('The doc has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc could not be saved. Please, try again.'));
        }
        $this->set(compact('doc'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doc id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $doc = $this->Docs->get($id);
        if ($this->Docs->delete($doc)) {
            $this->Flash->success(__('The doc has been deleted.'));
        } else {
            $this->Flash->error(__('The doc could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
