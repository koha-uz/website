<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * ChangePassword component
 */
class ChangePasswordComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function changePassword()
    {
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $user = $usersTable
            ->findById($this->getController()->Authentication->getIdentity()->id)
            ->firstOrFail();

        if ($this->getController()->getRequest()->is(['patch', 'post', 'put'])) {
            $user = $usersTable->patchEntity($user, $this->getController()->getRequest()->getData(), [
                'fields'   => ['current_password', 'new_password', 'new_password_confirm'],
                'validate' => 'default'
            ]);

            if ($usersTable->save($user)) {
                if (isset($user->new_password)) {
                    $this->getController()->Flash->success(__d('panel', 'The user password has been changed. Please, Log In.'));
                    return $this->getController()->redirect(['_name' => 'logout']);
                }

                $this->getController()->Flash->success(__d('panel', 'The user has been saved.'));
                return $this->getController()->redirect(['controller' => 'Users', 'action' => 'changePassword']);
            }
            $this->getController()->Flash->error(__d('panel', 'The user could not be saved. Please, try again.'));
        }

        $this->getController()->set('user', $user);
    }
}
