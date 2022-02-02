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
    }

    public function applicants()
    {
        if ($this->request->is('ajax')) {
            $users = $this->Users->find('applicants')
                ->innerJoinWith('PhoneNumbers')
                ->innerJoinWith('UserProfiles')
                ->contain([
                    'AdmissionApplications',
                    'Passports',
                    'PhoneNumbers',
                    'UserProfiles'
                ]);
            $this->set(compact('users'));
        }
    }

    public function applicantEdit($id)
    {
        $user = $this->Users->findById($id)
            ->find('applicants')
            ->contain([
                'Addresses',
                'AdmissionApplications' => function ($q) {
                    return $q->find('filled')
                        ->contain([
                            'Receptions.StudyPlans',
                            'StudyFaculties'
                        ]);
                },
                'EmailAddresses',
                'LanguageCertificates' => [
                    'LanguageTestLevels',
                    'Scan'
                ],
                'LearnerProfiles' => [
                    'Addresses',
                    'Diplom',
                    'MemberPhoneNumber'
                ],
                'Passports' => [
                    'Nationalities',
                    'Addresses',
                    'PassportScan'
                ],
                'PhoneNumbers',
                'Photo',
                'Roles',
                'UserProfiles'
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (!empty($this->request->getData('photo.file.tmp_name'))) {
                $user->set('photo', $this->Users->Photo->newEmptyEntity());
            }
            if (!empty($this->request->getData('learner_profile.certificate.file.tmp_name'))) {
                $user->set('learner_profile.certificate', $this->Users->LearnerProfiles->Certificate->newEmptyEntity());
            }

            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'associated' => [
                    'EmailAddresses',
                    'LearnerProfiles' => [
                        'associated' => [
                            'Addresses',
                            'Diplom',
                            'MemberPhoneNumber'
                        ]
                    ],
                    'Passports' => [
                        'associated' => [
                            'PassportScan'
                        ]
                    ],
                    'PhoneNumbers',
                    'Photo',
                    'Roles',
                    'UserProfiles'
                ]
            ]);

            if ($this->Users->save($user)) {
                $this->Flash->success(__d('panel', 'The user has been saved.'));
                return $this->redirect(['action' => 'applicantEdit', $id]);
            }

            $this->Flash->error(__d('panel', 'The user could not be saved. Please, try again.'));
        }

        $languageTests = $this->Users->LanguageCertificates->LanguageTestLevels->LanguageTests->find('list');
        if (
            (null !== $this->request->getData('language_certificate.language_test_level.language_test_id')) &&
            !empty($this->request->getData('language_certificate.language_test_level.language_test_id'))
        ) {
            $languageTestLevels = $this->Users->LanguageCertificates->LanguageTestLevels
                ->findByLanguageTestId($this->request->getData('language_certificate.language_test_level.language_test_id'))
                ->find('list');

            $this->set('languageTestLevels', $languageTestLevels);
        }
        $nationalities = $this->Users->Passports->Nationalities->find('list');
        $regions = $this->Users->LearnerProfiles->Addresses->Regions->find('treeList');

        $this->set(compact('languageTests', 'nationalities', 'regions', 'user'));
    }

    public function applicantsForExam()
    {
        $this->request->allowMethod(['ajax', 'post']);

        $users = $this->Users->find('applicantsForExam', $this->request->getData());

        $this->set('users', $users);
    }

    public function applicantsForGroup()
    {
        $this->request->allowMethod(['ajax', 'post']);

        $users = $this->Users->find('applicantsForGroup', $this->request->getData());

        $this->set('users', $users);
    }

    public function studentAdd()
    {
        $user = $this->Users->newEntity(
            [
                'roles' => ['_ids' => [ROLE_STUDENT]],
                'student_profile' => [
                    'student_statuses' => [
                        ['status' => '1']
                    ]
                ]
            ],
            [
                'associated' => [
                    'Roles',
                    'StudentProfiles.StudentStatuses'
                ]
            ]
        );

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'associated' => [
                    'EmailAddresses',
                    'LearnerProfiles' => [
                        'associated' => [
                            'Addresses',
                            'Diplom',
                            'MemberPhoneNumber'
                        ]
                    ],
                    'Passports' => [
                        'associated' => [
                            'PassportScan'
                        ]
                    ],
                    'PhoneNumbers',
                    'Photo',
                    'Roles',
                    'StudentProfiles' => [
                        'associated' => [
                            'StudentGroups.Decrees.Scan',
                            'StudentStatuses'
                        ]
                    ],
                    'UserProfiles'
                ]
            ]);

            if ($this->Users->save($user)) {
                $this->Flash->success(__d('panel', 'The student has been saved.'));
                return $this->redirect(['controller' => 'StudentProfiles', 'action' => 'edit', $user->id]);
            }

            $this->Flash->error(__d('panel', 'The student could not be saved. Please, try again.'));
        }

        $nationalities = $this->Users->Passports->Nationalities->find('list');
        $regions = $this->Users->LearnerProfiles->Addresses->Regions->find('treeList');

        $studyGroups = $this->getTableLocator()->get('StudyGroups')
            ->find('list', [
                'groupField' => 'study_faculty.faculty.title',
                'valueField' => function ($entity) {
                    return __d('panel', '{0} ({1} course)', $entity->abbr, $entity->study_faculty->study_courses[0]->course);
                },
                'order' => ['Faculties.title' => 'DESC']
            ])
            ->contain([
                'StudyFaculties' => [
                    'Faculties',
                    'StudyCourses' => function ($q) {
                        return $q->where(['StudyCourses.is_current' => true]);
                    },
                    'StudyPlans'
                ]
            ]);

        $this->set(compact('languageTests', 'nationalities', 'regions', 'studyGroups', 'user'));
    }

    public function teachers()
    {
        $users = $this->Users->find()
            ->innerJoinWith('Roles', function($q) {
                return $q->where(['Roles.id' => 4]);
            })
            ->contain([
                'TeacherProfiles',
                'UserProfiles'
            ]);

        $this->set('users', $users);
    }

    public function teacherAdd()
    {
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'associated' => [
                    'EmailAddresses',
                    'PhoneNumbers',
                    'Photo',
                    'Roles',
                    'UserProfiles',
                    'TeacherProfiles'
                ]
            ]);

            if ($this->Users->save($user)) {
                $this->Flash->success(__d('panel', 'The user has been saved.'));
                return $this->redirect(['action' => 'teachers']);
            }

            $this->Flash->error(__d('panel', 'The user could not be saved. Please, try again.'));
        }

        $this->set(compact('user'));
    }

    public function teacherEdit($id)
    {
        $user = $this->Users->find()
            ->find('teachers')
            ->where(['Users.id' => $id])
            ->contain([
                'EmailAddresses',
                'PhoneNumbers',
                'Photo',
                'Roles',
                'UserProfiles',
                'TeacherProfiles'
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (!empty($this->request->getData('photo.file.tmp_name'))) {
                $user->set('photo', $this->Users->Photo->newEmptyEntity());
            }

            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'associated' => [
                    'EmailAddresses',
                    'PhoneNumbers',
                    'Photo',
                    'Roles',
                    'UserProfiles',
                    'TeacherProfiles'
                ]
            ]);

            if ($this->Users->save($user)) {
                $this->Flash->success(__d('panel', 'The user has been saved.'));
                return $this->redirect(['action' => 'teachers']);
            }

            $this->Flash->error(__d('panel', 'The user could not be saved. Please, try again.'));
        }

        $this->set('user', $user);
    }

    public function admins()
    {
        $users = $this->Users->find()
            ->innerJoinWith('Roles', function($q) {
                return $q->find('administrators');
            })
            ->group(['Users.id', 'UserProfiles.id'])
            ->contain(['Roles', 'UserProfiles']);

        $this->set('users', $users);
    }

    public function adminAdd()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'associated' => [
                    'EmailAddresses',
                    'PhoneNumbers',
                    'Photo',
                    'Roles',
                    'UserProfiles'
                ]
            ]);

            if ($this->Users->save($user)) {
                $this->Flash->success(__d('panel', 'The user has been saved.'));
                return $this->redirect(['action' => 'admins']);
            }

            $this->Flash->error(__d('panel', 'The user could not be saved. Please, try again.'));
        }

        $roles = $this->Users->Roles->find('list')->find('administrators');
        $this->set(compact('roles', 'user'));
    }

    public function adminEdit($id)
    {
        $user = $this->Users->find()
            ->innerJoinWith('Roles', function ($q) {
                return $q->find('administrators');
            })
            ->where(['Users.id' => $id])
            ->contain([
                'EmailAddresses',
                'PhoneNumbers',
                'Photo',
                'Roles',
                'UserProfiles'
            ])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (!empty($this->request->getData('photo.file.tmp_name'))) {
                $user->set('photo', $this->Users->Photo->newEmptyEntity());
            }

            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'associated' => [
                    'EmailAddresses',
                    'PhoneNumbers',
                    'Photo',
                    'Roles',
                    'UserProfiles'
                ]
            ]);

            if ($this->Users->save($user)) {
                $this->Flash->success(__d('panel', 'The user has been saved.'));
                return $this->redirect(['action' => 'adminEdit', $user->id]);
            }

            $this->Flash->error(__d('panel', 'The user could not be saved. Please, try again.'));
        }

        $roles = $this->Users->Roles->find('list')->find('administrators');
        $this->set(compact('roles', 'user'));
    }

    public function changePassword()
    {
        $this->loadComponent('ChangePassword');
        $this->ChangePassword->changePassword();
    }

    /**
     * Delete method
     *
     * @param string|null $id Users id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__d('panel', 'The user has been deleted.'));
        } else {
            $this->Flash->error(__d('panel', 'The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'SystemicPages', 'action' => 'dashboard']);
    }
}
