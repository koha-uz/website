<?php
$this->assign('title', __d('panel', 'Documents'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Files'), 'url' => ['action' => 'index']],
    ['title' => __d('panel', 'Documents')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['files']['types'][0] = true;
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
        <i class="subheader-icon fal  fa-file-word"></i> <?= __d('panel', 'Documents') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Documents') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?= $this->Html->link(__d('panel', 'Create new'), ['action' => 'add'], ['class' => 'btn btn-xs btn-success']) ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all" style="width: 5%"></th>
                                <th class="all"><?= __d('panel', 'Name') ?></th>
                                <th class="min-tablet" style="width: 10%"><?= __d('panel', 'Size') ?></th>
                                <th class="min-desktop w-25"><?= __d('panel', 'Mime Type') ?></th>
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
                                    echo $this->Form->postLink(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-trash']),
                                        $this->Url->build(['action' => 'delete', h($file->id)]),
                                        [
                                            'class' => 'color-danger-900 mt-2 pr-2 mr-auto',
                                            'data-title' => __d('panel', 'Are you sure you want to delete the file?'),
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
