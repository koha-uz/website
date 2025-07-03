<?php
/**
 * @var \App\View\AppView $this
 * @var object $meta_tag
 */
?>

<div class="card">
    <div class="card-header py-2">
        <h3 class="card-title"><?= __d('panel', 'Meta Tag') ?></h3>
    </div>
    <div class="card-body">
        <?php
        echo $this->Form->control('meta_tag._translations.' . $locale . '.title', [
            'label' => __d('panel', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
            'placeholder' => __d('panel', 'Title'),
        ]);
        echo $this->Form->control('meta_tag._translations.' . $locale . '.description', [
            'label' => __d('panel', 'Meta description') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
            'placeholder' => __d('panel', 'Meta description'),
            'rows' => 2
        ]);
        echo $this->Form->control('meta_tag._translations.' . $locale . '.og_title', [
            'label' => __d('panel', 'Open Graph title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
            'placeholder' => __d('panel', 'Open Graph title')
        ]);
        echo $this->Form->control('meta_tag._translations.' . $locale . '.og_description', [
            'label' => __d('panel', 'Open Graph description') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
            'placeholder' => __d('panel', 'Open Graph description'),
            'rows' => 2
        ]);
        echo $this->Form->control('meta_tag._translations.' . $locale . '.og_image_url', [
            'label' => __d('panel', 'Open Graph Image URL') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
            'placeholder' => __d('panel', 'Open Graph Image URL')
        ]);
        ?>
    </div>
</div>