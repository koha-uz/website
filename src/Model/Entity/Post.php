<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * Post Entity
 *
 * @property int $id
 * @property int $post_category_id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string|null $notes
 * @property string|null $youtubeId
 * @property \Cake\I18n\FrozenTime $date_created
 * @property \Cake\I18n\FrozenTime|null $date_modified
 * @property \Cake\I18n\FrozenTime|null $date_published
 * @property int $viewed
 * @property bool $published
 *
 * @property \App\Model\Entity\PostCategory $post_category
 */
class Post extends Entity
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
        'post_category_id' => true,
        'title' => true,
        'slug' => true,
        'body' => true,
        'notes' => true,
        'youtubeId' => true,
        'date_created' => true,
        'date_modified' => true,
        'date_published' => true,
        'viewed' => true,
        'published' => true,
        'post_category' => true,
        'meta_tag' => true,
        'cover' => true
    ];
}
