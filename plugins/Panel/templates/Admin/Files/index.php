<?php
$this->assign('title', __d('panel', 'Files'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Files')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['files']['list'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css('datagrid/datatables/datatables.bundle', ['block' => true]);
echo $this->Html->script(
    ['datagrid/datatables/datatables.bundle', '/vendor/clipboard.min'],
    ['block' => true]
);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.datatable').dataTable({
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [0, 7],
            orderable: false
        }],
        order: false
    });

    new ClipboardJS('.copy');
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-file"></i> <?= __d('panel', 'Files') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Files') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?= $this->Html->link(__d('panel', 'Create new'), ['action' => 'add'], ['class' => 'btn btn-xs btn-success']) ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all"></th>
                                <th class="all"><?= __d('panel', 'Name') ?></th>
                                <th class="min-desktop text-center"><?= __d('panel', 'Model') ?></th>
                                <th class="min-desktop text-center"><?= __d('panel', 'Collection') ?></th>
                                <th class="text-center min-desktop"><?= __d('panel', 'Size') ?></th>
                                <th class="text-center min-desktop"><?= __d('panel', 'Mime Type') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Date Created') ?></th>
                                <th class="min-desktop"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($files as $file): ?>
                            <tr>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-link fal fa-copy copy" data-clipboard-text="<?= h($file->url) ?>"></button>
                                </td>
                                <td>
                                    <strong><?= h($file->filename) ?></strong>
                                    <code class="d-block"><?= h($file->url) ?></code>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    if (isset($file->model)) {
                                        echo $file->model;
                                    } else {
                                        echo $this->Panel->notSet('');
                                    }
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    if (isset($file->collection)) {
                                        echo $file->collection;
                                    } else {
                                        echo $this->Panel->notSet('');
                                    }
                                    ?>
                                </td>
                                <td class="text-center align-middle"><?= $this->Files->fileSizeConvert(h($file->filesize)) ?></td>
                                <td class="text-center align-middle"><?= h($file->mime_type) ?></td>
                                <td class="align-middle">
                                    <?php
                                    if (isset($file->created)) {
                                        echo $file->created->format('Y-m-d H:i:s');
                                    } else {
                                        echo $this->Panel->notSet('');
                                    }
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    echo $this->Form->deleteLink(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-trash']),
                                        ['action' => 'delete', h($file->id)],
                                        [
                                            'escape' => false,
                                            'class' => 'color-danger-900',
                                            'confirm' => __d('panel', 'Are you sure you want to delete the file?')
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
