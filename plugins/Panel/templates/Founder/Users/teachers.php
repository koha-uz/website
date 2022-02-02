<?php
$this->assign('title', __d('panel', 'Teachers'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Teachers')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['teachers'][1] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css('datagrid/datatables/datatables.bundle', ['block' => true]);
echo $this->Html->script('datagrid/datatables/datatables.bundle', ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    var table = $('.datatable').dataTable({
        orderCellsTop: true,
        fixedHeader: true,
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [0, 6, 7],
            orderable: false
        }],
        pageLength: 25,
        order: [[1, 'asc']]
    });
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-chalkboard-teacher"></i> <?= __d('panel', 'Teachers') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Teachers') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?= $this->Html->link(__d('panel', 'Create new'), ['action' => 'teacher-add'], ['class' => 'btn btn-xs btn-success']) ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead class="bg-highlight">
                            <tr>
                                <th class="all text-center" style="width: 5%">#</th>
                                <th class="all"><?= __d('panel', 'Full name') ?></th>
                                <th class="min-desktop text-center" style="width: 10%"><?= __d('panel', 'Academic degree') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'University') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Date visited') ?></th>
                                <th class="min-desktop text-center" style="width: 5%"><?= __d('panel', 'Status') ?></th>
                                <th class="all text-center" style="width: 5%"><?= __d('panel', 'Scores') ?></th>
                                <th class="all" style="width: 5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->tag('button', $this->Html->tag('i', '', ['class' => 'fal fa-user-lock']), [
                                        'class' => 'btn btn-outline-default btn-sm btn-icon rounded-circle waves-effect waves-themed',
                                        'data-toggle' => 'popover',
                                        'data-trigger' => 'click',
                                        'data-html' => 'true',
                                        'data-content' => '<dl class="row">' .
                                            '<dt class="col-6 text-truncate">' . __d('panel', 'Username') . '</dt>' .
                                            '<dd class="col-6">' . h($user->username) . '</dd>' .
                                            '<dt class="col-6 text-truncate">' . __d('panel', 'Password') . '</dt>' .
                                            '<dd class="col-6">but2019*# (' . __d('panel', 'default') . ')</dd>' .
                                        '</dl>',
                                        'title' => __d('panel', 'Access data (default)')
                                    ]);
                                    ?>
                                </td>
                                <td><?= mb_strtoupper(h($user->user_profile->full_name)) ?></td>
                                <td class="text-center"><?= $this->TeacherProfiles->degree($user->teacher_profile->academic_degree) ?></td>
                                <td><?= h($user->teacher_profile->university_name) ?></td>
                                <td>
                                    <?php
                                    if ($user->has('date_visited')) {
                                        echo $user->date_visited->i18nFormat('d MMMM Y HH:mm');
                                    }
                                    ?>
                                </td>
                                <td class="text-center" data-order="<?= $user->is_active ?>"><?= $this->Panel->boolIcon($user->is_active) ?></td>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fad fa-star-half']),
                                        ['controller' => 'StudyTeacherSubjects', 'action' => 'index', h($user->id)],
                                        ['escape' => false, 'class' => 'text-warning fs-xl']
                                    );
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                        ['action' => 'teacherEdit', h($user->id)],
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
