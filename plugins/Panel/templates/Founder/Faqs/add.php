<?php
$this->assign('title', __d('panel', 'Create faq'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Faqs'), 'url' => ['controller' => 'Faqs', 'action' => 'index']],
    ['title' => __d('panel', 'Create')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['faqs'][0] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css(['formplugins/select2/select2.bundle', 'formplugins/summernote/summernote'], ['block' => true]);
echo $this->Html->script(['formplugins/select2/select2.bundle', 'formplugins/summernote/summernote'], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.select2').select2();

    $('.summernote').summernote(
        {
            height: '250px',
            tabsize: 2,
            dialogsFade: true,
            toolbar: [
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']]
            ]
        }
    );
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-plus-circle"></i> <?= __d('panel', 'Create faq') ?>
    </h1>
</div>

<?= $this->Form->create($faq, ['type' => 'file']) ?>
<div class="row">
    <div class="col-md-9">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_en" role="tab">English</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_ru" role="tab">Русский</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_uz" role="tab">O'zbek</a></li>
                    </ul>
                    <div class="tab-content p-3 border border-top-0">
                        <div class="tab-pane fade show active" id="tab_en" role="tabpanel">
                            <?php
                            echo $this->Form->control('title', [
                                'label' => ['class' => 'sr-only'],
                                'class' => 'form-control input-lg form-control-lg rounded-0 border-top-0 border-left-0 border-right-0 px-0',
                                'placeholder' => __d('panel', 'Question')
                            ]);

                            echo $this->Form->control('body', [
                                'label' => ['class' => 'sr-only'],
                                'class' => 'summernote',
                                'placeholder' => __d('panel', 'Body')
                            ]);
                            ?>
                        </div>
                        <div class="tab-pane fade" id="tab_ru" role="tabpanel">
                            <?php
                            echo $this->Form->control('_translations.ru.title', [
                                'label' => ['class' => 'sr-only'],
                                'class' => 'form-control input-lg form-control-lg rounded-0 border-top-0 border-left-0 border-right-0 px-0',
                                'placeholder' => __d('panel', 'Question')
                            ]);

                            echo $this->Form->control('_translations.ru.body', [
                                'label' => ['class' => 'sr-only'],
                                'class' => 'summernote',
                                'placeholder' => __d('panel', 'Body')
                            ]);
                            ?>
                        </div>
                        <div class="tab-pane fade" id="tab_uz" role="tabpanel">
                            <?php
                            echo $this->Form->control('_translations.uz.title', [
                                'label' => ['class' => 'sr-only'],
                                'class' => 'form-control input-lg form-control-lg rounded-0 border-top-0 border-left-0 border-right-0 px-0',
                                'placeholder' => __d('panel', 'Question')
                            ]);

                            echo $this->Form->control('_translations.uz.body', [
                                'label' => ['class' => 'sr-only'],
                                'class' => 'summernote',
                                'placeholder' => __d('panel', 'Body')
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div id="panel-2" class="panel shadow-0" data-panel-close data-panel-collapsed data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Publish mode') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="d-flex flex-row flex-md-column flex-xl-row justify-content-between">
                        <?= $this->Published->control($faq) ?>
                        <?= $this->Form->control('popular') ?>
                    </div>
                    <div class="border-top mt-3 pt-3 text-right">
                        <?= $this->Form->submit(__d('panel', 'Save')) ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="panel-3" class="panel shadow-0" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Category') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?php
                    echo $this->Form->control('faq_category_id', [
                        'empty' => __d('panel', 'Select faq category'),
                        'label' => ['class' => 'sr-only'],
                        'class' => 'form-control select2 w-100'
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->Form->end() ?>
