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
    const ROLE_APPLICANTS = 2;
    const ROLE_STUDENTS = 3;
    const ROLE_TEACHERS = 4;
    const ROLE_ADMISSION = 5;

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

        $this->hasMany('AdmissionApplications', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasOne('ApplicantProfiles', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('BillingMessages', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasOne('LanguageCertificates', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasOne('LearnerProfiles', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('PassingExams', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasOne('Passports', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasOne('Photo', [
            'className' => 'Burzum/FileStorage.FileStorage',
            'foreignKey' => 'foreign_key',
            'conditions' => ['Photo.model' => 'Users'],
            'cascadeCallbacks' => true,
            'dependent' => true
        ]);
        $this->belongsToMany('Roles', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'roles_users',
        ]);
        $this->hasOne('StudentProfiles', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasOne('TeacherProfiles', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasOne('UserProfiles', [
            'foreignKey' => 'user_id',
        ]);

        $this->addBehavior('Addresses');
        $this->addBehavior('EmailAddresses');
        $this->addBehavior('PhoneNumbers');
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'date_created' => 'new',
                    'date_modified' => 'always',
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

        if (!empty($entity->photo->file)) {
            $entity->photo->set('model', 'Users');
        }
    }

    public function afterSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        if ($entity->isNew()) {
            if ($entity->roles[0]->id == ROLE_STUDENT) {
                $studentStatus = $entity->student_profile->student_statuses[0];
                $studentStatus->set('decree_id', $entity->student_profile->student_groups[0]->decree->id);
                $this->StudentProfiles->StudentStatuses->save($studentStatus);
            }
        }
    }

    public function createApplicant($phoneNumber)
    {
        $password = $this->generateRandomString(6);
        $user = $this->newEntity([
            'username' => $phoneNumber->phone,
            'password' => $password,
            'roles' => ['_ids' => [ROLE_APPLICANT]]
        ]);
        $user->set('phone_number', $phoneNumber);

        if ($this->save($user)) {
            $this->BillingMessages->accessData($user, $password);
            return $user;
        }
        return $user;
    }

    private function generateRandomString($length = 10) {
        $characters = '123456789abcdefghkmnpqrstuvwxyzABCDEFGHKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function confirmPassword($value, array $context)
    {
        return ($value === $context['data']['new_password']);
    }

    public function findActive(Query $query, Array $options)
    {
        return $query->where([$this->aliasField('is_active') => true]);
    }

    public function findAuth(Query $query, Array $options)
    {
        return $query->find('active')
            ->contain(['Photo', 'Roles', 'UserProfiles']);
    }

    public function findApplicantsForExam(Query $query, Array $options)
    {
        return $query
            ->innerJoinWith('Roles', function($q) {
                return $q->where(['Roles.id' => 2]);
            })
            ->innerJoinWith('LearnerProfiles', function($q) use ($options) {
                return $q->where([
                    'LearnerProfiles.faculty_id' => $options['faculty_id'],
                    'LearnerProfiles.reception_id IN' => $options['receptions']['_ids']
                ]);
            })
            ->notMatching('PassingExams.Exams', function ($q) {
                return $q->where([
                    'DATE_ADD(Exams.date_started, INTERVAL Exams.duration MINUTE) > NOW()'
                ]);
            })
            ->contain([
                'ApplicantProfiles',
                'LearnerProfiles' => [
                    'LanguageTestLevels.LanguageTests',
                    'Receptions'
                ],
                'UserProfiles'
            ]);
    }

    public function findApplicantsForGroup(Query $query, Array $options)
    {
        return $query->find('applicants')
            ->innerJoinWith('AdmissionApplications', function($q) {
                return $q->find('approved');
            })
            ->contain([
                'AdmissionApplications' => function ($q) {
                    return $q->find('approved')
                        ->contain([
                            'Receptions.StudyPlans',
                            'StudyFaculties'
                        ]);
                },
                'UserProfiles'
            ]);
    }

    public function findAdministrators(Query $query, Array $options)
    {
        return $query->innerJoinWith('Roles', function($q) {
            return $q->where(['Roles.id' => ROLE_ADMINISTRATOR]);
        });
    }

    public function findApplicants(Query $query, Array $options)
    {
        return $query->innerJoinWith('Roles', function($q) {
            return $q->where(['Roles.id' => ROLE_APPLICANT]);
        });
    }

    public function findStudents(Query $query, Array $options)
    {
        return $query->innerJoinWith('Roles', function($q) {
            return $q->where(['Roles.id' => ROLE_STUDENT]);
        });
    }

    public function findTeachers(Query $query, Array $options)
    {
        return $query->innerJoinWith('Roles', function($q) {
            return $q->where(['Roles.id' => ROLE_TEACHER]);
        });
    }

    public function findListStudents(Query $query, Array $options)
    {
        if (isset($options['status']) && !empty($options['status'])) {
            $query->innerJoinWith('StudentProfiles.StudentStatuses', function ($q) use ($options) {
                return $q->where([
                    'StudentStatuses.is_current' => true,
                    'StudentStatuses.status' => (string)$options['status']
                ]);
            });
        }

        return $query->find('students')
            ->contain([
                'StudentProfiles' => [
                    'StudentGroups' => function ($q) {
                        return $q
                            ->where(['StudentGroups.is_current' => true])
                            ->contain([
                                'StudyGroups.StudyFaculties' => [
                                    'Faculties',
                                    'StudyCourses' => function ($q) {
                                        return $q->where(['StudyCourses.is_current' => true]);
                                    },
                                    'StudyPlans'
                                ]
                            ]);
                    },
                    'StudentStatuses' => function ($q) {
                        return $q->where([
                            'StudentStatuses.is_current' => true
                        ]);
                    }
                ],
                'UserProfiles'
            ]);
    }
}
