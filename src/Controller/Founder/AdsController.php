<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;

/**
 * Ads Controller
 *
 * @property \App\Model\Table\AdsTable $Ads
 * @method \App\Model\Entity\Ad[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdsController extends AppController
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
        $ads = $this->Ads->find()
            ->contain('AdCategories');

        $this->set(compact('ads'));
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
            $ad = $this->Ads->patchEntity($ad, $this->request->getData(),
                ['associated' => ['MetaTags.ImageBg', 'MetaTags.Image']]
            );

            if ($this->Ads->save($ad)) {
                $this->Flash->success(__('The ad has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ad could not be saved. Please, try again.'));
        }
        $adCategories = $this->Ads->AdCategories->find('list')
            ->find('published')
            ->all();

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
        $this->Ads->setLocale('en');
        $this->Ads->MetaTags->setLocale('en');
        $ad = $this->Ads->findById($id)
            ->find('translations')
            ->contain([
                'MetaTags' => function ($query) {
                    return $query->find('translations')
                        ->contain(['ImageBg', 'Image']);
                }
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $ad = $this->Ads->patchEntity($ad, $this->request->getData(),
                ['associated' => ['MetaTags.ImageBg', 'MetaTags.Image']]
            );
            if ($this->Ads->save($ad)) {
                $this->Flash->success(__('The ad has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ad could not be saved. Please, try again.'));
        }
        $adCategories = $this->Ads->AdCategories->find('list')
            ->find('published')
            ->all();

        $this->set(compact('ad', 'adCategories'));
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
