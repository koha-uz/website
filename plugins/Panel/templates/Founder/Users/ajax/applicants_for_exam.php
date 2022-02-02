<table class="table table-bordered table-hover table-striped w-100 datatable">
    <thead class="bg-highlight">
        <tr>
            <th class="all text-center" style="width: 5%">#</th>
            <th class="all text-center"><?= __d('panel', 'Apply No.') ?></th>
            <th class="all w-50"><?= __d('panel', 'Full name') ?></th>
            <th class="min-desktop text-center"><?= __d('panel', 'Reception') ?></th>
            <th class="min-desktop text-center"><?= __d('panel', 'Language') ?></th>
            <th class="all"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $key => $user): ?>
        <tr <?= $this->LearnerProfiles->checkLanguageTest($user->learner_profile) ? 'class="fw-700"': '' ?>>
            <td class="text-right">
                <?php
                echo $this->Form->control('passing_exams.' . $key . '.user_id', [
                    'label' => '',
                    'value' => h($user->id),
                    'type' => 'checkbox'
                ]);
                ?>
            </td>
            <td class="text-center"><?= h($user->applicant_profile->apply_no) ?></td>
            <td>
                <?php
                echo mb_strtoupper(h($user->user_profile->full_name));
                if ($this->LearnerProfiles->checkLanguageTest($user->learner_profile)) {
                    echo $this->Html->tag('i', '*', [
                        'class' => 'text-danger fs-xl cursor-pointer',
                        'data-toggle' => 'popover',
                        'data-trigger' => 'hover',
                        'data-original-title' => $user->learner_profile->language_test_level->language_test->title,
                        'data-content' => $user->learner_profile->language_test_level->level
                    ]);
                }
                ?>
            </td>
            <td class="text-center">
                <?php
                if ($user->learner_profile->has('reception')) {
                    echo h($user->learner_profile->reception->systemic_title);
                }
                ?>
            </td>
            <td class="text-center">
                <?= $this->LearnerProfiles->language($user->learner_profile->language) ?>
            </td>
            <td class="text-center">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('i', '', ['class' => 'fal fa-eye']),
                    ['controller' => 'Users', 'action' => 'applicantEdit', h($user->id)],
                    ['escape' => false, 'class' => 'btn btn-sm btn-outline-info btn-icon']
                );
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
echo $this->Html->css('datagrid/datatables/datatables.bundle');
echo $this->Html->script(['datagrid/datatables/datatables.bundle']);
?>

<script>
$(document).ready(function() {
    var table = $('.datatable').dataTable({
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [0, 5],
            orderable: false
        }],
        order: [[2, 'desc']]
    });
});
</script>
