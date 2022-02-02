<?php
$this->assign('title', __d('panel', '{0} — Student', mb_strtoupper(h($user->user_profile->full_name))));

$this->start('breadcrumbs');
$breadcrumbs[] = ['title' => __d('panel', 'Students'), 'url' => ['action' => 'students']];
if (!empty($user->student_profile->student_groups[0])) {
    $breadcrumbs[] = [
        'title' => __d('panel', 'Study group #{0}', $user->student_profile->student_groups[0]->study_group->abbr),
        'url' => ['controller' => 'StudyGroups', 'action' => 'view', $user->student_profile->student_groups[0]->study_group_id]
    ];
}
$breadcrumbs[] = ['title' => __d('panel', mb_strtoupper(h($user->user_profile->full_name)))];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['students'][1] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css(['datagrid/datatables/datatables.bundle', 'formplugins/select2/select2.bundle'], ['block' => true]);
echo $this->Html->script(['datagrid/datatables/datatables.bundle', 'formplugins/select2/select2.bundle'], ['block' => true]);
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
            targets: [4, 5],
            orderable: false
        }],
        order: [[1, 'desc']]
    });

    $('.select2').select2();
    $('#js-study-group-id').select2({
        dropdownParent: $('#js-transfer-modal')
    });

    $('#js-study-group-status-id').select2({
        dropdownParent: $('#js-change-status-modal')
    });

    $('#js-language-test-id').on('change', function(e){
        var url = $('#js-language-test-id').data('url');
        var value = $('#js-language-test-id').val();

        $.ajax({
            url: url,
            type: 'post',
            data: 'language_test_id=' + value,
            cache: false,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function(response) {
                if (response) {
                    $('#js-language-test-level-id').replaceWith(response.content);
                }
            },
            error: function(error) {

            }
        });
    });

    $('#js-change-group-is-decree').on('change', function(){
        var $changeGroupDecreeContainer = $('#js-change-group-decree-container');
        if ($(this).prop('checked')) {
            $changeGroupDecreeContainer.removeClass('d-none');
            $changeGroupDecreeContainer.find('input').prop('disabled', false);
        } else {
            $changeGroupDecreeContainer.addClass('d-none');
            $changeGroupDecreeContainer.find('input').prop('disabled', true);
        }
    });

    $('#js-change-status-contract-affect').on('change', function(){
        var $changeStatusContractAffectContainer = $('#js-change-status-contract-affect-container');
        if ($(this).prop('checked')) {
            $changeStatusContractAffectContainer.removeClass('d-none');
            $changeStatusContractAffectContainer.find('input, select').prop('disabled', false);
        } else {
            $changeStatusContractAffectContainer.addClass('d-none');
            $changeStatusContractAffectContainer.find('input, select').prop('disabled', true);
        }
    });

    $('#js-change-status-is-create-contract-order').on('change', function(){
        var $changeStatusCreateContractOrderContainer = $('#js-change-status-create-contract-order-container');
        if ($(this).prop('checked')) {
            $changeStatusCreateContractOrderContainer.removeClass('d-none');
            $changeStatusCreateContractOrderContainer.find('select').prop('disabled', false);
        } else {
            $changeStatusCreateContractOrderContainer.addClass('d-none');
            $changeStatusCreateContractOrderContainer.find('select').prop('disabled', true);
        }
    });
});
</script>
<?php $this->end(); ?>

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-3">
                <div class="card mb-g rounded-top">
                    <div class="row no-gutters row-grid">
                        <div class="col-12">
                            <div class="d-flex flex-column align-items-center justify-content-center p-3">
                                <?php
                                if (!empty($user->photo)) {
                                    list($type, ) = explode('/', $user->photo->mime_type);
                                    if ($type == 'image') {
                                        if (file_exists($this->Image->imageUrl($user->photo))) {
                                            echo $this->Image->display($user->photo, null, ['style' => 'width: 150px', 'class' => 'rounded-circle shadow-2 img-thumbnail']);
                                        } else {
                                            echo $this->Html->image('avatar.png', ['class' => 'rounded-circle shadow-2 img-thumbnail mb-1']);
                                        }
                                    } else {
                                        echo $this->Html->image('avatar.png', ['class' => 'rounded-circle shadow-2 img-thumbnail mb-1']);
                                        echo $this->Html->link('Photo link', $this->Image->imageUrl($user->photo, null));
                                    }
                                } else {
                                    echo $this->Html->image('avatar.png', ['class' => 'rounded-circle shadow-2 img-thumbnail']);
                                }
                                ?>
                                <h5 class="mb-0 fw-700 text-center mt-3">
                                    <span class="text-uppercase"><?= mb_strtoupper(h($user->user_profile->full_name)) ?></span>
                                    <small class="text-muted mb-0"><?= __d('panel', 'Student No. {0}', h($user->student_profile->student_id)) ?></small>
                                </h5>
                                <div class="mt-1"><?= $this->StudentStatuses->currentStatusIcon($user->student_profile->student_statuses) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card mb-g rounded-top">
                    <div class="card-header py-2 px-3 d-flex align-items-center flex-wrap">
                        <div class="card-title d-none d-lg-block"><?= __d('panel', 'General information') ?></div>

                        <?php if (!empty($user->student_profile->student_statuses)): ?>
                        <div class="ml-auto">
                            <?php if (!empty($user->student_profile->student_groups) && $this->StudentStatuses->isLearns($user->student_profile->student_statuses[0])): ?>
                            <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#js-transfer-modal"><?= __d('panel', 'Transfer') ?></button>
                            <div class="modal fade" id="js-transfer-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <?= $this->Form->create(null, ['url' => ['controller' => 'StudentGroups', 'action' => 'add', $user->student_profile->id], 'type' => 'file']) ?>
                                        <div class="modal-header p-3">
                                            <h5 class="modal-title"><?= __d('panel', 'Transfer to another faculty or group') ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <div class="alert-primary p-3 mb-3">
                                                <dl class="row mb-0">
                                                    <dt class="col-md-3 text-truncate"><?= __d('panel', 'Faculty') ?></dt>
                                                    <dd class="col-md-9 mb-2"><?= $user->student_profile->student_groups[0]->study_group->study_faculty->faculty->title ?></dd>
                                                    <dt class="col-md-3 text-truncate"><?= __d('panel', 'Group') ?></dt>
                                                    <dd class="col-md-9 mb-2">
                                                        <?php
                                                        echo $this->Html->link(
                                                            $this->StudyGroups->abbr($user->student_profile->student_groups[0]->study_group),
                                                            ['controller' => 'StudyGroups', 'action' => 'view', $user->student_profile->student_groups[0]->study_group->id]
                                                        );
                                                        ?>
                                                        <span>
                                                            (<?php
                                                            if ($this->StudentStatuses->isLearns($user->student_profile->student_statuses[0])) {
                                                                echo __d('panel', 'enrolled in {0}', $user->student_profile->student_groups[0]->study_year->title);
                                                            } else {
                                                                echo __d('panel', 'excluded in {0}', $user->student_profile->student_groups[0]->study_year->title);
                                                            }
                                                            ?>)
                                                        </span>
                                                    </dd>
                                                </dl>
                                            </div>

                                            <?php if ($this->StudentGroups->isCurrent2ndSemester($studyYearCurrent, $user->student_profile->student_groups[0])): ?>
                                            <div class="alert alert-danger m-3 p-3">
                                                <?= __d('panel', 'From the 2nd semester of the {0}, there has already been a transition to another group or faculty. The transition can only be made from next year.', $studyYearCurrent->full_name) ?>
                                            </div>
                                            <?php else: ?>
                                            <div class="alert alert-warning m-3 p-3">
                                                <?= __d('panel', 'Transfer to another faculty or group can be carried out at the beginning of the academic year or between semesters. The new study group must already be on the next course before the student grade records are posted.') ?>
                                            </div>

                                            <div class="m-3">
                                                <div class="alert-secondary p-3 mb-2">
                                                    <dl class="row mb-0">
                                                        <dt class="col-4 col-sm-3"><?= __d('panel', 'Study year') ?></dt>
                                                        <dd class="col-8 col-sm-9">
                                                            <?php
                                                            echo $this->Form->control('study_year_id', [
                                                                'type' => 'hidden',
                                                                'value' => $studyYearCurrent->id
                                                            ]);
                                                            echo $studyYearCurrent->full_name;
                                                            ?>
                                                        </dd>
                                                        <dt class="col-4 col-sm-3"><?= __d('panel', 'Semester') ?></dt>
                                                        <dd class="col-8 col-sm-9 mb-0">
                                                            <?php
                                                            if (
                                                                $this->StudentGroups->isCurrent($studyYearCurrent, $user->student_profile->student_groups[0]) &&
                                                                ($user->student_profile->student_groups[0]->semester == '1')
                                                            ) {
                                                                $semesterForChangeGroup = '2';
                                                            } else {
                                                                $semesterForChangeGroup = '1';
                                                                if ($this->ContractOrders->isByStudyYear($studyYearCurrent, $user->student_profile->contract_orders[0])) {
                                                                    $semesterForChangeGroup = '2';
                                                                }
                                                            }
                                                            echo __d('panel', '{0} semester', $semesterForChangeGroup);
                                                            echo $this->Form->control('semester', [
                                                                'type' => 'hidden',
                                                                'value' => $semesterForChangeGroup
                                                            ]);
                                                            ?>
                                                        </dd>
                                                    </dl>
                                                </div>
                                                <?php
                                                $this->Form->setTemplates(['inputContainer' => '<div class="form-group mb-2{{required}}">{{content}}</div>']);
                                                echo $this->Form->control('study_group_id', [
                                                    'label' => ['class' => 'sr-only'],
                                                    'empty' => __d('panel', 'Select study group'),
                                                    'id' => 'js-study-group-id',
                                                    'class' => 'form-control w-100'
                                                ]);
                                                echo $this->Form->control('notes', [
                                                    'label' => ['class' => 'sr-only'],
                                                    'type' => 'textarea',
                                                    'rows' => 2,
                                                    'placeholder' => __d('panel', 'Notes')
                                                ]);
                                                $this->Form->setTemplates(['checkboxContainer' => '<div class="form-group custom-control custom-checkbox mb-0">{{content}}</div>']);
                                                echo $this->Form->control('split_contract_order', [
                                                    'label' => __d('panel', 'Split the current contract'),
                                                    'type' => 'checkbox'
                                                ]);
                                                $this->Form->setTemplates(['checkboxContainer' => '<div class="form-group custom-control custom-checkbox">{{content}}</div>']);
                                                ?>
                                                <hr/>
                                                <?php
                                                $this->Form->setTemplates(['checkboxContainer' => '<div class="form-group custom-control custom-checkbox mb-0">{{content}}</div>']);
                                                echo $this->Form->control('is_contract_affect', [
                                                    'label' => __d('panel', 'On the basis of the decree'),
                                                    'id' => 'js-change-group-is-decree',
                                                    'class' => 'mb-0',
                                                    'type' => 'checkbox'
                                                ]);
                                                $this->Form->setTemplates(['checkboxContainer' => '<div class="form-group custom-control custom-checkbox">{{content}}</div>']);
                                                ?>
                                                <div id="js-change-group-decree-container" class="d-none mt-3">
                                                    <div class="h5"><?= __d('panel', 'The order on the basis of which the transfer was carried out') ?></div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-2">
                                                            <?php
                                                            echo $this->Form->control('decree.number', [
                                                                'label' => __d('panel', 'Number'),
                                                                'disabled' => true
                                                            ]);
                                                            ?>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            echo $this->Form->control('decree.date_effective', [
                                                                'type' => 'date',
                                                                'label' => __d('panel', 'Effective date'),
                                                                'disabled' => true
                                                            ]);
                                                            ?>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            echo $this->Form->control('decree.scan.file', [
                                                                'type' => 'file',
                                                                'label' => __d('panel', 'Scan'),
                                                                'disabled' => true
                                                            ]);
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php $this->Form->setTemplates(['inputContainer' => '<div class="form-group{{required}}">{{content}}</div>']); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __d('panel', 'Close') ?></button>
                                            <?php
                                            if (!$this->StudentGroups->isCurrent2ndSemester($studyYearCurrent, $user->student_profile->student_groups[0])) {
                                                echo $this->Form->submit(__d('panel', 'Complete translation'));
                                            }
                                            ?>
                                        </div>
                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <button type="button" class="btn btn-xs btn-danger ml-2" data-toggle="modal" data-target="#js-change-status-modal"><?= __d('panel', 'Change status') ?></button>
                            <div class="modal fade" id="js-change-status-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <?= $this->Form->create($studentStatus, ['url' => ['controller' => 'StudentStatuses', 'action' => 'add', $user->student_profile->id], 'type' => 'file']) ?>
                                        <div class="modal-header p-3">
                                            <h5 class="modal-title"><?= __d('panel', 'Change of student status') ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <?php if ($this->StudentStatuses->isLearns($user->student_profile->student_statuses[0])): ?>
                                            <div class="alert-primary p-3 mb-3">
                                                <dl class="row mb-0 fs-lg">
                                                    <dt class="col-md-4 text-truncate"><?= __d('panel', 'Current status') ?></dt>
                                                    <dd class="col-md-8 mb-0"><?= $this->StudentStatuses->currentStatusIcon($user->student_profile->student_statuses) ?></dd>
                                                </dl>
                                            </div>
                                            <div class="alert alert-danger m-3 p-3">
                                                <?= __d('panel', 'A change in status may affect the further assignment of grades to the student, exclusion from the performance ratings and current contract.') ?>
                                            </div>
                                            <div class="m-3">
                                                <div class="alert-secondary p-3 mb-2">
                                                    <h5 class="fw-700"><?= __d('panel', 'The moment of the status change') ?></h5>
                                                    <hr class="my-2" />
                                                    <dl class="row mb-0">
                                                        <dt class="col-4 col-sm-3"><?= __d('panel', 'Study year') ?></dt>
                                                        <dd class="col-8 col-sm-9">
                                                            <?php
                                                            echo $this->Form->control('study_year_id', [
                                                                'type' => 'hidden',
                                                                'value' => $studyYearCurrent->id
                                                            ]);
                                                            echo $studyYearCurrent->full_name;
                                                            ?>
                                                        </dd>
                                                        <dt class="col-4 col-sm-3"><?= __d('panel', 'Semester') ?></dt>
                                                        <dd class="col-8 col-sm-9 mb-0">
                                                            <?php
                                                            echo $this->Form->control('semester', [
                                                                'label' => ['class' => 'sr-only'],
                                                                'options' => [
                                                                    '1' => __d('panel', '{0} semester', 1),
                                                                    '2' => __d('panel', '{0} semester', 2)
                                                                ]
                                                            ]);
                                                            ?>
                                                        </dd>
                                                    </dl>
                                                </div>
                                                <?php
                                                $this->Form->setTemplates(['inputContainer' => '<div class="form-group mb-2{{required}}">{{content}}</div>']);
                                                echo $this->Form->control('status', [
                                                    'label' => ['class' => 'sr-only'],
                                                    'options' => $this->StudentStatuses->listOfStatusesWithoutCurrent($user->student_profile->student_statuses)
                                                ]);
                                                echo $this->Form->control('notes', [
                                                    'label' => ['class' => 'sr-only'],
                                                    'type' => 'textarea',
                                                    'rows' => 2,
                                                    'placeholder' => __d('panel', 'Notes')
                                                ]);
                                                ?>

                                                <hr/>
                                                <div class="alert border-secondary bg-transparent alert-dismissible p-3 mb-2">
                                                    <?php
                                                    $this->Form->setTemplates(['checkboxContainer' => '<div class="form-group custom-control custom-checkbox mb-0">{{content}}</div>']);
                                                    echo $this->Form->control('is_contract_affect', [
                                                        'label' => __d('panel', 'Will affect the contract'),
                                                        'id' => 'js-change-status-contract-affect',
                                                        'class' => 'mb-0',
                                                        'type' => 'checkbox'
                                                    ]);
                                                    $this->Form->setTemplates(['checkboxContainer' => '<div class="form-group custom-control custom-checkbox">{{content}}</div>']);
                                                    ?>

                                                    <div class="d-none mt-3" id="js-change-status-contract-affect-container">
                                                        <div class="alert alert-warning p-2 mb-2">
                                                            <?php
                                                            $semester = ($user->student_profile->contract_orders[0]->semester == '2') ? __d('panel', '2nd semester') : __d('panel', '1st semester');
                                                            echo __d(
                                                                'panel',
                                                                'Indicate the number of school days attended by the student since the beginning of the {0} of the {1}',
                                                                $semester, $user->student_profile->contract_orders[0]->study_course->study_year->full_name
                                                            );
                                                            ?>
                                                        </div>
                                                        <?php
                                                        echo $this->Form->control('number_of_days', [
                                                            'label' => ['class' => 'sr-only'],
                                                            'placeholder' => __d('panel', 'Number of days')
                                                        ]);
                                                        ?>
                                                    </div>
                                                </div>

                                                <hr/>
                                                <div class="h5"><?= __d('panel', 'Order on the basis of which the student\'s status was changed') ?></div>
                                                <div class="row mt-2">
                                                    <div class="col-md-2">
                                                        <?php
                                                        echo $this->Form->control('decree.number', [
                                                            'label' => __d('panel', 'Number')
                                                        ]);
                                                        ?>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <?php
                                                        echo $this->Form->control('decree.date_effective', [
                                                            'type' => 'date',
                                                            'label' => __d('panel', 'Effective date')
                                                        ]);
                                                        ?>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <?php
                                                        echo $this->Form->control('decree.scan.file', [
                                                            'type' => 'file',
                                                            'label' => __d('panel', 'Scan')
                                                        ]);
                                                        ?>
                                                    </div>
                                                </div>

                                                <?php $this->Form->setTemplates(['inputContainer' => '<div class="form-group{{required}}">{{content}}</div>']); ?>
                                            </div>
                                            <?php else: ?>
                                            <div class="m-3">
                                                <div class="alert-secondary p-3 mb-2">
                                                    <h5 class="fw-700"><?= __d('panel', 'The moment of the status change') ?></h5>
                                                    <hr class="my-2" />
                                                    <dl class="row mb-0">
                                                        <dt class="col-4 col-sm-3"><?= __d('panel', 'Study year') ?></dt>
                                                        <dd class="col-8 col-sm-9">
                                                            <?php
                                                            echo $this->Form->control('study_year_id', [
                                                                'type' => 'hidden',
                                                                'value' => $studyYearCurrent->id
                                                            ]);
                                                            echo $studyYearCurrent->full_name;
                                                            ?>
                                                        </dd>
                                                        <dt class="col-4 col-sm-3"><?= __d('panel', 'Semester') ?></dt>
                                                        <dd class="col-8 col-sm-9 mb-0">
                                                            <?php
                                                            echo $this->Form->control('semester', [
                                                                'label' => ['class' => 'sr-only'],
                                                                'options' => [
                                                                    '1' => __d('panel', '{0} semester', 1),
                                                                    '2' => __d('panel', '{0} semester', 2)
                                                                ]
                                                            ]);
                                                            ?>
                                                        </dd>
                                                    </dl>
                                                </div>

                                                <?php
                                                $this->Form->setTemplates(['inputContainer' => '<div class="form-group mb-2{{required}}">{{content}}</div>']);
                                                echo $this->Form->control('status', [
                                                    'type' => 'hidden',
                                                    'value' => '1'
                                                ]);
                                                echo $this->Form->control('study_group_id', [
                                                    'label' => ['class' => 'sr-only'],
                                                    'empty' => __d('panel', 'Select study group'),
                                                    'id' => 'js-study-group-status-id',
                                                    'class' => 'form-control w-100'
                                                ]);
                                                echo $this->Form->control('notes', [
                                                    'label' => ['class' => 'sr-only'],
                                                    'type' => 'textarea',
                                                    'rows' => 2,
                                                    'placeholder' => __d('panel', 'Notes')
                                                ]);
                                                $this->Form->setTemplates(['checkboxContainer' => '<div class="form-group custom-control custom-checkbox mb-0">{{content}}</div>']);
                                                echo $this->Form->control('is_create_contract_order', [
                                                    'label' => __d('panel', 'Create a contract'),
                                                    'type' => 'checkbox',
                                                    'id' => 'js-change-status-is-create-contract-order'
                                                ]);
                                                $this->Form->setTemplates(['checkboxContainer' => '<div class="form-group custom-control custom-checkbox">{{content}}</div>']);
                                                ?>

                                                <div id="js-change-status-create-contract-order-container" class="d-none mt-3">
                                                    <?php
                                                    echo $this->Form->control('exchange_rate_id', [
                                                        'empty' => __d('panel', 'Select currency rate'),
                                                        'label' => ['class' => 'sr-only'],
                                                        'placeholder' => __d('panel', 'Exchange rate')
                                                    ]);
                                                    ?>
                                                </div>

                                                <hr/>
                                                <div class="h5"><?= __d('panel', 'Order on the basis of which the student\'s status was changed') ?></div>
                                                <div class="row mt-2">
                                                    <div class="col-md-2">
                                                        <?php
                                                        echo $this->Form->control('decree.number', [
                                                            'label' => __d('panel', 'Number')
                                                        ]);
                                                        ?>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <?php
                                                        echo $this->Form->control('decree.date_effective', [
                                                            'type' => 'date',
                                                            'label' => __d('panel', 'Effective date')
                                                        ]);
                                                        ?>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <?php
                                                        echo $this->Form->control('decree.scan.file', [
                                                            'type' => 'file',
                                                            'label' => __d('panel', 'Scan')
                                                        ]);
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php $this->Form->setTemplates(['inputContainer' => '<div class="form-group{{required}}">{{content}}</div>']); ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __d('panel', 'Close') ?></button>
                                            <?= $this->Form->submit(__d('panel', 'Change status')) ?>
                                        </div>
                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php if (!empty($user->student_profile->student_groups)): ?>
                            <div class="col-xl-7">
                                <dl class="row mb-0">
                                    <dt class="col-md-3 text-truncate"><?= __d('panel', 'Faculty') ?></dt>
                                    <dd class="col-md-9 mb-2"><?= $user->student_profile->student_groups[0]->study_group->study_faculty->faculty->title ?></dd>
                                    <dt class="col-md-3 text-truncate"><?= __d('panel', 'Group') ?></dt>
                                    <dd class="col-md-9 mb-2">
                                        <?php
                                        echo $this->Html->link(
                                            $this->StudyGroups->abbr($user->student_profile->student_groups[0]->study_group),
                                            ['controller' => 'StudyGroups', 'action' => 'view', $user->student_profile->student_groups[0]->study_group->id]
                                        );
                                        ?>
                                        <span>
                                            (<?php
                                            if ($this->StudentStatuses->isLearns($user->student_profile->student_statuses[0])) {
                                                echo __d('panel', 'enrolled in {0}', $user->student_profile->student_groups[0]->study_year->title);
                                            } else {
                                                echo __d('panel', 'excluded in {0}', $user->student_profile->student_groups[0]->study_year->title);
                                            }
                                            ?>)
                                        </span>
                                    </dd>

                                    <?php if (
                                        $this->StudentStatuses->isLearns($user->student_profile->student_statuses[0]) &&
                                        !empty($user->student_profile->student_groups[0]->study_group->study_faculty->study_courses)
                                    ): ?>
                                    <dt class="col-md-3 text-truncate"><?= __d('panel', 'Course') ?></dt>
                                    <dd class="col-md-9 mb-2">
                                        <?= $user->student_profile->student_groups[0]->study_group->study_faculty->study_courses[0]->full_name ?>
                                    </dd>
                                    <?php endif; ?>

                                    <dt class="col-md-3 text-truncate"><?= __d('panel', 'Language') ?></dt>
                                    <dd class="col-md-9 mb-2">
                                        <?= $this->Language->plainText($user->student_profile->student_groups[0]->study_group->language) ?>
                                    </dd>
                                </dl>
                            </div>
                            <?php endif; ?>
                            <div class="col-xl-5">
                                <?= !empty($user->phone_number) ? $this->PhoneNumbers->link($user->phone_number) : '' ?>
                                <div class="mt-2">
                                    <?= $user->has('email_address') ? $user->email_address->email : '' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content p-0">
                    <ul class="nav nav-tabs nav-tabs-clean mt-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-profile" role="tab">
                                <i class="fal fa-id-badge text-success"></i>
                                <span class="hidden-sm-down ml-1"><?= __d('panel', 'Profile') ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-contacts" role="tab">
                                <i class="fal fa-phone-office text-secondary"></i>
                                <span class="hidden-sm-down ml-1"><?= __d('panel', 'Contacts') ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-requisites" role="tab">
                                <i class="fal fa-passport text-gradient"></i>
                                <span class="hidden-sm-down ml-1"><?= __d('panel', 'Requisites') ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-learner" role="tab">
                                <i class="fal fa-book-reader text-primary"></i>
                                <span class="hidden-sm-down ml-1"><?= __d('panel', 'Learner') ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-timeline" role="tab">
                                <i class="fal fa-stream text-gradient"></i>
                                <span class="hidden-sm-down ml-1"><?= __d('panel', 'Timeline') ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-payments" role="tab">
                                <i class="fal fa-money-check-alt text-success"></i>
                                <span class="hidden-sm-down ml-1"><?= __d('panel', 'Payments') ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-scores" role="tab">
                                <i class="fal fa-star text-warning"></i>
                                <span class="hidden-sm-down ml-1"><?= __d('panel', 'Scores') ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-password" role="tab">
                                <i class="fal fa-key text-danger"></i>
                                <span class="hidden-sm-down ml-1"><?= __d('panel', 'Password') ?></span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane fade show active" id="tab-profile" role="tabpanel" aria-labelledby="tab-profile">
                            <?= $this->Form->create($user, ['type' => 'file']) ?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <?php
                                    echo $this->Form->control('username', [
                                        'label' => __d('panel', 'Username'),
                                        'placeholder' => __d('panel', 'Username'),
                                        'disabled' => true
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <?php
                                    echo $this->Form->control('old_id', [
                                        'type' => 'text',
                                        'label' => __d('panel', 'Old ID'),
                                        'placeholder' => __d('panel', 'Old ID'),
                                        'disabled' => true
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <?php
                                    echo $this->Form->control('user_profile.first_name', [
                                        'label' => __d('panel', 'First name'),
                                        'placeholder' => __d('panel', 'First name')
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <?php
                                    echo $this->Form->control('user_profile.last_name', [
                                        'label' => __d('panel', 'Last name'),
                                        'placeholder' => __d('panel', 'Last name')
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <?php
                                    echo $this->Form->label('Photo');
                                    echo $this->Form->file('photo.file', [
                                        'label' => __d('panel', 'Photo')
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <?php
                                    echo $this->Form->control('user_profile.date_of_birth', [
                                        'label' => __d('panel', 'Date of birth'),
                                        'placeholder' => __d('panel', 'Date of birth')
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <?php
                                    echo $this->Form->control('user_profile.gender', [
                                        'label' => __d('panel', 'Gender'),
                                        'type' => 'radio',
                                        'options' => [
                                            1 => __d('panel', 'Female'),
                                            2 => __d('panel', 'Male')
                                        ]
                                    ]);
                                    ?>
                                </div>
                            </div>

                            <div class="border border-left-0 border-right-0 border-bottom-0 pt-3 text-right">
                                <?= $this->Form->submit(__d('panel', 'Save')) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                        <div class="tab-pane fade" id="tab-contacts" role="tabpanel" aria-labelledby="tab-contacts">
                            <?= $this->Form->create($user, ['type' => 'file']) ?>
                            <div class="row">
                                <div class="col-lg-4 mb-3">
                                    <div class="card">
                                        <div class="card-header bg-warning-50 py-2">
                                            <div class="card-title"><?= __d('panel', 'Phone number and email address') ?></div>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            echo $this->Form->control('phone_number.phone', [
                                                'label' => __d('panel', 'Phone number'),
                                                'placeholder' => __d('panel', 'Phone number')
                                            ]);
                                            ?>

                                            <hr/>

                                            <?php
                                            echo $this->Form->control('email_address.email', [
                                                'label' => __d('panel', 'Email address'),
                                                'placeholder' => __d('panel', 'Email address')
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <div class="card">
                                        <div class="card-header bg-warning-50 py-2">
                                            <div class="card-title"><?= __d('panel', 'The actual address') ?></div>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            echo $this->Form->control('address.region_id', [
                                                'label' => __d('panel', 'Region'),
                                                'empty' => __d('panel', 'Select the region'),
                                                'class' => 'form-control select2 w-100'
                                            ]);
                                            echo $this->Form->control('address.address', [
                                                'label' => __d('panel', 'Address'),
                                                'placeholder' => __d('panel', 'Address'),
                                                'type' => 'textarea',
                                                'rows' => 3
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="card">
                                        <div class="card-header bg-warning-50 py-2">
                                            <div class="card-title"><?= __d('panel', 'Member') ?></div>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            echo $this->Form->control('learner_profile.member_fullname', [
                                                'label' => __d('panel', 'Full name'),
                                                'placeholder' => __d('panel', 'Full name')
                                            ]);
                                            echo $this->Form->control('learner_profile.member_status', [
                                                'label' => __d('panel', 'Status'),
                                                'placeholder' => __d('panel', 'Status')
                                            ]);
                                            echo $this->Form->control('learner_profile.member_phone_number.phone', [
                                                'label' => __d('panel', 'Phone number'),
                                                'placeholder' => __d('panel', 'Phone number')
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-left-0 border-right-0 border-bottom-0 pt-3 text-right">
                                <?= $this->Form->submit(__d('panel', 'Save')) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                        <div class="tab-pane fade" id="tab-requisites" role="tabpanel" aria-labelledby="tab-requisites">
                            <?= $this->Form->create($user, ['type' => 'file']) ?>
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <?php
                                            echo $this->Form->control('passport.nationality_id', [
                                                'label' => __d('panel', 'Nationality'),
                                                'placeholder' => __d('panel', 'Nationality')
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <?php
                                            echo $this->Form->control('passport.code', [
                                                'label' => __d('panel', 'Passport series and number'),
                                                'placeholder' => __d('panel', 'Passport series and number')
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <?php
                                            echo $this->Form->control('passport.by_issued', [
                                                'label' => __d('panel', 'By issued'),
                                                'placeholder' => __d('panel', 'By issued')
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <?php
                                            echo $this->Form->control('passport.date_issued', [
                                                'label' => __d('panel', 'Date issued'),
                                                'placeholder' => __d('panel', 'Date issued')
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <?php
                                            echo $this->Form->control('passport.date_expired', [
                                                'label' => __d('panel', 'Date expired'),
                                                'placeholder' => __d('panel', 'Date expired')
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <?php
                                            echo $this->Form->control('passport.passport_scan.file', [
                                                'type' => 'file',
                                                'label' => __d('panel', 'Passport scan'),
                                                'placeholder' => __d('panel', 'Passport scan')
                                            ]);
                                            if (!empty($user->passport->passport_scan)) {
                                                echo '<div style="margin-top: -20px;">';
                                                echo $this->Html->link(__d('panel', 'Passport scan'), $this->Image->imageUrl($user->passport->passport_scan), ['target' => '_blank']);
                                                echo $this->Form->control('passport.passport_scan.old_file_id', [
                                                    'type' => 'hidden',
                                                    'value' => h($user->passport->passport_scan->id)
                                                ]);
                                                echo '</div>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <?php
                                            echo $this->Form->control('passport.pin', [
                                                'label' => __d('panel', 'PIN'),
                                                'placeholder' => __d('panel', 'PIN')
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <?php
                                            echo $this->Form->control('passport.inn', [
                                                'label' => __d('panel', 'INN'),
                                                'placeholder' => __d('panel', 'INN')
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="card shadow-0">
                                        <div class="card-header bg-warning-50 py-2">
                                            <div class="card-title"><?= __d('panel', 'Place of residence') ?></div>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            echo $this->Form->control('passport.address.region_id', [
                                                'label' => __d('panel', 'Region'),
                                                'empty' => __d('panel', 'Select the region'),
                                                'class' => 'form-control select2 w-100'
                                            ]);
                                            echo $this->Form->control('passport.address.address', [
                                                'label' => __d('panel', 'Address'),
                                                'placeholder' => __d('panel', 'Address'),
                                                'type' => 'textarea',
                                                'rows' => 3
                                            ]);
                                            echo $this->Form->control('passport.check_address', [
                                                'label' => __d('panel', 'Checked'),
                                                'placeholder' => __d('panel', 'Address'),
                                                'type' => 'checkbox'
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border border-left-0 border-right-0 border-bottom-0 pt-3 text-right">
                                <?= $this->Form->submit(__d('panel', 'Save')) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                        <div class="tab-pane fade" id="tab-learner" role="tabpanel" aria-labelledby="tab-learner">
                            <?= $this->Form->create($user, ['type' => 'file']) ?>
                            <div class="card mb-3">
                                <div class="card-header bg-warning-50 py-2">
                                    <div class="card-title"><?= __d('panel', 'Language сertificate') ?></div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-group">
                                                <label class="form-label"><?= __d('panel', 'Language tests') ?></label>
                                                <div class="input-group">
                                                    <?php
                                                    $this->Form->setTemplates([
                                                        'inputContainer' => '{{content}}'
                                                    ]);
                                                    echo $this->Form->control('language_certificate.language_test_level.language_test_id', [
                                                        'label' => ['class' => 'sr-only'],
                                                        'id' => 'js-language-test-id',
                                                        'empty' => __d('panel', 'Select language test'),
                                                        'options' => $languageTests,
                                                        'data-url' => $this->Url->build(['controller' => 'LanguageTestLevels', 'action' => 'byLanguageTestId']),
                                                    ]);
                                                    echo $this->Form->control('language_certificate.language_test_level_id', [
                                                        'label' => ['class' => 'sr-only'],
                                                        'type' => 'select',
                                                        'id' => 'js-language-test-level-id',
                                                        'empty' => __d('panel', 'Select language test level'),
                                                        'placeholder' => __d('panel', 'Language test levels')
                                                    ]);
                                                    $this->Form->setTemplates([
                                                        'inputContainer' => '<div class="form-group{{required}}">{{content}}</div>',
                                                    ]);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <?php
                                            echo $this->Form->control('language_certificate.date_issued', [
                                                'label' => __d('panel', 'Date issued'),
                                                'placeholder' => __d('panel', 'Date issued')
                                            ]);
                                            ?>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <?php
                                            echo $this->Form->control('language_certificate.scan.file', [
                                                'type' => 'file',
                                                'label' => __d('panel', 'Certificate scan'),
                                                'placeholder' => __d('panel', 'Certificate scan')
                                            ]);
                                            if (!empty($user->language_certificate->scan)) {
                                                echo '<div style="margin-top: -20px;">';
                                                echo $this->Html->link(__d('panel', 'Certificate scan'), $this->Image->imageUrl($user->language_certificate->scan), ['target' => '_blank']);
                                                echo $this->Form->control('language_certificate.scan.old_file_id', [
                                                    'type' => 'hidden',
                                                    'value' => h($user->language_certificate->scan->id)
                                                ]);
                                                echo '</div>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-lg-2 mb-3">
                                            <label class="mt-3"></label>
                                            <?php
                                            echo $this->Form->control('language_certificate.confirmated', [
                                                'type' => 'checkbox',
                                                'label' => __d('panel', 'Language certificate confirm')
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header bg-warning-50 py-2">
                                    <div class="card-title"><?= __d('panel', 'Last place of study') ?></div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->control('learner_profile.institution_title', [
                                                'label' => __d('panel', 'Institution title'),
                                                'placeholder' => __d('panel', 'Institution title')
                                            ]);
                                            ?>
                                            <div class="row">
                                                <div class="col-lg-6 mb-3">
                                                    <?php
                                                    echo $this->Form->control('learner_profile.institution_type', [
                                                        'label' => __d('panel', 'Institution type'),
                                                        'type' => 'select',
                                                        'options' => $this->LearnerProfiles->institutionTypeList()
                                                    ]);
                                                    ?>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <?php
                                                    echo $this->Form->control('learner_profile.institution_major', [
                                                        'label' => __d('panel', 'Major'),
                                                        'placeholder' => __d('panel', 'Major')
                                                    ]);
                                                    ?>
                                                </div>
                                            </div>

                                            <?php
                                            echo $this->Form->control('learner_profile.institution_graduation_year', [
                                                'label' => __d('panel', 'Graduation year'),
                                                'placeholder' => __d('panel', 'Graduation year')
                                            ]);
                                            echo $this->Form->control('learner_profile.diplom.file', [
                                                'type' => 'file',
                                                'label' => __d('panel', 'Diplom scan'),
                                                'placeholder' => __d('panel', 'Diplom scan')
                                            ]);
                                            if (!empty($user->learner_profile->diplom)) {
                                                echo '<div style="margin-top: -20px;">';
                                                echo $this->Html->link(__d('panel', 'Diplom scan'), $this->Image->imageUrl($user->learner_profile->diplom), ['target' => '_blank']);
                                                echo $this->Form->control('learner_profile.diplom.old_file_id', [
                                                    'type' => 'hidden',
                                                    'value' => h($user->learner_profile->diplom->id)
                                                ]);
                                                echo '</div>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card shadow-0">
                                                <div class="card-header bg-warning-50 py-2">
                                                    <div class="card-title"><?= __d('panel', 'School address') ?></div>
                                                </div>
                                                <div class="card-body">
                                                    <?php
                                                    echo $this->Form->control('learner_profile.address.region_id', [
                                                        'label' => __d('panel', 'Region'),
                                                        'empty' => __d('panel', 'Select the region'),
                                                        'class' => 'form-control select2 w-100'
                                                    ]);

                                                    echo $this->Form->control('learner_profile.address.address', [
                                                        'label' => __d('panel', 'Address'),
                                                        'placeholder' => __d('panel', 'Address'),
                                                        'type' => 'textarea',
                                                        'rows' => 2
                                                    ]);
                                                    echo $this->Form->control('learner_profile.check_address', [
                                                        'label' => __d('panel', 'Checked'),
                                                        'placeholder' => __d('panel', 'Address'),
                                                        'type' => 'checkbox'
                                                    ]);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-left-0 border-right-0 border-bottom-0 pt-3 text-right">
                                <?= $this->Form->submit(__d('panel', 'Save')) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                        <div class="tab-pane fade" id="tab-timeline" role="tabpanel" aria-labelledby="tab-timeline">
                            <span class="text-info text-center d-block my-3"><?= __d('panel', 'On development stage') ?></span>
                        </div>
                        <div class="tab-pane fade" id="tab-payments" role="tabpanel" aria-labelledby="tab-payments">
                            <div class="fs-xxl text-right mb-4 pb-2 border-bottom">
                                <i class="fad fa-wallet text-warning mr-2"></i>
                                <?= $this->cell('Balance', ['student_profile_id' => $user->student_profile->id]) ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tab_borders_icons-1" role="tab">
                                                <i class="fal fa-file-signature mr-1"></i> <?= $user->student_profile->contract->abbr ?>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content border border-top-0 p-3">
                                        <div class="tab-pane fade show active" id="tab_borders_icons-1" role="tabpanel">
                                            <div class="accordion accordion-outline" id="js-study-contracts-accordion">
                                                <?php foreach($this->ContractOrders->groupByStudyYear($user->student_profile->contract_orders) as $contractOrdersByStudyYear): ?>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <a
                                                            href="javascript:void(0);"
                                                            class="card-title py-2 <?= (!$this->StudyYears->isCurrent($contractOrdersByStudyYear['study_year'])) ? 'collapsed' : '' ?>"
                                                            data-toggle="collapse"
                                                            data-target="#js-study-year-<?= $contractOrdersByStudyYear['study_year']->id ?>-contracts"
                                                            aria-expanded="true"
                                                        >
                                                            <?= $contractOrdersByStudyYear['study_year']->full_name ?>
                                                            <span class="ml-auto">
                                                                <span class="collapsed-reveal">
                                                                    <i class="fal fa-minus fs-xl"></i>
                                                                </span>
                                                                <span class="collapsed-hidden">
                                                                    <i class="fal fa-plus fs-xl"></i>
                                                                </span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div
                                                        id="js-study-year-<?= $contractOrdersByStudyYear['study_year']->id ?>-contracts"
                                                        class="collapse <?= ($this->StudyYears->isCurrent($contractOrdersByStudyYear['study_year'])) ? 'show' : '' ?>"
                                                        data-parent="#js-study-contracts-accordion"
                                                    >
                                                        <div class="card-body">
                                                            <?php if ($this->StudyYears->isCurrent($contractOrdersByStudyYear['study_year'])): ?>
                                                            <div class="alert alert-info py-2 px-3 mb-3" role="alert">
                                                                <strong><?= __d('panel', 'Info!') ?></strong> <?= __d('panel', 'Current study year.') ?>
                                                            </div>
                                                            <?php endif; ?>

                                                            <?php foreach($contractOrdersByStudyYear['contract_orders'] as $contractOrder): ?>
                                                            <div class="card border">
                                                                <div class="card-header py-2 px-3 d-flex align-items-center flex-wrap">
                                                                    <div>
                                                                        <?php if ($this->ContractOrders->isPaid($contractOrder)): ?>
                                                                        <span class="text-success mr-1"><i class="fad fa-check"></i></span>
                                                                        <?php endif; ?>
                                                                        <span class="<?= $this->ContractOrders->isPaid($contractOrder) ? 'text-success' : '' ?>"><?= $contractOrder->full_name ?></span>
                                                                    </div>
                                                                    <div class="ml-auto">
                                                                        <a href="#" class="text-info" data-toggle="modal" data-target="#js-contract-order-<?= $contractOrder->id ?>-modal">
                                                                            <i class="fal fa-pencil"></i>
                                                                        </a>
                                                                    </div>
                                                                    <!-- modal -->
                                                                    <div class="modal fade" id="js-contract-order-<?= $contractOrder->id ?>-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">Lecturer grading period</h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    ff
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer"></div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- modal end -->
                                                                </div>
                                                                <div class="card-body">
                                                                    <dl class="row fs-lg mb-0">
                                                                        <dt class="col-lg-3"><?= __d('panel', 'Contract value') ?></dt>
                                                                        <dd class="col-lg-9 mb-2">
                                                                            <span><?= $this->Number->currency($this->ContractOrders->value($contractOrder), 'UZS') ?></span>
                                                                            <a
                                                                                href="javascript:void(0);"
                                                                                class="ml-1"
                                                                                data-toggle="popover"
                                                                                data-trigger="focus"
                                                                                data-placement="auto"
                                                                                data-html="true"
                                                                                title="<?= __d('panel', 'Formation of the contract value') ?>"
                                                                                data-content='<?= $this->ContractOrders->calcValueDescription($contractOrder) ?>'
                                                                                data-original-title="<?= __d('panel', 'Formation of the contract value') ?>"
                                                                            >
                                                                                <i class="fal fa-calculator-alt"></i>
                                                                            </a>
                                                                        </dd>
                                                                        <dt class="col-lg-3"><?= __d('panel', 'Contributions') ?></dt>
                                                                        <dd class="col-lg-9 mb-2">
                                                                            <?php if ($contractOrder->has('amount_payment')): ?>
                                                                            <span class="text-success"><?= $this->Number->currency($contractOrder->amount_payment, 'UZS') ?></span>
                                                                            <?php else: ?>
                                                                            <span class="text-warning"><?= __d('panel', 'No payments were made') ?></span>
                                                                            <?php endif; ?>
                                                                        </dd>

                                                                        <?php if (!$this->ContractOrders->isPaid($contractOrder)): ?>
                                                                        <dt class="col-lg-3"><?= __d('panel', 'The remainder') ?></dt>
                                                                        <dd class="col-lg-9">
                                                                            <span class="text-danger">
                                                                                <?= $this->Number->currency($this->ContractOrders->debt($contractOrder), 'UZS') ?>
                                                                            </span>
                                                                        </dd>
                                                                        <?php endif; ?>

                                                                        <?php if (!empty($contractOrder->decree)): ?>
                                                                        <dt class="col-lg-3"><?= __d('panel', 'Decree') ?></dt>
                                                                        <dd class="col-lg-9 fs-md">
                                                                            <?php if (null !== $contractOrder->decree->scan): ?>
                                                                            <?php
                                                                            echo $this->Html->link($contractOrder->decree->full_name, '#', [
                                                                                'data-toggle' => 'modal',
                                                                                'data-target' => '#contract-order-decree-scan-modal',
                                                                                'escape' => false
                                                                            ]);
                                                                            ?>
                                                                            <div class="modal fade modal-fullscreen" id="contract-order-decree-scan-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                    <div class="modal-content h-100 border-0 shadow-0 bg-fusion-800">
                                                                                        <button type="button" class="close p-sm-2 p-md-4 text-white fs-xxl position-absolute pos-right mr-sm-2 mt-sm-1 z-index-space" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                                        </button>
                                                                                        <div class="modal-body p-0 text-center">
                                                                                            <?php
                                                                                            echo $this->Image->display($contractOrder->decree->scan, 'large', [
                                                                                                'class' => 'img-fluid'
                                                                                            ]);
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php else: ?>
                                                                            <?= $contractOrder->decree->full_name ?>
                                                                            <?php endif; ?>
                                                                        </dd>
                                                                        <?php endif; ?>
                                                                    </dl>
                                                                </div>
                                                            </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <ul class="nav nav-tabs nav-fill" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tab_justified-1" role="tab">
                                                <?= __d('panel', 'Transactions') ?>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link disabled" href="#" tabindex="-1"><?= __d('panel', 'Refunds') ?></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="overflow-auto p-3 border border-top-0" style="max-height: 400px">
                                            <div class="tab-pane fade show active" id="tab_justified-1" role="tabpanel">
                                                <?php if (!empty($user->student_profile->transactions)): ?>
                                                    <?php foreach($user->student_profile->transactions as $transaction): ?>
                                                    <div class="rounded shadow-hover-1 border-faded p-2 mb-2">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <span class="ml-1 text-muted"><?= $transaction->date_transacted->format('d.m.Y') ?></span>
                                                            </div>
                                                            <div class="text-right">
                                                                <span class="text-success fs-lg">+<?= $this->Number->currency($transaction->amount, 'UZS') ?></span>
                                                                <?= $this->Transactions->methodIcon($transaction->method) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                <div class="text-center text-warning"><?= __d('panel', 'No transactions') ?></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="tab-pane fade" id="tab_justified-2" role="tabpanel">
                                                <div class="text-center text-warning"><?= __d('panel', 'On development stage') ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-scores" role="tabpanel" aria-labelledby="tab-scores">
                            <?php
                            if (!empty($studentGroups)) {
                                if (count($studentGroups) > 1) {
                                    echo $this->element('StudyScores/many_groups', ['studentGroups' => $studentGroups]);
                                } else {
                                    echo $this->element('StudyScores/tables', ['studentGroup' => $studentGroups[0]]);
                                }
                            } else {
                                echo $this->Html->tag('span', __d('panel', 'No study plans'), ['class' => 'text-info text-center d-block my-3']);
                            }
                            ?>
                        </div>
                        <div class="tab-pane fade" id="tab-password" role="tabpanel" aria-labelledby="tab-password">
                            <?= $this->Form->create($user) ?>
                            <?php
                            echo $this->Form->control('password', [
                                'label' => __d('panel', 'Password'),
                                'placeholder' => __d('panel', 'Password'),
                                'value' => ''
                            ]);
                            ?>
                            <div class="border border-left-0 border-right-0 border-bottom-0 pt-3 text-right">
                                <?= $this->Form->submit(__d('panel', 'Save')) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
