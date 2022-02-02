<?php
$this->loadHelper('Panel.PhoneNumbers');
$data = [];
foreach($users as $user) {
    $data[] = [
        h($user->id),
        mb_strtoupper(h($user->user_profile->full_name)),
        $user->user_profile->has('date_of_birth') ? $user->user_profile->date_of_birth->format('d.m.Y') : '',
        $this->UserProfiles->genderPlainText($user->user_profile->gender),
        !empty($user->passport) ? h($user->passport->code) : '',
        $this->PhoneNumbers->default($user->phone_number),
        count($user->admission_applications),
        $user->has('date_visited') ? $user->date_visited->format('d.m.Y H:i:s') : '',
        $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fal fa-eye']),
            ['controller' => 'Users', 'action' => 'applicantEdit', h($user->id)],
            ['escape' => false]
        )
    ];
}

echo json_encode(compact('data'), JSON_HEX_QUOT | JSON_HEX_TAG);
