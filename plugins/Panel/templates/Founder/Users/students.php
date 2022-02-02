<?php
$params = Cake\Routing\Router::parseRequest($this->request);
$params['_ext'] = 'json';

$this->assign('title', __d('panel', 'Students'));

$status = '';
if (null !== $this->request->getParam('?')) {
    $status = $this->request->getParam('?')['status'] ? $this->request->getParam('?')['status'] : '';
}

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Students')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['students'][1] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css('datagrid/datatables/datatables.bundle', ['block' => true]);
echo $this->Html->script([
    'datagrid/datatables/datatables.bundle',
    'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'
], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    var datatable = $('#js-datatable');

    var table = datatable.dataTable({
        orderCellsTop: true,
        fixedHeader: true,
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        ajax: datatable.data('ref'),
        drawCallback: function( settings ) {
            $('[data-toggle="popover"]').popover();
        },
        deferRender: true,
        columns: [
            {className: 'text-center'},
            null,
            null,
            {className: 'text-center'},
            {className: 'text-center'},
            null,
            {className: 'text-center'},
            {className: 'text-center'}
        ],
        columnDefs: [{
            targets: [7],
            orderable: false
        }],
        lengthChange: false,
        dom:
            "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fad fa-file-excel mr-1"></i>Excel',
                className: 'btn btn-outline-success btn-xs ml-1',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7]
                }
            }
        ],
        pageLength: 50,
        order: [[1, 'asc']]
    });
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fas fa-user-graduate"></i> <?= __d('panel', 'Students') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <div class="alert alert alert-secondary">
            <div class="row">
                <div class="col-md-6 mb-2 mb-lg-0 col-lg-2">
                    <?php
                    echo $this->Form->control('status', [
                        'label' => ['class' => 'sr-only'],
                        'empty' => __d('panel', 'Choose status'),
                        'options' => $this->StudentStatuses->listOfStatuses(),
                        'value' => $status
                    ]);
                    ?>
                </div>
                <div class="col-12 col-lg-2">
                    <?php
                    $this->Form->setTemplates(['inputSubmit' => '<input class="btn btn-block btn-primary js-waves-off" type="{{type}}"{{attrs}}/>']);
                    echo $this->Form->button(
                        $this->Html->tag('i', '', ['class' => 'fal fa-search mr-1']) . __d('panel', 'Search'),
                        ['escapeTitle' => false, 'type' => 'submit', 'class' => 'btn btn-block btn-primary js-waves-off']
                    );
                    $this->Form->setTemplates(['inputSubmit' => '<input class="btn btn-primary js-waves-off" type="{{type}}"{{attrs}}/>']);
                    ?>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>

        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-container show">
                <div class="panel-hdr">
                    <h2><?= __d('panel', 'Students') ?></h2>
                    <div class="panel-toolbar ml-auto">
                        <?= $this->Html->link(__d('panel', 'Create new'), ['action' => 'student-add'], ['class' => 'btn btn-xs btn-success']) ?>
                    </div>
                </div>
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100" id="js-datatable" data-ref="<?= $this->Url->build($params) ?>">
                        <thead class="bg-highlight">
                            <tr>
                                <th class="min-tablet text-center" style="width: 8%"><?= __d('panel', 'Student No.') ?></th>
                                <th class="all"><?= __d('panel', 'Full name') ?></th>
                                <th class="min-desktop text-truncate" style="width: 20%"><?= __d('panel', 'Faculty') ?></th>
                                <th class="min-desktop text-center" style="width: 8%"><?= __d('panel', 'Group') ?></th>
                                <th class="min-desktop text-center" style="width: 8%"><?= __d('panel', 'Course') ?></th>
                                <th class="min-desktop" style="width: 15%"><?= __d('panel', 'Date visited') ?></th>
                                <th class="min-tablet text-center" style="width: 8%"><?= __d('panel', 'Status') ?></th>
                                <th class="all text-center" style="width: 5%">#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
