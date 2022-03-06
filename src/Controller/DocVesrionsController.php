<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DocVesrions Controller
 *
 * @method \App\Model\Entity\DocVesrion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocVesrionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $docVesrions = $this->paginate($this->DocVesrions);

        $this->set(compact('docVesrions'));
    }

    /**
     * View method
     *
     * @param string|null $id Doc Vesrion id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $docVesrion = $this->DocVesrions->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('docVesrion'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $docVesrion = $this->DocVesrions->newEmptyEntity();
        if ($this->request->is('post')) {
            $docVesrion = $this->DocVesrions->patchEntity($docVesrion, $this->request->getData());
            if ($this->DocVesrions->save($docVesrion)) {
                $this->Flash->success(__('The doc vesrion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc vesrion could not be saved. Please, try again.'));
        }
        $this->set(compact('docVesrion'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doc Vesrion id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $docVesrion = $this->DocVesrions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $docVesrion = $this->DocVesrions->patchEntity($docVesrion, $this->request->getData());
            if ($this->DocVesrions->save($docVesrion)) {
                $this->Flash->success(__('The doc vesrion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doc vesrion could not be saved. Please, try again.'));
        }
        $this->set(compact('docVesrion'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doc Vesrion id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $docVesrion = $this->DocVesrions->get($id);
        if ($this->DocVesrions->delete($docVesrion)) {
            $this->Flash->success(__('The doc vesrion has been deleted.'));
        } else {
            $this->Flash->error(__('The doc vesrion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
