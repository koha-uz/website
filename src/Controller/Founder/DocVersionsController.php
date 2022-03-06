<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * DocVersions Controller
 *
 * @property \App\Model\Table\DocVersionsTable $DocVersions
 * @method \App\Model\Entity\DocVersion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocVersionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Docs'],
        ];
        $docVersions = $this->paginate($this->DocVersions);

        $this->set(compact('docVersions'));
    }

    /**
     * View method
     *
     * @param string|null $id Doc Version id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $docVersion = $this->DocVersions->get($id, [
            'contain' => ['Docs', 'DocVersions_body_translation', 'DocVersions_url_translation', 'I18n'],
        ]);

        $this->set(compact('docVersion'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($doc_id)
    {
        if (!$this->request->is('post')) {
            throw new RecordNotFoundException(__d('panel', 'Page not found.'));
        }
        $doc = $this->DocVersions->Docs->findById($doc_id)
            ->firstOrFail();

        $docVersion = $this->DocVersions->newEmptyEntity();
        $docVersion = $this->DocVersions->patchEntity($docVersion, $this->request->getData());
        $docVersion->set('doc_id', $doc_id);
        if ($this->DocVersions->save($docVersion)) {
            $this->Flash->success(__('The doc version has been saved.'));
        } else {
            $this->Flash->error(__('The doc version could not be saved. Please, try again.'));
        }
            
        return $this->redirect(['controller' => 'Docs', 'action' => 'view', $doc_id]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Doc Version id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (!$this->request->is(['patch', 'post', 'put'])) {
            throw new RecordNotFoundException(__d('panel', 'Page not found.'));
        }

        $docVersion = $this->DocVersions->findById($id)
            ->find('translations')
            ->firstOrFail();

        $docVersion = $this->DocVersions->patchEntity($docVersion, $this->request->getData());
        if ($this->DocVersions->save($docVersion)) {
            $this->Flash->success(__('The doc version has been saved.'));
        } else {
            $this->Flash->error(__('The doc version could not be saved. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Docs', 'action' => 'view', $docVersion->doc_id]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Doc Version id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $docVersion = $this->DocVersions->get($id);
        if ($this->DocVersions->delete($docVersion)) {
            $this->Flash->success(__('The doc version has been deleted.'));
        } else {
            $this->Flash->error(__('The doc version could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Docs', 'action' => 'view', $docVersion->doc_id]);
    }
}
