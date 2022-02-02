<table class="table table-bordered table-hover table-striped w-100 datatable">
    <thead class="bg-highlight">
        <tr>
            <th class="all text-center" style="width: 5%">#</th>
            <th class="all text-center"><?= __d('panel', 'Apply No.') ?></th>
            <th class="all w-50"><?= __d('panel', 'Full name') ?></th>
            <th class="min-desktop text-center"><?= __d('panel', 'Language') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $key => $user): ?>
        <tr>
            <td class="text-right">
                <?php
                echo $this->Form->control("student_groups.{$key}.student_profile.user_id", [
                    'label' => '',
                    'value' => h($user->id),
                    'type' => 'checkbox'
                ]);
                ?>
            </td>
            <td class="text-center"><?= h($user->admission_applications[0]->apply_no) ?></td>
            <td><?= h($user->user_profile->full_name) ?></td>
            <td class="text-center"><?= $this->Language->plainText($user->admission_applications[0]->language) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
