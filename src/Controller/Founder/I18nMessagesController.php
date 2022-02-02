<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * I18nMessages Controller
 *
 * @property \App\Model\Table\I18nMessagesTable $I18nMessages
 * @method \App\Model\Entity\I18nMessage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class I18nMessagesController extends AppController
{
    /**
     * Edit method
     *
     * @param string $domain I18n Message domain.
     * @param string $locale I18n Message lang.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     */
    public function edit($domain, $locale)
    {
        $i18nMessages = $this->I18nMessages
            ->findByDomainAndLocale($domain, $locale)
            ->toArray();

        if (empty($i18nMessages)) {
            throw new RecordNotFoundException(__d('panel', 'Domain not found.'));
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $i18nMessages = $this->I18nMessages->patchEntities($i18nMessages, $this->request->getData());

            foreach($i18nMessages as $i18nMessage) {
                $this->I18nMessages->save($i18nMessage);
            }

            $this->Flash->success(__d('panel', 'The i18n message has been saved.'));
            return $this->redirect($this->request->getRequestTarget());
        }
        $this->set(compact('i18nMessages'));
    }
}
