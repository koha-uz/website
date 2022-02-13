<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * DocVersion Entity
 *
 * @property int $id
 * @property int $doc_id
 * @property int $version
 * @property string|null $body
 * @property bool $is_current
 * @property string $url
 * @property \Cake\I18n\FrozenTime $date_approved
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\Doc $doc
 */
class DocVersion extends Entity
{
    use TranslateTrait;

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
        '_translations' => true,
        'doc_id' => true,
        'version' => true,
        'body' => true,
        'is_current' => true,
        'url' => true,
        'date_approved' => true,
        'date_created' => true,
        'date_modified' => true,
        'doc' => true,
    ];
}
