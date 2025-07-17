<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * Page Entity
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $lft
 * @property int|null $rght
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property bool $is_published
 * @property \Cake\I18n\DateTime|null $published
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\ParentPage $parent_page
 * @property \App\Model\Entity\ChildPage[] $child_pages
 */
class Page extends Entity
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
    protected array $_accessible = [
        '_translations' => true,
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'title' => true,
        'slug' => true,
        'body' => true,
        'header' => true,
        'is_published' => true,
        'published' => true,
        'created' => true,
        'modified' => true,
        'parent_page' => true,
        'child_pages' => true,
        'meta_tag' => true
    ];
}
