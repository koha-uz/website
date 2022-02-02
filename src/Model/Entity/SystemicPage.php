<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * SystemicPage Entity
 *
 * @property int $id
 * @property string $short_name
 * @property string $notation
 * @property string $title
 * @property string $body
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 *
 * @property \Meta\Model\Entity\MetaTag $meta_tag
 */
class SystemicPage extends Entity
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
        'short_name' => true,
        'notation' => false,
        'title' => true,
        'body' => true,
        'date_created' => true,
        'date_modified' => true,
        'meta_tag' => true
    ];
}
