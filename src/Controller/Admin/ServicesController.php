<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;

class ServicesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Published');
    }

    public function index()
    {
        $this->Services->setLocale(Configure::read('I18n.defaultLanguage'));
        $services = $this->Services
            ->find('translations')
            ->contain([
                'ParentServices' => function ($query) {
                    return $query->find('translations');
                }
            ]);

        $this->set(compact('services'));
    }

    public function add()
    {
        $servicesTable = $this->Services->removeBehavior('Translate');
        $servicesTable->MetaTags->removeBehavior('Translate');

        $service = $servicesTable->newEmptyEntity();
        if ($this->request->is('post')) {
            $service = $servicesTable->patchEntity($service, $this->request->getData());

            if ($servicesTable->save($service)) {
                $this->Flash->success(__('The service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The service could not be saved. Please, try again.'));
        }

        $parents = $this->Services->find('treeList');
        $this->set(compact('service', 'parents'));
    }

    public function translate($id, $locale)
    {
        $this->Services->setLocale(Configure::read('I18n.defaultLanguage'));
        $service = $this->Services->findById($id)
            ->find('translations', locales: [$locale])
            ->contain([
                'MetaTags' => function ($q) {
                    return $q->find('translations');
                }
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $service = $this->Services->patchEntity($service, $this->request->getData());
            if ($this->Services->save($service)) {
                $this->Flash->success(__('The service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The service could not be saved. Please, try again.'));
        }

        $this->set(compact('service'));
    }

    public function edit($id = null)
    {
        $servicesTable = $this->Services->removeBehavior('Translate');
        $servicesTable->MetaTags->removeBehavior('Translate');

        $service = $servicesTable->get($id, contain: ['MetaTags']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $service = $servicesTable->patchEntity($service, $this->request->getData());
            if ($servicesTable->save($service)) {
                $this->Flash->success(__('The service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The service could not be saved. Please, try again.'));
        }

        $parents = $this->Services
            ->find('treeList')
            ->where(['Services.id !=' => $id]);

        $this->set(compact('service', 'parents'));
    }

    public function setPublished($slug = null)
    {
        $this->Published->setPublished($slug);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $service = $this->Services->get($id);
        if ($this->Services->delete($service)) {
            $this->Flash->success(__('The service has been deleted.'));
        } else {
            $this->Flash->error(__('The service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
