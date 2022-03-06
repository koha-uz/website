<?php
$this->assign('title', __d('panel', 'Questions'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Questions')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['questions'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css('datagrid/datatables/datatables.bundle', ['block' => true]);
echo $this->Html->script('datagrid/datatables/datatables.bundle', ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.datatable').dataTable({
        serviceLength: 25,
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [6],
            orderable: false
        }],
        order: [
            [4, 'desc'],
            [3, 'desc']
        ]
    });
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-question"></i> <?= __d('panel', 'Questions') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Questions') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all"><?= __d('panel', 'Fullname') ?></th>
                                <th class="all"><?= __d('panel', 'Telephone') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Email') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Date created') ?></th>
                                <th class="all text-center"><?= __d('panel', 'New') ?></th>
                                <th class="all text-center"><?= __d('panel', 'Completed') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($questions as $question): ?>
                            <tr>
                                <td><?= $question->fullname ?></td>
                                <td><?= $question->telephone ?></td>
                                <td><?= $question->email ?></td>
                                <td data-order="<?= $question->date_created->format('U') ?>">
                                    <?= $this->Time->i18nFormat($question->date_created, 'd MMMM Y H:mm:ss') ?>
                                </td>
                                <td class="text-center" data-order="<?= $question->is_new ?>">
                                    <?= $this->Panel->boolIcon($question->is_new) ?>
                                </td>
                                <td class="text-center"><?= $this->Panel->boolIcon($question->is_completed) ?></td>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-eye']),
                                        ['action' => 'view', h($question->id)],
                                        ['escape' => false]
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
