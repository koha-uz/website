<?php
$this->assign('title', __d('panel', 'Page Translation: {0}', h($page->title)));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Pages'), 'url' => ['controller' => 'Pages', 'action' => 'index']],
    ['title' => h($page->title), 'url' => ['controller' => 'Pages', 'action' => 'edit', h($page->id)]],
    ['title' => __d('panel', 'Translate')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['pages']['dynamic'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([
    'formplugins/summernote/summernote'
], ['block' => true]);

echo $this->Html->script([
    'formplugins/summernote/summernote',
    '/vendor/bundle.umd.min'
], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.summernote-original').summernote(
        {
            height: '200px',
            tabsize: 2,
            dialogsFade: true,
            toolbar: [
                ['view', ['fullscreen', 'codeview']]
            ]
        }
    );

    $('.summernote-translate').summernote(
        {
            height: '200px',
            tabsize: 2,
            dialogsFade: true,
            toolbar: [
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
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
        <i class="subheader-icon fal fa-globe"></i> <?= __d('panel', 'Page Translation:') ?> 
        <?= $this->Html->link(h($page->title), ['action' => 'edit', h($page->id)]) ?>
    </h1>
</div>

<?= $this->Form->create($page, ['type' => 'file']) ?>

<?php
echo $this->Form->control('_locale', [
    'type' => 'hidden',
    'value' => $this->request->getParam('locale')
]);
?>

<div class="row">
    <div class="col-12">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="h3 mb-5"><?= __d('panel', 'Original:') ?> <?= $this->Html->image('flag/ru.png', ['class' => 'ml-2', 'style' => 'width: 30px']) ?></h2>
                            <?php
                            echo $this->Form->control('title', [
                                'label' => ['class' => 'sr-only'],
                                'class' => 'form-control input-lg form-control-lg',
                                'disabled' => true,
                                'placeholder' => __d('panel', 'Title')
                            ]);
                            echo $this->Form->control('body', [
                                'label' => ['class' => 'sr-only'],
                                'disabled' => true,
                                'placeholder' => __d('panel', 'Body')
                            ]);
                            echo $this->element('meta_tags_original');
                            ?>
                        </div>
                        <div class="col-md-6">
                            <h2 class="h3 mb-5"><?= __d('panel', 'Translate To:') ?> <?= $this->Html->image('flag/' . $this->request->getParam('locale') . '.png', ['class' => 'ml-2', 'style' => 'width: 30px']) ?></h2>
                            <?php
                            echo $this->Form->control('_translations.' . $this->request->getParam('locale') . '.title', [
                                'label' => ['class' => 'sr-only'],
                                'class' => 'form-control input-lg form-control-lg',
                                'placeholder' => __d('panel', 'Title')
                            ]);
                            echo $this->Form->control('_translations.' . $this->request->getParam('locale') . '.body', [
                                'label' => ['class' => 'sr-only'],
                                'placeholder' => __d('panel', 'Body')
                            ]);
                            echo $this->element('meta_tags_translate', ['locale' => $this->request->getParam('locale')]);
                            ?>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <?= $this->Form->submit(__d('panel', 'Save')) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>
