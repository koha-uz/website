<?php
declare(strict_types=1);

namespace App\Model\Table;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'date_created' => 'new',
                    'date_modified' => 'always'
                ]
            ]
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('username')
            ->maxLength('username', 20)
            ->notEmptyString('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->minLength('password', 6, __('Password must be at least 6 characters long.'))
            ->notEmptyString('password', __('Password is required.'));

        $validator
            ->scalar('current_password')
            ->minLength('current_password', 6, __('Password must be at least 6 characters long.'))
            ->notEmptyString('current_password', __('You must enter the current password.'));

        $validator
            ->scalar('new_password')
            ->notEmptyString('new_password', __('You must enter a new password.'))
            ->minLength('new_password', 6, __('Password must be at least 6 characters long.'));

        $validator
            ->add('new_password_confirm', 'confirm_password', [
                'rule'     => 'confirmPassword',
                'message'  => __('New password and confirmation record do not match!'),
                'provider' => 'table'
            ]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username']));

        $rules->add(function($user) {
            if (!isset($user->current_password)) {
                return true;
            }

            $userFind = $this->findById($user->id)->first();
            if (
                !empty($userFind) &&
                (new DefaultPasswordHasher)->check(
                    $user->current_password,
                    $userFind->password
                )
            ) {
                return true;
            }

            return false;
        }, [
            'errorField' => 'current_password',
            'message' => __('The current password is incorrectly entered!')
        ]);

        $rules->add(function($user) {
            if (
                !isset($user->current_password) ||
                ($user->new_password !== $user->current_password)
            ) {
                return true;
            }

            return false;
        }, [
            'errorField' => 'new_password',
            'message' => __('The new password is no different from the current!')
        ]);

        return $rules;
    }

    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
    {

    }

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        if (isset($entity->new_password)) {
            $entity->password = $entity->new_password;
        }
    }

    public function afterSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {

    }

    public function confirmPassword($value, array $context)
    {
        return ($value === $context['data']['new_password']);
    }
}
