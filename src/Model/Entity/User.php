<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int $but_id
 * @property string $username
 * @property string $password
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 * @property \Cake\I18n\FrozenTime|null $date_visited
 * @property bool $is_active
 * @property int $old_id
 *
 * @property \App\Model\Entity\AdmissionApplication[] $admission_applications
 * @property \App\Model\Entity\Role[] $roles
 * @property \App\Model\Entity\EmailAddress $email_addresse
 * @property \App\Model\Entity\LanguageCertificate $language_certificate
 * @property \App\Model\Entity\PhoneNumber $phone_number
 * @property \Burzum\FileStorage.FileStorage $photo
 * @property \App\Model\Entity\Passport $passport
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'but_id' => true,
        'username' => true,
        'password' => true,
        'current_password' => true,
        'new_password' => true,
        'new_password_confirm' => true,
        'date_created' => true,
        'date_modified' => true,
        'date_visited' => true,
        'is_active' => true,
        'old_id' => true,
        'remember_me' => true,
        'admission_applications' => true,
        'applicant_profile' => true,
        'roles' => true,
        'student_profile' => true,
        'email_address' => true,
        'phone_number' => true,
        'language_certificate' => true,
        'learner_profile' => true,
        'user_profile' => true,
        'teacher_profile' => true,
        'photo' => true,
        'passing_exams' => true,
        'passport' => true,
        'address' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
}
