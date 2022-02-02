<?php
declare(strict_types=1);

namespace Meta\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * MetaTag Entity
 *
 * @property string $id
 * @property int $foreign_key
 * @property string $model
 * @property string $title
 * @property string $description
 * @property string $og_title
 * @property string $og_description
 * @property int $og_image_type
 * @property \Burzum\FileStorage.FileStorage $image_bg
 * @property \Burzum\FileStorage.FileStorage $image
 */
class MetaTag extends Entity
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
        'foreign_key' => true,
        'model' => true,
        'title' => true,
        'description' => true,
        'og_title' => true,
        'og_description' => true,
        'image_type' => true,
        'generate_image_type' => true,
        'image_bg' => true,
        'image' => true
    ];
}
