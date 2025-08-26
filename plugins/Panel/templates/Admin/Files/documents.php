<?php
$this->assign('title', __d('admin', 'Documents'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('admin', 'Files'), 'url' => ['action' => 'index']],
    ['title' => __d('admin', 'Documents')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['files']['types']['documents'] = true;
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
            targets: [0, 4],
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
        <i class="subheader-icon fal  fa-file-word"></i> <?= __d('admin', 'Documents') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('admin', 'Documents') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?= $this->AuthUser->link(__d('admin', 'Create new'), ['controller' => 'Files', 'action' => 'add'], ['class' => 'btn btn-xs btn-success']) ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all" style="width: 5%"></th>
                                <th class="all"><?= __d('admin', 'Name') ?></th>
                                <th class="min-tablet" style="width: 10%"><?= __d('admin', 'Size') ?></th>
                                <th class="min-desktop w-25"><?= __d('admin', 'Mime Type') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($files as $file): ?>
                            <tr>
                                <td class="text-center">
                                    <button type="button" class="btn btn-link fal fa-copy copy" data-clipboard-text="<?= ASSETS . h($file->path) ?>"></button>
                                </td>
                                <td>
                                    <strong><?= h($file->filename) ?></strong>
                                    <code class="d-block"><?= ASSETS . h($file->path) ?></code>
                                </td>
                                <td><?= $this->Files->fileSizeConvert(h($file->filesize)) ?></td>
                                <td><?= h($file->mime_type) ?></td>
                                <td class="text-center">
                                    <?php
                                    if ($this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'delete', h($file->id)])) {
                                        echo $this->Form->deleteLink(
                                            $this->Html->tag('i', '', ['class' => 'fal fa-trash']),
                                            ['controller' => 'Files', 'action' => 'delete', h($file->id)],
                                            [
                                                'escape' => false,
                                                'class' => 'color-danger-900',
                                                'confirm' => __d('admin', 'Are you sure you want to delete the file?')
                                            ]
                                        );
                                    }
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
