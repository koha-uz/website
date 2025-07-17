<?php
$this->assign('title', __d('panel', 'Create systemic page'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Pages')],
    ['title' => __d('panel', 'Systemic Pages'), 'url' => ['controller' => 'SystemicPages', 'action' => 'index']],
    ['title' => __d('panel', 'Create')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['pages']['systemic'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css(
    ['formplugins/summernote/summernote'],
    ['block' => true]
);

echo $this->Html->script(
    ['formplugins/summernote/summernote'],
    ['block' => true]
);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.summernote').summernote(
        {
            height: '200px',
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
        <i class="subheader-icon fal fa-plus-circle"></i> <?= __d('panel', 'Create Systemic Page') ?>
    </h1>
</div>

<?= $this->Form->create($systemicPage) ?>
<div class="row">
    <div class="col-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('admin', 'Create Dynamic Page') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <?php
                            echo $this->Form->control('title', [
                                'label' => __d('admin', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Title')
                            ]);
                            echo $this->Form->control('short_name', [
                                'label' => __d('panel', 'Short name') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Short name')
                            ]);
                            echo $this->Form->control('notation', [
                                'label' => __d('panel', 'Notation') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Notation')
                            ]);
                            echo $this->Form->control('body', [
                                'label' => __d('admin', 'Body') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'rows' => 11,
                                'placeholder' => __d('panel', 'Body')
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-4">
                            <?= $this->element('MetaTags/default') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="border-top pt-3 text-right">
                                <?php
                                echo $this->Html->link(
                                    __d('admin', 'Cancel'),
                                    ['controller' => 'SystemicPages', 'action' => 'index'],
                                    ['class' => 'btn btn-default mr-2']
                                );
                                echo $this->Form->submit(__d('panel', 'Create'));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>