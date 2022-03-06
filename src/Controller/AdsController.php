<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ads Controller
 *
 * @property \App\Model\Table\AdsTable $Ads
 * @method \App\Model\Entity\Ad[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AdCategories'],
        ];
        $ads = $this->paginate($this->Ads);

        $this->set(compact('ads'));
    }

    /**
     * View method
     *
     * @param string|null $id Ad id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ad = $this->Ads->get($id, [
            'contain' => ['AdCategories'],
        ]);

        $this->set(compact('ad'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ad = $this->Ads->newEmptyEntity();
        if ($this->request->is('post')) {
            $ad = $this->Ads->patchEntity($ad, $this->request->getData());
            if ($this->Ads->save($ad)) {
                $this->Flash->success(__('The ad has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ad could not be saved. Please, try again.'));
        }
        $adCategories = $this->Ads->AdCategories->find('list', ['limit' => 200])->all();
        $this->set(compact('ad', 'adCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ad id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ad = $this->Ads->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ad = $this->Ads->patchEntity($ad, $this->request->getData());
            if ($this->Ads->save($ad)) {
                $this->Flash->success(__('The ad has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ad could not be saved. Please, try again.'));
        }
        $adCategories = $this->Ads->AdCategories->find('list', ['limit' => 200])->all();
        $this->set(compact('ad', 'adCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ad id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ad = $this->Ads->get($id);
        if ($this->Ads->delete($ad)) {
            $this->Flash->success(__('The ad has been deleted.'));
        } else {
            $this->Flash->error(__('The ad could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
