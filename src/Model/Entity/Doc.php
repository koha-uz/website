<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * Doc Entity
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \App\Model\Entity\DocVersion[] $doc_versions
 * @property \Meta\Model\Entity\MetaTag $meta_tag
 */
class Doc extends Entity
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
        'title' => true,
        'slug' => true,
        'body' => true,
        'date_created' => true,
        'date_modified' => true,
        'doc_versions' => true,
        'meta_tag' => true
    ];
}
