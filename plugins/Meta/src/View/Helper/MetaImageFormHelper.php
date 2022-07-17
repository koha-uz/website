<?php
namespace Meta\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use \Meta\Model\Entity\MetaTag;

/**
 * MetaImageForm helper
 */
class MetaImageFormHelper extends Helper
{
    /**
     * Helpers used by this helper.
     *
     * @var array
     */
    public $helpers = ['Form', 'Image', 'Html', 'Text', 'Url'];
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function controls()
    {
        $image_type = 1;
        if (null !== $this->Form->getSourceValue('meta_tag.image_type')) {
            $image_type = $this->Form->getSourceValue('meta_tag.image_type');
        } elseif (null !== $this->Form->getSourceValue('meta_tag.image')) {
            $image_type = 2;
        }
        $control = $this->Form->control('meta_tag.image_type', [
            'label' => false,
            'type' => 'radio',
            'options' => [
                ['value' => 1, 'text' => __d('meta', 'Basic')],
                ['value' => 2, 'text' => __d('meta', 'Generated')]
            ],
            'value' => $image_type
        ]);
        $result = $this->container($control, 'image-type-block');

        $generate_image_type = null;
        if ($image_type == 2) {
            $generate_image_type = (null !== $this->Form->getSourceValue('meta_tag.image_bg')) ? 2 : 1;
        }
        $hidden = true;
        if (null !== $generate_image_type) {
            $hidden = false;
        }
        $control = $this->Form->control('meta_tag.generate_image_type', [
            'label' => false,
            'hiddenField' => false,
            'type' => 'radio',
            'options' => [
                ['value' => 1, 'text' => __d('meta', 'Color')],
                ['value' => 2, 'text' => __d('meta', 'Image')]
            ],
            'disabled' => $hidden,
            'value' => $generate_image_type
        ]);
        $result .= $this->container($control, 'generate-image-type-block', $hidden);

        $hidden = true;
        if ($generate_image_type == 2) {
            $hidden = false;
        }
        $control = $this->Form->control('meta_tag.image_bg.file', [
            'label' => false,
            'type' => 'file',
            'required' => true,
            'disabled' => $hidden
        ]) .
        $this->Html->tag('div', __d('meta', 'Image must be 1200 x 630 px'),
            [
                'class' => 'alert alert-warning mt-3 mb-0 fw-500',
                'role' => 'alert'
            ]
        );

        if (null !== $this->Form->getSourceValue('meta_tag.image_bg')) {
            $control .= $this->Form->control('meta_tag.image_bg.old_file_id', [
                'type' => 'hidden',
                'value' => $this->Form->getSourceValue('meta_tag.image_bg.id')
            ]);
        }
        $result .= $this->container($control, 'image-bg-block', $hidden);

        if (null !== $this->Form->getSourceValue('meta_tag.image')) {
            $result .= $this->Form->control('meta_tag.image.old_file_id', [
                'type' => 'hidden',
                'value' => $this->Form->getSourceValue('meta_tag.image.id')
            ]);
        }

        return $result;
    }

    private function container($control, $id, $hidden = null)
    {
        return $this->Html->tag('div', $control, [
            'id' => $id,
            'class' => 'mb-3',
            'style' => (($hidden) ? 'display: none' : '')
        ]);
    }
}
