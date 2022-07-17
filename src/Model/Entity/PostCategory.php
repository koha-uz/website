<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * PostCategory Entity
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $body
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 * @property \Cake\I18n\FrozenTime|null $date_published
 * @property bool $published
 * 
 * @property \App\Model\Entity\Post[] $posts
 */
class PostCategory extends Entity
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
        'date_published' => true,
        'published' => true,
        'meta_tag' => true,
        'posts' => true
    ];
}
