<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;

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
        $docs = $this->Docs->find()
            ->contain('DocVersions');

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
        $this->Docs->DocVersions->setLocale('en');

        $doc = $this->Docs->findById($id)
            ->contain([
                'DocVersions' => function ($q) {
                    return $q->find('translations');
                },
                'MetaTags' => [
                    'Image',
                    'ImageBg'
                ]
            ])
            ->firstOrFail();

        /*debug($doc);
        exit;*/

        $docVersion = $this->Docs->DocVersions->newEmptyEntity();
        $this->set(compact('doc', 'docVersion'));
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
            $doc = $this->Docs->patchEntity($doc, $this->request->getData(),
                ['associated' => ['MetaTags.ImageBg', 'MetaTags.Image']]
            );
    
            if ($this->Docs->save($doc)) {
                $this->Flash->success(__('The doc has been saved.'));

                return $this->redirect(['action' => 'view', $doc->id]);
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
        $this->Docs->setLocale('en');
        $this->Docs->MetaTags->setLocale('en');

        $doc = $this->Docs->findById($id)
            ->find('translations')
            ->contain([
                'MetaTags' => function ($query) {
                    return $query->find('translations')
                        ->contain(['ImageBg', 'Image']);
                }
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $doc = $this->Docs->patchEntity($doc, $this->request->getData(),
                ['associated' => ['MetaTags.ImageBg', 'MetaTags.Image']]
            );

            if ($this->Docs->save($doc)) {
                $this->Flash->success(__('The doc has been saved.'));

                return $this->redirect(['action' => 'index', $doc->id]);
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
