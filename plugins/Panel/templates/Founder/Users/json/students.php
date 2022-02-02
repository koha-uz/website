<?php
$data = [];
foreach($users as $user) {
    $data[] = [
        h($user->student_profile->student_id),
        mb_strtoupper(h($user->user_profile->full_name)),
        (!empty($user->student_profile->student_groups)) ? h($user->student_profile->student_groups[0]->study_group->study_faculty->faculty->title) : '',
        (!empty($user->student_profile->student_groups)) ? $user->student_profile->student_groups[0]->study_group->abbr : '',
        (!empty($user->student_profile->student_groups) && $this->StudentStatuses->isLearns($user->student_profile->student_statuses[0])) ? h($user->student_profile->student_groups[0]->study_group->study_faculty->study_courses[0]->course) : '',
        $user->has('date_visited') ? $user->date_visited->format('d.m.Y H:i:s') : '',
        $this->StudentStatuses->currentStatusIcon($user->student_profile->student_statuses),
        $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fal fa-eye']),
            ['controller' => 'StudentProfiles', 'action' => 'edit', h($user->id)],
            ['escape' => false]
        )
    ];
}

echo json_encode(compact('data'), JSON_HEX_QUOT | JSON_HEX_TAG);
