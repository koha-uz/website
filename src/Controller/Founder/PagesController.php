<?php
namespace App\Controller\Founder;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;

/**
 * Pages Controller
 *
 * @property \App\Model\Table\PagesTable $Pages
 *
 * @method \App\Model\Entity\Page[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PagesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Published.Published');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $pages = $this->Pages->find();
        $this->set('pages', $pages);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $page = $this->Pages->newEmptyEntity();
        if ($this->request->is('post')) {
            $page = $this->Pages->patchEntity($page, $this->request->getData(),
                ['associated' => ['MetaTags.ImageBg', 'MetaTags.Image']]
            );
            if ($this->Pages->save($page)) {
                $this->Flash->success(__d('panel', 'The page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__d('panel', 'The page could not be saved. Please, try again.'));
        }
        $this->set(compact('page'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Page id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Pages->setLocale('en');
        $this->Pages->MetaTags->setLocale('en');
        $page = $this->Pages->findById($id)
            ->find('translations')
            ->contain([
                'MetaTags' => function ($query) {
                    return $query->find('translations')
                        ->contain(['ImageBg', 'Image']);
                }
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $page = $this->Pages->patchEntity($page, $this->request->getData(),
                ['associated' => ['MetaTags.ImageBg', 'MetaTags.Image']]
            );

            if ($this->Pages->save($page)) {
                $this->Flash->success(__d('panel', 'The page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__d('panel', 'The page could not be saved. Please, try again.'));
        }
        $this->set(compact('page'));
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
     * @param string|null $id Page id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $page = $this->Pages->get($id);
        if ($this->Pages->delete($page)) {
            $this->Flash->success(__d('panel', 'The page has been deleted.'));
        } else {
            $this->Flash->error(__d('panel', 'The page could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
