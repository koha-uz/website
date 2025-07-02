<div class="row">
    <div class="col-12">
        <div id="panel_meta_tags" class="panel shadow-0"
            data-panel-close data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Meta tags && Open Graph') ?></h2>
            </div>
            <div class="panel-container">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_meta_ru" role="tab">Русский</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_meta_uz" role="tab">O'zbek</a></li>
                            </ul>
                            <div class="tab-content p-3 border border-top-0">
                                <div class="tab-pane fade show active" id="tab_meta_ru" role="tabpanel">
                                    <?php
                                    echo $this->Form->control('meta_tag.title', [
                                        'label' => __d('panel', 'Title'),
                                        'placeholder' => __d('panel', 'Title'),
                                    ]);

                                    echo $this->Form->control('meta_tag.description', [
                                        'label' => __d('panel', 'Meta description'),
                                        'placeholder' => __d('panel', 'Meta description'),
                                        'rows' => 2
                                    ]);

                                    echo $this->Form->control('meta_tag.og_title', [
                                        'label' => __d('panel', 'Open Graph title'),
                                        'placeholder' => __d('panel', 'Open Graph title')
                                    ]);

                                    echo $this->Form->control('meta_tag.og_description', [
                                        'label' => __d('panel', 'Open Graph description'),
                                        'placeholder' => __d('panel', 'Open Graph description'),
                                        'rows' => 2
                                    ]);
                                    ?>
                                </div>
                                <div class="tab-pane fade" id="tab_meta_uz" role="tabpanel">
                                    <?php
                                    echo $this->Form->control('meta_tag._translations.uz.title', [
                                        'label' => __d('panel', 'Title'),
                                        'placeholder' => __d('panel', 'Title'),
                                    ]);

                                    echo $this->Form->control('meta_tag._translations.uz.description', [
                                        'label' => __d('panel', 'Meta description'),
                                        'placeholder' => __d('panel', 'Meta description'),
                                        'rows' => 2
                                    ]);

                                    echo $this->Form->control('meta_tag._translations.uz.og_title', [
                                        'label' => __d('panel', 'Open Graph title'),
                                        'placeholder' => __d('panel', 'Open Graph title')
                                    ]);

                                    echo $this->Form->control('meta_tag._translations.uz.og_description', [
                                        'label' => __d('panel', 'Open Graph description'),
                                        'placeholder' => __d('panel', 'Open Graph description'),
                                        'rows' => 2
                                    ]);
                                    ?>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <h5 class="frame-heading"><?= __d('panel', 'Open Graph image') ?></h5>
                            <?php
                            echo $this->MetaImageForm->controls();
                            if (null !== $meta_tag && !empty($meta_tag->getError('app_image_bg'))) {
                                echo $this->Html->tag('div', $meta_tag->getError('app_image_bg')[0], ['class' => 'text-danger mb-3']);
                            }

                            if (null !== $meta_tag && $meta_tag->has('image')) {
                                echo $this->Image->display($meta_tag->image, null, ['class' => 'img-fluid border']);
                            } else {
                                echo $this->Html->image('logo1200x630.png', ['class' => 'img-fluid border']);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->script('Meta.imageMode', ['block' => true]) ?>
