<?php
$this->assign('title', h($service->title));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('admin', 'Services'), 'url' => ['controller' => 'Services', 'action' => 'index']],
    ['title' => h($service->title)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['services']['list'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([
    'formplugins/select2/select2.bundle'
], ['block' => true]);

echo $this->Html->script(
    [
        'formplugins/select2/select2.bundle',
        '/vendor/bundle.umd.min'
    ],
    ['block' => true]
);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('#title').on('input', function() {
        var text = $(this).val();
        var msg = slugify(text);
        $("#slug").val(msg);
    });

    $('.select2').select2();
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-pencil"></i> <?= h($service->title) ?>
    </h1>
</div>

<div class="row">
    <div class="col-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('admin', 'Edit Service') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?php
                    if ($this->AuthUser->hasAccess(['controller' => 'Services', 'action' => 'delete', h($service->id)])) {
                        echo $this->Form->deleteLink(
                            $this->Html->tag('i', '', ['class' => 'fal fa-trash']) . ' ' . __d('admin', 'Delete'),
                            ['controller' => 'Services', 'action' => 'delete', h($service->id)],
                            [
                                'class' => 'btn btn-danger btn-xs mr-auto',
                                'confirm' => __d('admin', 'Are you sure you want to delete this service?'),
                                'escape' => false
                            ]
                        );
                    }
                    ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?= $this->Form->create($service) ?>
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <?php
                            echo $this->Form->control('title', [
                                'label' => __d('admin', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('admin', 'Title')
                            ]);
                            echo $this->Form->control('slug', [
                                'label' => __d('admin', 'Slug') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('admin', 'Slug')
                            ]);
                            ?>

                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <?php
                                    echo $this->Form->control('parent_id', [
                                        'empty' => __d('admin', 'Select the parent'),
                                        'label' => __d('admin', 'Parent'),
                                        'class' => 'form-control select2 w-100'
                                    ]);
                                    ?>
                                </div>
                                <div class="col-lg-6">
                                    <?php
                                    echo $this->Form->control('header', [
                                        'empty' => __d('admin', 'Select the header template'),
                                        'label' => __d('admin', 'Header Template'),
                                        'options' => $this->Template->headerList()
                                    ]);
                                    ?>
                                </div>
                            </div>

                            <?php
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
                                    ['controller' => 'Services', 'action' => 'index'],
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
