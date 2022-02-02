<?php
$this->assign('title', __d('panel', 'Applicants'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Applicants')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['applicants'][1] = true;
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
            null,
            {className: 'text-center'}
        ],
        columnDefs: [{
            targets: [0, 8],
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
        order: [[2, 'asc']]
    });
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-users"></i> <?= __d('panel', 'Applicants') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100" id="js-datatable" data-ref="<?= $this->Url->build() ?>">
                        <thead class="bg-highlight">
                            <tr>
                                <th class="all text-center" style="width: 5%"><?= __d('panel', 'ID') ?></th>
                                <th class="all"><?= __d('panel', 'Full name') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Date of birth') ?></th>
                                <th class="min-desktop text-center"><?= __d('panel', 'Gender') ?></th>
                                <th class="min-tablet text-center"><?= __d('panel', 'Passport') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Phone number') ?></th>
                                <th class="min-desktop text-center"><?= __d('panel', 'Applications') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Date visited') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
