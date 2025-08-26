<?php
declare(strict_types=1);

namespace App\Controller;

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
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    public function login()
    {
        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            return $this->redirect([
                'controller' => 'SystemicPages',
                'action' => 'dashboard',
                'prefix' => 'Admin'
            ]);
        }
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Username or password is incorrect'));
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['_name' => 'home']);
    }
}
