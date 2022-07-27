<?php
namespace App\Controller\Founder;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * SystemicPages Controller
 *
 * @property \App\Model\Table\SystemicPagesTable $SystemicPages
 *
 * @method \App\Model\Entity\SystemicPage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SystemicPagesController extends AppController
{
    public function dashboard()
    {
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $systemicPages = $this->SystemicPages->find();

        $this->set(compact('systemicPages'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Systemic Page id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->SystemicPages->setLocale('ru');
        $this->SystemicPages->MetaTags->setLocale('ru');
        $systemicPage = $this->SystemicPages->findById($id)
            ->find('translations')
            ->contain([
                'MetaTags' => function ($query) {
                    return $query->find('translations')
                        ->contain(['ImageBg', 'Image']);
                }
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $systemicPage = $this->SystemicPages->patchEntity($systemicPage, $this->request->getData(),
                ['associated' => ['MetaTags.ImageBg', 'MetaTags.Image']]
            );

            if ($this->SystemicPages->save($systemicPage)) {
                $this->Flash->success(__d('panel', 'The systemic page has been saved.'));

                return $this->redirect(['action' => 'edit', $id]);
            }
            $this->Flash->error(__d('panel', 'The systemic page could not be saved. Please, try again.'));
        }
        $this->set(compact('systemicPage'));
    }
}
