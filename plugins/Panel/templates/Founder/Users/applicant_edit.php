<?php
$this->assign('title', __d('panel', '{0} — Applicant', mb_strtoupper(h($user->user_profile->full_name))));


$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Applicants'), 'url' => ['action' => 'applicants']],
    ['title' => __d('panel', mb_strtoupper(h($user->user_profile->full_name)))]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['applicants'][1] = true;
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

    $('#admission-applications-datatable').dataTable({
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [7],
            orderable: false
        }],
        order: [[6, 'desc']]
    });

    $('.select2').select2();

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
});
</script>
<?php $this->end(); ?>

<div class="row">
    <div class="col-xl-3">
        <div class="card mb-g rounded-top">
            <div class="row no-gutters row-grid">
                <div class="col-12">
                    <div class="d-flex flex-column align-items-center justify-content-center p-4">
                        <?php
                        if (!empty($user->photo)) {
                            list($type, ) = explode('/', $user->photo->mime_type);
                            if ($type == 'image') {
                                echo $this->Image->display($user->photo, null, ['style' => 'width: 150px', 'class' => 'shadow-2 img-thumbnail']);
                            } else {
                                echo $this->Html->image('avatar.png', ['class' => 'shadow-2 img-thumbnail mb-1']);
                                echo $this->Html->link('Photo link', $this->Image->imageUrl($user->photo, null));
                            }
                        } else {
                            echo $this->Html->image('avatar.png', ['class' => 'shadow-2 img-thumbnail']);
                        }
                        ?>
                        <h5 class="mb-2 fw-700 text-center mt-3">
                            <span class="text-uppercase"><?= mb_strtoupper(h($user->user_profile->full_name)) ?></span>
                        </h5>

                        <div>
                            <?php
                            echo $this->Form->postLink(
                                $this->Html->tag('i', '', ['class' => 'fal fa-trash']) . ' ' . __d('panel', 'Delete'),
                                $this->Url->build(['action' => 'delete', h($user->id)]),
                                [
                                    'class' => 'btn btn-xs btn-danger mx-1',
                                    'data-title' => __d('panel', 'Are you sure you want to delete the applicant?'),
                                    'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                                ]
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9">
        <div class="card mb-g rounded-top pt-2 pb-3">
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
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
                            <a class="nav-link" data-toggle="tab" href="#tab-applications" role="tab">
                                <i class="fal fa-browser text-danger"></i>
                                <span class="hidden-sm-down ml-1"><?= __d('panel', 'Applications') ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab-password" role="tab">
                                <i class="fal fa-key text-warning"></i>
                                <span class="hidden-sm-down ml-1"><?= __d('panel', 'Password') ?></span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content px-3 pt-3">
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
                        <div class="tab-pane fade" id="tab-applications" role="tabpanel" aria-labelledby="tab-applications">
                            <table class="table table-bordered table-hover table-striped w-100" id="admission-applications-datatable">
                                <thead class="bg-highlight">
                                    <tr>
                                        <th class="all text-center"><?= __d('panel', 'Apply No.') ?></th>
                                        <th class="all"><?= __d('panel', 'Full name') ?></th>
                                        <th class="min-desktop"><?= __d('panel', 'Date of birth') ?></th>
                                        <th class="min-desktop text-center"><?= __d('panel', 'Gender') ?></th>
                                        <th class="min-tablet"><?= __d('panel', 'Passport') ?></th>
                                        <th class="min-desktop"><?= __d('panel', 'Phone number') ?></th>
                                        <th class="min-desktop"><?= __d('panel', 'Date filled') ?></th>
                                        <th class="all"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($user->admission_applications as $admissionApplication): ?>
                                    <tr>
                                        <td class="all text-center"><?= $admissionApplication->apply_no ?></td>
                                        <td class="all"><?= mb_strtoupper(h($user->user_profile->full_name)) ?></td>
                                        <td class="min-desktop">
                                            <?= $user->user_profile->has('date_of_birth') ? $user->user_profile->date_of_birth->format('d.m.Y') : '' ?>
                                        </td>
                                        <td class="min-desktop text-center">
                                            <?= $this->UserProfiles->genderPlainText($user->user_profile->gender) ?>
                                        </td>
                                        <td class="min-tablet"><?= h($user->passport->code) ?></td>
                                        <td class="min-desktop">
                                            <?= $this->PhoneNumbers->default($user->phone_number) ?>
                                        </td>
                                        <td><?= $admissionApplication->date_filled->format('d.m.Y H:i:s') ?></td>
                                        <td class="all text-center">
                                            <?php
                                            echo $this->Html->link(
                                                $this->Html->tag('i', '', ['class' => 'fal fa-eye']),
                                                ['controller' => 'AdmissionApplications', 'action' => 'view', h($admissionApplication->id)],
                                                ['escape' => false]
                                            );
                                            ?>
                                        </th>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
