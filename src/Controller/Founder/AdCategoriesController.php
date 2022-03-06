<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;

/**
 * AdCategories Controller
 *
 * @property \App\Model\Table\AdCategoriesTable $AdCategories
 * @method \App\Model\Entity\AdCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdCategoriesController extends AppController
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
        $adCategories = $this->AdCategories->find();
        $this->set('adCategories', $adCategories);
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
            $adCategory = $this->AdCategories->patchEntity($adCategory, $this->request->getData(),
                ['associated' => ['MetaTags.ImageBg', 'MetaTags.Image']]
            );
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
        $this->AdCategories->setLocale('en');
        $this->AdCategories->MetaTags->setLocale('en');
        $adCategory = $this->AdCategories->findById($id)
            ->find('translations')
            ->contain([
                'Ads',
                'MetaTags' => function ($query) {
                    return $query->find('translations')
                        ->contain(['ImageBg', 'Image']);
                }
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $adCategory = $this->AdCategories->patchEntity($adCategory, $this->request->getData(),
                ['associated' => ['MetaTags.ImageBg', 'MetaTags.Image']]
            );
            if ($this->AdCategories->save($adCategory)) {
                $this->Flash->success(__('The ad category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ad category could not be saved. Please, try again.'));
        }
        $this->set(compact('adCategory'));
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
