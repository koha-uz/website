<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Published helper
 */
class PublishedHelper extends Helper
{
    public array $helpers = ['Url', 'Html', 'Form'];
    /**
     * Default configuration.
     *
     * @var array
     */
    protected array $_defaultConfig = [];

    public function control($item)
    {
        return $this->Form->control('is_published', [
            'type' => 'checkbox',
            'checked' => $item->is_published,
            'label' => __('Published')
        ]);
    }

    /**
     * Метод показывает текующий режим публикации
     * и выдает ссылку на смену режима.
     */
    public function publishLink($item)
    {
        if (!($item instanceOf \Cake\ORM\Entity)) {
            return;
        }

        $title     = __('unpublish');
        $dataTitle = __('Are you sure you want to publish?');
        $styleMode = 'btn-warning';
        if ($item->is_published) {
            $title     = __('publish');
            $dataTitle = __('Are you sure you want to be removed from publication?');
            $styleMode = 'btn-success';
        }

        return $this->Form->postLink($title,
            $this->Url->build([
                'controller' => $item->getSource(),
                'action' => 'setPublished',
                h($item->id)
            ]),
            [
                'class' => 'btn btn-xs ' . $styleMode,
                'escape' => false,
                'confirm' => $dataTitle
            ]
        );
    }
}
