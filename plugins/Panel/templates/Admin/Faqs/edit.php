<?php
$this->assign('title', h($faq->question));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('admin', 'Services'), 'url' => ['controller' => 'Services', 'action' => 'index']],
    ['title' => __d('admin', 'FAQ'), 'url' => ['controller' => 'Faqs', 'action' => 'index']],
    ['title' => h($faq->question)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['services']['faqs'] = true;
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
    $('#question').on('input', function() {
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
        <i class="subheader-icon fal fa-pencil"></i> <?= h($faq->question) ?>
    </h1>
</div>

<div class="row">
    <div class="col-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('admin', 'Edit FAQ') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?php
                    if ($this->AuthUser->hasAccess(['controller' => 'Faqs', 'action' => 'delete', h($faq->id)])) {
                        echo $this->Form->deleteLink(
                            $this->Html->tag('i', '', ['class' => 'fal fa-trash']) . ' ' . __d('admin', 'Delete'),
                            ['controller' => 'Faqs', 'action' => 'delete', h($faq->id)],
                            [
                                'class' => 'btn btn-danger btn-xs mr-auto',
                                'confirm' => __d('admin', 'Are you sure you want to delete this FAQ?'),
                                'escape' => false
                            ]
                        );
                    }
                    ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?= $this->Form->create($faq) ?>
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <?php
                            echo $this->Form->control('question', [
                                'label' => __d('admin', 'Question') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('admin', 'Question')
                            ]);
                            echo $this->Form->control('slug', [
                                'label' => __d('admin', 'Slug') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('admin', 'Slug')
                            ]);
                            echo $this->Form->control('service_id', [
                                'empty' => __d('admin', 'Select the service'),
                                'label' => __d('admin', 'Service') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'class' => 'form-control select2 w-100'
                            ]);
                            echo $this->Form->control('answer', [
                                'label' => __d('admin', 'Answer') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'rows' => 11,
                                'placeholder' => __d('admin', 'Answer')
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
                                    ['controller' => 'Faqs', 'action' => 'index'],
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