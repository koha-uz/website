<div class="card shadow-0">
    <div class="card-header py-2">
        <h2 class="card-title"><?= __d('admin', 'Meta Tags') ?></h2>
    </div>
    <div class="card-body">
        <?php
        echo $this->Form->control('meta_tag.title', [
            'label' => __d('admin', 'Title'),
            'disabled' => true,
            'placeholder' => __d('admin', 'Title'),
        ]);
        echo $this->Form->control('meta_tag.description', [
            'label' => __d('admin', 'Meta description'),
            'disabled' => true,
            'placeholder' => __d('admin', 'Meta description'),
            'rows' => 2
        ]);
        echo $this->Form->control('meta_tag.og_title', [
            'label' => __d('admin', 'Open Graph title'),
            'disabled' => true,
            'placeholder' => __d('admin', 'Open Graph title')
        ]);
        echo $this->Form->control('meta_tag.og_description', [
            'label' => __d('admin', 'Open Graph description'),
            'disabled' => true,
            'placeholder' => __d('admin', 'Open Graph description'),
            'rows' => 2
        ]);
        echo $this->Form->control('meta_tag.og_image_url', [
            'label' => __d('admin', 'Open Graph Image URL'),
            'disabled' => true,
            'placeholder' => 'https://...'
        ]);
        ?>
    </div>
</div>