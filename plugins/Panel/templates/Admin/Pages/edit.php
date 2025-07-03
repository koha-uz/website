<?php
$this->assign('title', h($page->title));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Pages'), 'url' => ['controller' => 'Pages', 'action' => 'index']],
    ['title' => h($page->title)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['pages']['dynamic'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([
    'formplugins/select2/select2.bundle',
    'formplugins/summernote/summernote'
], ['block' => true]);

echo $this->Html->script(
    [
        'formplugins/select2/select2.bundle',
        'formplugins/summernote/summernote',
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
        <i class="subheader-icon fal fa-pencil"></i> <?= h($page->title) ?>
    </h1>
</div>

<?= $this->Form->create($page, ['type' => 'file']) ?>
<div class="row">
    <div class="col-md-9">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <?php
                    echo $this->Form->control('title', [
                        'label' => ['class' => 'sr-only'],
                        'class' => 'form-control input-lg form-control-lg rounded-0 border-top-0 border-left-0 border-right-0 px-0',
                        'placeholder' => __d('panel', 'Title')
                    ]);

                    echo $this->Form->control('slug', [
                        'label' => ['class' => 'sr-only'],
                        'placeholder' => __d('panel', 'Slug')
                    ]);

                    echo $this->Form->control('body', [
                        'label' => ['class' => 'sr-only'],
                        'placeholder' => __d('panel', 'Body')
                    ]);
                    ?>
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
                    <?= $this->Published->control($page) ?>
                    <div class="d-flex border-top pt-3">
                        <?php
                        echo $this->Form->postLink(
                            $this->Html->tag('i', '', ['class' => 'fal fa-trash']) . ' ' . __d('panel', 'Delete'),
                            $this->Url->build(['action' => 'delete', h($page->id)]),
                            [
                                'class' => 'color-danger-900 mt-2 pr-2 mr-auto',
                                'confirm' => __d('panel', 'Are you sure you want to delete the service?'),
                                'block' => 'form-block',
                                'escape' => false
                            ]
                        );
                        echo $this->Form->submit(__d('panel', 'Save'));
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="panel-3" class="panel shadow-0" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Parent service') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?php
                    echo $this->Form->control('parent_id', [
                        'empty' => __d('panel', 'Select the parent'),
                        'label' => ['class' => 'sr-only'],
                        'class' => 'form-control select2 w-100'
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->element('meta_tags') ?>

<?= $this->Form->end() ?>
