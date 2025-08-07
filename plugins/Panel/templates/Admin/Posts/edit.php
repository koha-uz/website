<?php
$this->assign('title', h($post->title));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('admin', 'Posts'), 'url' => ['controller' => 'Posts', 'action' => 'index']],
    ['title' => h($post->title)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['posts']['list'] = true;
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
        <i class="subheader-icon fal fa-pencil"></i> <?= h($post->title) ?>
    </h1>
</div>

<div class="row">
    <div class="col-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('admin', 'Edit Post') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?php
                    echo $this->Form->deleteLink(
                        $this->Html->tag('i', '', ['class' => 'fal fa-trash']) . ' ' . __d('panel', 'Delete'),
                        ['controller' => 'Posts', 'action' => 'delete', h($post->id)],
                        [
                            'class' => 'btn btn-danger btn-xs mr-auto',
                            'confirm' => __d('panel', 'Are you sure you want to delete this post?'),
                            'escape' => false
                        ]
                    );
                    ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?= $this->Form->create($post, ['type' => 'file']) ?>
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <?php
                            echo $this->Form->control('title', [
                                'label' => __d('admin', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Title')
                            ]);
                            echo $this->Form->control('slug', [
                                'label' => __d('admin', 'Slug') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Slug')
                            ]);
                            ?>

                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <?php
                                    echo $this->Form->control('post_category_id', [
                                        'empty' => __d('panel', 'Select the post category'),
                                        'label' => __d('admin', 'Category') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                        'escape' => false,
                                        'class' => 'form-control select2 w-100'
                                    ]);
                                    ?>
                                </div>
                                <div class="col-lg-6">
                                    <?php
                                    echo $this->Tag->control([
                                        'label' => __d('admin', 'Tags')
                                    ]);
                                    ?>
                                </div>
                            </div>

                            <?php
                            echo $this->Form->control('body', [
                                'label' => __d('admin', 'Body') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'rows' => 24,
                                'placeholder' => __d('panel', 'Body')
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow-0 mb-4">
                                <div class="card-header py-2">
                                    <h3 class="card-title"><?= __d('panel', 'Illustration') ?></h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (!empty($post->cover)) {
                                        echo $this->Html->tag('div',
                                            $this->Image->display($post->cover, '400x250', ['class' => 'img-fluid mb-3']),
                                            ['class' => 'text-center']
                                        );
                                        echo $this->Form->control('cover.old_file_id', [
                                            'type' => 'hidden',
                                            'value' => h($post->cover->id)
                                        ]);
                                    }
                                    echo $this->Form->control('cover.file', [
                                        'label' => __d('admin', 'Cover') . (empty($post->cover) ? $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']) : ''),
                                        'type' => 'file',
                                        'accept' => 'image/*,image/jpeg,image/png,image/tiff',
                                        'escape' => false,
                                        'required' => empty($post->cover) ? true : false
                                    ]);

                                    echo $this->Form->control('youtubeId', [
                                        'label' => __d('admin', 'Youtube Embed ID')
                                    ]);
                                    ?>
                                </div>
                            </div>

                            <?= $this->element('MetaTags/default') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="border-top pt-3 text-right">
                                <?php
                                echo $this->Html->link(
                                    __d('admin', 'Cancel'),
                                    ['controller' => 'Posts', 'action' => 'index'],
                                    ['class' => 'btn btn-default mr-2']
                                );
                                echo $this->Form->submit(__d('panel', 'Save'));
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