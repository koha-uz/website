<?php
namespace Published\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Published helper
 */
class PublishedHelper extends Helper
{
    public $helpers = ['Url', 'Html', 'Form'];
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function control($item)
    {
        return $this->Form->control('published', [
            'type' => 'checkbox',
            'checked' => $item->published,
            'label' => __d('published', 'Published')
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

        $title        = __d('published', 'unpublish');
        $dataTitle    = __d('published', 'Are you sure you want to publish?');
        $style_mode   = 'btn-warning';

        if ($item->published) {
            $title        = __d('published', 'publish');
            $dataTitle    = __d('published', 'Are you sure you want to be removed from publication?');
            $style_mode   = 'btn-success';
        }

        return $this->Form->postLink($title,
            $this->Url->build(['controller' => $item->getSource(), 'action' => 'setPublished', h($item->id)]),
            [
                'class' => 'btn btn-xs ' . $style_mode,
                'data-title' => $dataTitle
            ]
        );
    }
}
