<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Behavior\Translate\TranslateTrait;
use Cake\ORM\Entity;

/**
 * Faq Entity
 *
 * @property int $id
 * @property int $service_id
 * @property string $question
 * @property string $slug
 * @property string $answer
 * @property bool $is_published
 * @property \Cake\I18n\DateTime|null $published
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Service $service
 * @property \App\Model\Entity\MetaTag $meta_tag
 * @property \App\Model\Entity\FaqsTranslation[] $_translations
 */
class Faq extends Entity
{
    use TranslateTrait;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        '_translations' => true,
        'service_id' => true,
        'question' => true,
        'slug' => true,
        'answer' => true,
        'is_published' => true,
        'published' => true,
        'created' => true,
        'modified' => true,
        'service' => true,
        'meta_tag' => true
    ];
}
