<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * Ad Entity
 *
 * @property int $id
 * @property int $ad_category_id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 * @property \Cake\I18n\FrozenTime|null $date_published
 * @property bool $published
 *
 * @property \App\Model\Entity\AdCategory $ad_category
 */
class Ad extends Entity
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
        '_translations' => true,
        'ad_category_id' => true,
        'title' => true,
        'slug' => true,
        'body' => true,
        'date_created' => true,
        'date_modified' => true,
        'date_published' => true,
        'published' => true,
        'ad_category' => true,
        'meta_tag' => true
    ];
}
