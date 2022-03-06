<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AdCategories Controller
 *
 * @property \App\Model\Table\AdCategoriesTable $AdCategories
 * @method \App\Model\Entity\AdCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $adCategories = $this->paginate($this->AdCategories);

        $this->set(compact('adCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Ad Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $adCategory = $this->AdCategories->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('adCategory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $adCategory = $this->AdCategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $adCategory = $this->AdCategories->patchEntity($adCategory, $this->request->getData());
            if ($this->AdCategories->save($adCategory)) {
                $this->Flash->success(__('The ad category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ad category could not be saved. Please, try again.'));
        }
        $this->set(compact('adCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ad Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $adCategory = $this->AdCategories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $adCategory = $this->AdCategories->patchEntity($adCategory, $this->request->getData());
            if ($this->AdCategories->save($adCategory)) {
                $this->Flash->success(__('The ad category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ad category could not be saved. Please, try again.'));
        }
        $this->set(compact('adCategory'));
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
        $adCategory = $this->AdCategories->get($id);
        if ($this->AdCategories->delete($adCategory)) {
            $this->Flash->success(__('The ad category has been deleted.'));
        } else {
            $this->Flash->error(__('The ad category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
