<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * I18nMessage Entity
 *
 * @property int $id
 * @property string $domain
 * @property string $locale
 * @property string $singular
 * @property string|null $plural
 * @property string|null $context
 * @property string|null $value_0
 * @property string|null $value_1
 * @property string|null $value_2
 */
class I18nMessage extends Entity
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
        'domain' => true,
        'locale' => true,
        'singular' => true,
        'plural' => true,
        'context' => true,
        'value_0' => true,
        'value_1' => true,
        'value_2' => true,
    ];
}
