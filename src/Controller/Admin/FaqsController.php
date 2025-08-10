<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Faqs Controller
 *
 * @property \App\Model\Table\FaqsTable $Faqs
 */
class FaqsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Published');
    }

    public function index()
    {
        $this->Faqs->setLocale(Configure::read('I18n.defaultLanguage'));
        $faqs = $this->Faqs
            ->find('translations')
            ->contain([
                'Services' => function ($query) {
                    return $query->find('translations');
                }
            ]);

        $this->set(compact('faqs'));
    }

    public function add()
    {
        $faqsTable = $this->Faqs->removeBehavior('Translate');
        $faqsTable->MetaTags->removeBehavior('Translate');
        $faqsTable->Services->removeBehavior('Translate');

        $faq = $faqsTable->newEmptyEntity();
        if ($this->request->is('post')) {
            $faq = $faqsTable->patchEntity($faq, $this->request->getData(),
                ['associated' => ['MetaTags']]
            );
            if ($faqsTable->save($faq)) {
                $this->Flash->success(__('The faq has been saved.'));

                return $this->redirect(['controller' => 'Faqs', 'action' => 'index']);
            }
            $this->Flash->error(__('The faq could not be saved. Please, try again.'));
        }

        $services = $faqsTable->Services->find('list')->all();

        $this->set(compact('faq', 'services'));
    }

    public function edit($id = null)
    {
        $faqsTable = $this->Faqs->removeBehavior('Translate');
        $faqsTable->MetaTags->removeBehavior('Translate');
        $faqsTable->Services->removeBehavior('Translate');

        $faq = $faqsTable->findById($id)
            ->contain(['MetaTags'])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $faq = $faqsTable->patchEntity($faq, $this->request->getData(),
                ['associated' => ['MetaTags']]
            );

            if ($faqsTable->save($faq)) {
                $this->Flash->success(__('The faq has been saved.'));

                return $this->redirect(['controller' => 'Faqs', 'action' => 'index']);
            }

            $this->Flash->error(__('The faq could not be saved. Please, try again.'));
        }

        $services = $faqsTable->Services->find('list')->all();

        $this->set(compact('faq', 'services'));
    }

    public function translate($id, $locale)
    {
        $faqsTable = $this->Faqs;
        $faqsTable->setLocale(Configure::read('I18n.defaultLanguage'));

        $faq = $faqsTable->findById($id)
            ->find('translations', locales: [$locale])
            ->contain([
                'MetaTags' => function ($q) {
                    return $q->find('translations');
                }
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $faq = $faqsTable->patchEntity($faq, $this->request->getData());
            if ($faqsTable->save($faq)) {
                $this->Flash->success(__('The faq has been saved.'));

                return $this->redirect(['controller' => 'Faqs', 'action' => 'index']);
            }
            $this->Flash->error(__('The faq could not be saved. Please, try again.'));
        }

        $this->set(compact('faq'));
    }

    public function setPublished($slug = null)
    {
        $this->Published->setPublished($slug);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $faq = $this->Faqs->get($id);
        if ($this->Faqs->delete($faq)) {
            $this->Flash->success(__('The faq has been deleted.'));
        } else {
            $this->Flash->error(__('The faq could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
