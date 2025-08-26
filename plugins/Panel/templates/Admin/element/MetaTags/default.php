<div class="card shadow-0">
    <div class="card-header py-2">
        <h3 class="card-title"><?= __d('admin', 'Meta Tags') ?></h3>
    </div>
    <div class="card-body">
        <?php
        echo $this->Form->control('meta_tag.title', [
            'label' => __d('admin', 'Meta Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
            'placeholder' => __d('admin', 'Meta Title'),
        ]);
        echo $this->Form->control('meta_tag.description', [
            'label' => __d('admin', 'Meta Description') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
            'placeholder' => __d('admin', 'Meta description'),
            'rows' => 2
        ]);
        echo $this->Form->control('meta_tag.og_title', [
            'label' => __d('admin', 'Open Graph Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
            'placeholder' => __d('admin', 'Open Graph Title')
        ]);
        echo $this->Form->control('meta_tag.og_description', [
            'label' => __d('admin', 'Open Graph Description') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
            'escape' => false,
            'placeholder' => __d('admin', 'Open Graph Description'),
            'rows' => 2
        ]);
        echo $this->Form->control('meta_tag.og_image_url', [
            'label' => __d('admin', 'Open Graph Image Url'),
            'placeholder' => 'https://...'
        ]);
        ?>
    </div>
</div>