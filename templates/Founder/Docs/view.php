<?php
$this->assign('title', h($doc->title));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Documents'), 'url' => ['controller' => 'Docs', 'action' => 'index']],
    ['title' => h($doc->title)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['docs'][1] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([
    'formplugins/summernote/summernote',
    'datagrid/datatables/datatables.bundle'
], ['block' => true]);

echo $this->Html->script([
        '/vendor/bundle.umd.min',
        'formplugins/summernote/summernote',
        'datagrid/datatables/datatables.bundle'
], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.datatable').dataTable({
        pageLength: 25,
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [4, 5, 6],
            orderable: false
        }],
        order: [[0, 'asc']]
    });

    $('.summernote').summernote(
        {
            height: '100px',
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
        <i class="subheader-icon fal fa-file-pdf"></i> <?= h($doc->title) ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'General') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?= $this->Html->link(__d('panel', 'Edit'), ['action' => 'edit', $doc->id], ['class' => 'btn btn-xs btn-warning']) ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <h2><?= $doc->title ?></h2>
                    <p><code><?= $doc->slug ?></code></p>
                    <hr/>
                    <div><?= $doc->body ?></div>
                </div>
            </div>
        </div>

        <div id="panel-2" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Versions') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#js-create-doc-version">
                        <?= __d('panel', 'Create new') ?>
                    </button>
                    <div class="modal fade" id="js-create-doc-version" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <?php
                            echo $this->Form->create($docVersion, [
                                'url' => [
                                    'controller' => 'DocVersions',
                                    'action' => 'add',
                                    $doc->id
                                ]
                            ]);
                            ?>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">
                                    <?= __d('panel', 'Create doc version') ?>
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php
                                    echo $this->Form->control('version', [
                                        'placeholder' => __d('panel', 'Version')
                                    ]);
                                    echo $this->Form->control('date_approved', [
                                        'label' => __d('panel', 'Date approved'),
                                    ]);
                                    echo $this->Form->control('is_current', [
                                        'placeholder' => __d('panel', 'Version')
                                    ]);
                                    ?>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_en" role="tab">English</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_ru" role="tab">Русский</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_uz" role="tab">O'zbek</a></li>
                                    </ul>
                                    <div class="tab-content p-3 border border-top-0">
                                        <div class="tab-pane fade show active" id="tab_en" role="tabpanel">
                                            <?php
                                            echo $this->Form->control('url', [
                                                'label' => __d('panel', 'URL'),
                                                'placeholder' => __d('panel', 'From file storage or Bucheon Cloud')
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
                                            echo $this->Form->control('_translations.ru.url', [
                                                'label' => __d('panel', 'URL'),
                                                'placeholder' => __d('panel', 'From file storage or Bucheon Cloud')
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
                                            echo $this->Form->control('_translations.uz.url', [
                                                'label' => __d('panel', 'URL'),
                                                'placeholder' => __d('panel', 'From file storage or Bucheon Cloud')
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
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __d('panel', 'Close') ?></button>
                                    <?= $this->Form->submit(__d('panel', 'Save')) ?>
                                </div>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all text-center" style="width: 5%"><?= __d('panel', 'Version') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Body') ?></th>
                                <th class="all"><?= __d('panel', 'Date approved') ?></th>
                                <th class="min-phone"><?= __d('panel', 'URL') ?></th>
                                <th class="min-phone text-center" style="width: 8%"><?= __d('panel', 'Is current') ?></th>
                                <th class="all" style="width: 5%"></th>
                                <th class="all" style="width: 5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($doc->doc_versions as $docVersion): ?>
                            <tr>
                                <td class="text-center"><?= $docVersion->version ?></td>
                                <td><?= $docVersion->body ?></td>
                                <td><?= $this->Time->i18nFormat($docVersion->date_approved, 'dd MMMM Y h:mm:ss') ?></td>
                                <td><?= $docVersion->url ?></td>
                                <td class="text-center">
                                    <?= $this->Panel->boolIcon($docVersion->is_current) ?>
                                </td>
                                <td class="text-center">
                                    <a href="#" data-toggle="modal" data-target="#js-edit-doc-version-<?= $docVersion->id ?>">
                                        <i class="fal fa-pencil"></i>
                                    </a>
                                    <div class="modal fade text-left" id="js-edit-doc-version-<?= $docVersion->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <?php
                                            echo $this->Form->create($docVersion, [
                                                'url' => [
                                                    'controller' => 'DocVersions',
                                                    'action' => 'edit',
                                                    $docVersion->id
                                                ]
                                            ]);
                                            ?>
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">
                                                    <?= __d('panel', 'Edit doc version №{0}', [$docVersion->version]) ?>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    echo $this->Form->control('version', [
                                                        'placeholder' => __d('panel', 'Version'),
                                                        'id' => 'version-' . $docVersion->id
                                                    ]);
                                                    echo $this->Form->control('date_approved', [
                                                        'label' => __d('panel', 'Date approved'),
                                                        'id' => 'date-approved-' . $docVersion->id
                                                    ]);
                                                    echo $this->Form->control('is_current', [
                                                        'placeholder' => __d('panel', 'Version'),
                                                        'id' => 'is-current-' . $docVersion->id
                                                    ]);
                                                    ?>
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_en-<?= $docVersion->id ?>" role="tab">English</a></li>
                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_ru-<?= $docVersion->id ?>" role="tab">Русский</a></li>
                                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_uz-<?= $docVersion->id ?>" role="tab">O'zbek</a></li>
                                                    </ul>
                                                    <div class="tab-content p-3 border border-top-0">
                                                        <div class="tab-pane fade show active" id="tab_en-<?= $docVersion->id ?>" role="tabpanel">
                                                            <?php
                                                            echo $this->Form->control('url', [
                                                                'label' => __d('panel', 'URL'),
                                                                'placeholder' => __d('panel', 'From file storage or Bucheon Cloud'),
                                                                'id' => 'url-en-' . $docVersion->id
                                                            ]);

                                                            echo $this->Form->control('body', [
                                                                'label' => ['class' => 'sr-only'],
                                                                'class' => 'summernote',
                                                                'placeholder' => __d('panel', 'Body'),
                                                                'id' => 'body-en-' . $docVersion->id
                                                            ]);
                                                            ?>
                                                        </div>
                                                        <div class="tab-pane fade" id="tab_ru-<?= $docVersion->id ?>" role="tabpanel">
                                                            <?php
                                                            echo $this->Form->control('_translations.ru.url', [
                                                                'label' => __d('panel', 'URL'),
                                                                'placeholder' => __d('panel', 'From file storage or Bucheon Cloud'),
                                                                'id' => 'url-ru-' . $docVersion->id
                                                            ]);

                                                            echo $this->Form->control('_translations.ru.body', [
                                                                'label' => ['class' => 'sr-only'],
                                                                'class' => 'summernote',
                                                                'placeholder' => __d('panel', 'Body'),
                                                                'id' => 'body-ru-' . $docVersion->id
                                                            ]);
                                                            ?>
                                                        </div>
                                                        <div class="tab-pane fade" id="tab_uz-<?= $docVersion->id ?>" role="tabpanel">
                                                            <?php
                                                            echo $this->Form->control('_translations.uz.url', [
                                                                'label' => __d('panel', 'URL'),
                                                                'placeholder' => __d('panel', 'From file storage or Bucheon Cloud'),
                                                                'id' => 'url-uz-' . $docVersion->id
                                                            ]);

                                                            echo $this->Form->control('_translations.uz.body', [
                                                                'label' => ['class' => 'sr-only'],
                                                                'class' => 'summernote',
                                                                'placeholder' => __d('panel', 'Body'),
                                                                'id' => 'body-uz-' . $docVersion->id
                                                            ]);
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __d('panel', 'Close') ?></button>
                                                    <?= $this->Form->submit(__d('panel', 'Save')) ?>
                                                </div>
                                            </div>
                                            <?= $this->Form->end() ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <?php
                                    echo $this->Form->postLink(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-trash']),
                                        $this->Url->build(['controller' => 'DocVersions', 'action' => 'delete', h($docVersion->id)]),
                                        [
                                            'class' => 'color-danger-900 mt-2 pr-2 mr-auto',
                                            'data-title' => __d('panel', 'Are you sure you want to delete the doc version?'),
                                            'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                                        ]
                                    );
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>