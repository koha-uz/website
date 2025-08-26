<?php
$this->assign('title', h($systemicPage->short_name));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('admin', 'Pages')],
    ['title' => __d('admin', 'Systemic Pages'), 'url' => ['controller' => 'SystemicPages', 'action' => 'index']],
    ['title' => h($systemicPage->short_name)]
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
        <i class="subheader-icon fal fa-file-alt"></i> <?= h($systemicPage->short_name) ?>
    </h1>
</div>

<div class="row">
    <div class="col-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= h($systemicPage->short_name) ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?php
                    if ($this->AuthUser->hasAccess(['controller' => 'SystemicPages', 'action' => 'delete', h($systemicPage->id)])) {
                        echo $this->Form->deleteLink(
                            $this->Html->tag('i', '', ['class' => 'fal fa-trash']) . ' ' . __d('admin', 'Delete'),
                            ['controller' => 'SystemicPages', 'action' => 'delete', h($systemicPage->id)],
                            [
                                'class' => 'btn btn-danger btn-xs mr-auto',
                                'confirm' => __d('admin', 'Are you sure you want to delete this systemic page?'),
                                'escape' => false
                            ]
                        );
                    }
                    ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?= $this->Form->create($systemicPage) ?>
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <?php
                            echo $this->Form->control('title', [
                                'label' => __d('admin', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('admin', 'Title')
                            ]);
                            echo $this->Form->control('short_name', [
                                'label' => __d('admin', 'Short name') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('admin', 'Short name')
                            ]);
                            echo $this->Form->control('notation', [
                                'label' => __d('admin', 'Notation') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('admin', 'Notation')
                            ]);
                            echo $this->Form->control('body', [
                                'label' => __d('admin', 'Body') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'rows' => 11,
                                'placeholder' => __d('admin', 'Body')
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
                                echo $this->AuthUser->link(
                                    __d('admin', 'Cancel'),
                                    ['controller' => 'SystemicPages', 'action' => 'index'],
                                    ['class' => 'btn btn-default mr-2']
                                );
                                echo $this->Form->submit(__d('admin', 'Save'));
                                ?>
                            </div>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
