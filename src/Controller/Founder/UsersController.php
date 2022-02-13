<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use Cake\Event\EventInterface;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Ajax.Ajax', [
            'actions' => ['applicantsForExam', 'applicantsForGroup']
        ]);
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login']);
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('mini');

        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            return $this->redirect([
                'controller' => 'SystemicPages',
                'action' => 'dashboard',
            ]);
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__d('panel', 'Username or password is incorrect'));
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['_name' => 'home']);
    }

    public function changePassword()
    {
        $this->loadComponent('ChangePassword');
        $this->ChangePassword->changePassword();
    }
}
