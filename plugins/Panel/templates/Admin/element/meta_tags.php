<?php
/**
 * @var \App\View\AppView $this
 * @var object $meta_tag
 */
?>
<div class="row">
    <div class="col-12">
        <div id="panel_meta_tags" class="panel shadow-0" data-panel-close data-panel-collapsed data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Meta tags && Open Graph') ?></h2>
            </div>
            <div class="panel-container">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                            echo $this->Form->control('meta_tag.title', [
                                'label' => __d('panel', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Title'),
                            ]);
                            echo $this->Form->control('meta_tag.description', [
                                'label' => __d('panel', 'Meta description') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Meta description'),
                                'rows' => 2
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <?php
                            echo $this->Form->control('meta_tag.og_title', [
                                'label' => __d('panel', 'Open Graph title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Open Graph title')
                            ]);
                            echo $this->Form->control('meta_tag.og_description', [
                                'label' => __d('panel', 'Open Graph description') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Open Graph description'),
                                'rows' => 2
                            ]);
                            echo $this->Form->control('meta_tag.og_image_url', [
                                'label' => __d('panel', 'Open Graph Image URL') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Open Graph Image URL')
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>