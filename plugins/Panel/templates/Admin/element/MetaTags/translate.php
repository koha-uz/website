<div class="card shadow-0">
    <div class="card-header py-2">
        <h3 class="card-title"><?= __d('admin', 'Meta Tags') ?></h3>
    </div>
    <div class="card-body">
        <?php
        echo $this->Form->control('meta_tag._translations.' . $locale . '.title', [
            'label' => __d('admin', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
            'placeholder' => __d('admin', 'Title'),
        ]);
        echo $this->Form->control('meta_tag._translations.' . $locale . '.description', [
            'label' => __d('admin', 'Meta description') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
            'placeholder' => __d('admin', 'Meta description'),
            'rows' => 2
        ]);
        echo $this->Form->control('meta_tag._translations.' . $locale . '.og_title', [
            'label' => __d('admin', 'Open Graph title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
            'placeholder' => __d('admin', 'Open Graph title')
        ]);
        echo $this->Form->control('meta_tag._translations.' . $locale . '.og_description', [
            'label' => __d('admin', 'Open Graph description') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
            'placeholder' => __d('admin', 'Open Graph description'),
            'rows' => 2
        ]);
        echo $this->Form->control('meta_tag._translations.' . $locale . '.og_image_url', [
            'label' => __d('admin', 'Open Graph Image URL'),
            'placeholder' => 'https://...'
        ]);
        ?>
    </div>
</div>