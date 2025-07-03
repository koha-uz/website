<?php
$this->assign('title', $post->title);

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Posts'), 'url' => ['controller' => 'Posts', 'action' => 'index']],
    ['title' => $post->title]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['posts'][1] = true;
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
            height: '600px',
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
        <i class="subheader-icon fal fa-newspaper"></i> <?= $post->title ?>
    </h1>
</div>

<?= $this->Form->create($post, ['type' => 'file']) ?>
<div class="row">
    <div class="col-md-9">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_ru" role="tab">Русский</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_uz" role="tab">O'zbek</a></li>
                    </ul>
                    <div class="tab-content p-3 border border-top-0">
                        <div class="tab-pane fade show active" id="tab_ru" role="tabpanel">
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
                            echo $this->Form->control('notes', [
                                'label' => ['class' => 'sr-only'],
                                'placeholder' => __d('panel', 'Notes'),
                                'rows' => 4,
                                'maxlength' => 150,
                                'templateVars' => ['help' => __d('panel', 'Available number of characters for input: {0}', 150)]
                            ]);
                            echo $this->Form->control('body', [
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
                                'placeholder' => __d('panel', 'Title')
                            ]);
                            echo $this->Form->control('_translations.uz.notes', [
                                'label' => ['class' => 'sr-only'],
                                'placeholder' => __d('panel', 'Notes'),
                                'rows' => 4,
                                'maxlength' => 150,
                                'templateVars' => ['help' => __d('panel', 'Available number of characters for input: {0}', 150)]
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
                <div class="pr-3">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-external-link']) . ' ' . __d('panel', 'View'),
                        ['_name' => 'post_view', 'slug' => h($post->slug)],
                        ['class' => 'color-info-800', 'escape' => false, 'target' => '_blank']
                    );
                    ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?= $this->Form->control('published') ?>
                    <div class="d-flex border-top pt-3">
                        <?php
                        echo $this->Form->postLink(
                            $this->Html->tag('i', '', ['class' => 'fal fa-trash']) . ' ' . __d('panel', 'Delete'),
                            $this->Url->build(['action' => 'delete', h($post->id)]),
                            [
                                'class' => 'color-danger-900 mt-2 pr-2 mr-auto',
                                'data-title' => __d('panel', 'Are you sure you want to delete the post?'),
                                'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
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
                <h2><?= __d('panel', 'Post category') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?php
                    echo $this->Form->control('post_category_id', [
                        'empty' => __d('panel', 'Select the category'),
                        'label' => ['class' => 'sr-only'],
                        'class' => 'form-control select2 w-100'
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <div id="panel-4" class="panel shadow-0" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Post tags') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?= $this->Tag->control(['label' => false]) ?>
                </div>
            </div>
        </div>

        <div id="panel-5" class="panel shadow-0" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Cover') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?php
                    echo $this->Form->control('youtubeId', [
                        'label' => __d('panel', 'Youtube Embed ID')
                    ]);

                    $requiredFile = function () use ($post) {
                        if (
                            is_object($post->cover) &&
                            $post->cover instanceof \Burzum\FileStorage\Model\Entity\FileStorage &&
                            $post->cover->isNew()
                        ) {
                            return true;
                        }
                        return false;
                    };
                    echo $this->Form->control('cover.file', [
                        'label' => __d('panel', 'Cover') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                        'type' => 'file',
                        'accept' => 'image/*,image/jpeg,image/png,image/tiff',
                        'escape' => false,
                        'required' => $requiredFile
                    ]);

                    if (!empty($post->cover)) {
                        echo $this->Image->display($post->cover, 'mini', ['class' => 'img-fluid mt-2']);
                        echo $this->Form->control('cover.old_file_id', [
                            'type' => 'hidden',
                            'value' => h($post->cover->id)
                        ]);
                    }
                    ?>
                    <div class="alert alert-warning mt-3 mb-0" role="alert">
                        <strong><?= __d('panel', 'Image Requirement!') ?></strong><br/>
                        <ul class="pl-3 mt-2 mb-0">
                            <li><?= __d('panel', 'Landscape orientation') ?></li>
                            <li><?= __d('panel', 'Width minimum 837 px') ?></li>
                            <li><?= __d('panel', 'Height minimum 523 px') ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->element('meta_tags', ['meta_tag' => $post->meta_tag]) ?>
<?= $this->Form->end() ?>
