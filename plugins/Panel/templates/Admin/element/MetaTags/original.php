<div class="card shadow-0">
    <div class="card-header py-2">
        <h2 class="card-title"><?= __d('panel', 'Meta Tags') ?></h2>
    </div>
    <div class="card-body">
        <?php
        echo $this->Form->control('meta_tag.title', [
            'label' => __d('panel', 'Title'),
            'disabled' => true,
            'placeholder' => __d('panel', 'Title'),
        ]);
        echo $this->Form->control('meta_tag.description', [
            'label' => __d('panel', 'Meta description'),
            'disabled' => true,
            'placeholder' => __d('panel', 'Meta description'),
            'rows' => 2
        ]);
        echo $this->Form->control('meta_tag.og_title', [
            'label' => __d('panel', 'Open Graph title'),
            'disabled' => true,
            'placeholder' => __d('panel', 'Open Graph title')
        ]);
        echo $this->Form->control('meta_tag.og_description', [
            'label' => __d('panel', 'Open Graph description'),
            'disabled' => true,
            'placeholder' => __d('panel', 'Open Graph description'),
            'rows' => 2
        ]);
        echo $this->Form->control('meta_tag.og_image_url', [
            'label' => __d('panel', 'Open Graph Image URL'),
            'disabled' => true,
            'placeholder' => 'https://...'
        ]);
        ?>
    </div>
</div>