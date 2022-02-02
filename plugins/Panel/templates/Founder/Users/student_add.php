<?php
$this->assign('title', __d('panel', 'Create student'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Students'), 'url' => ['action' => 'students']],
    ['title' => __d('panel', 'Create')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['students'][0] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css(['formplugins/select2/select2.bundle'], ['block' => true]);
echo $this->Html->script(['formplugins/select2/select2.bundle'], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
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

<?= $this->Form->create($user, ['type' => 'file']) ?>
<div class="row">
    <div class="col-lg-9">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <?php
                            echo $this->Form->control('username', [
                                'label' => __d('panel', 'Username'),
                                'placeholder' => __d('panel', 'Username')
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <?php
                            echo $this->Form->control('password', [
                                'label' => __d('panel', 'Password'),
                                'placeholder' => __d('panel', 'Password')
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="panel-requisites" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Requisites') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <?php
                            echo $this->Form->control('passport.nationality_id', [
                                'label' => __d('panel', 'Nationality'),
                                'placeholder' => __d('panel', 'Nationality')
                            ]);
                            ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <?php
                            echo $this->Form->control('passport.code', [
                                'label' => __d('panel', 'Passport series and number'),
                                'placeholder' => __d('panel', 'Passport series and number')
                            ]);
                            ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <?php
                            echo $this->Form->control('passport.passport_scan.file', [
                                'type' => 'file',
                                'label' => __d('panel', 'Passport scan'),
                                'placeholder' => __d('panel', 'Passport scan')
                            ]);
                            ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <?php
                            echo $this->Form->control('passport.by_issued', [
                                'label' => __d('panel', 'By issued'),
                                'placeholder' => __d('panel', 'By issued')
                            ]);
                            ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <?php
                            echo $this->Form->control('passport.date_issued', [
                                'label' => __d('panel', 'Date issued'),
                                'placeholder' => __d('panel', 'Date issued')
                            ]);
                            ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <?php
                            echo $this->Form->control('passport.date_expired', [
                                'label' => __d('panel', 'Date expired'),
                                'placeholder' => __d('panel', 'Date expired')
                            ]);
                            ?>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <?php
                            echo $this->Form->control('passport.pin', [
                                'label' => __d('panel', 'PIN'),
                                'placeholder' => __d('panel', 'PIN')
                            ]);
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('passport.inn', [
                                'label' => __d('panel', 'INN'),
                                'placeholder' => __d('panel', 'INN')
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="panel-2" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Profile') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <?php
                            echo $this->Form->control('user_profile.first_name', [
                                'label' => __d('panel', 'First name'),
                                'placeholder' => __d('panel', 'First name')
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <?php
                            echo $this->Form->control('user_profile.last_name', [
                                'label' => __d('panel', 'Last name'),
                                'placeholder' => __d('panel', 'Last name')
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <?php
                            echo $this->Form->control('user_profile.date_of_birth', [
                                'label' => __d('panel', 'Date of birth'),
                                'placeholder' => __d('panel', 'Date of birth')
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-6 mb-3">
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
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div id="panel-lang-cert" class="panel shadow-0" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
                    <div class="panel-hdr">
                        <h2><?= __d('panel', 'Language сertificate') ?></h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="form-group">
                                <label class="form-label"><?= __d('panel', 'Language tests') ?></label>
                                <div class="input-group">
                                    <?php
                                    $this->Form->setTemplates(['inputContainer' => '{{content}}']);
                                    echo $this->Form->control('learner_profile.language_test_level.language_test_id', [
                                        'label' => ['class' => 'sr-only'],
                                        'id' => 'js-language-test-id',
                                        'empty' => __d('panel', 'Select language test'),
                                        'options' => $languageTests,
                                        'data-url' => $this->Url->build(['controller' => 'LanguageTestLevels', 'action' => 'byLanguageTestId']),
                                    ]);
                                    echo $this->Form->control('learner_profile.language_test_level_id', [
                                        'label' => ['class' => 'sr-only'],
                                        'type' => 'select',
                                        'id' => 'js-language-test-level-id',
                                        'empty' => __d('panel', 'Select language test level'),
                                        'placeholder' => __d('panel', 'Language test levels')
                                    ]);
                                    $this->Form->setTemplates(['inputContainer' => '<div class="form-group{{required}}">{{content}}</div>']);
                                    ?>
                                </div>
                            </div>
                            <?php
                            echo $this->Form->control('learner_profile.certificate.file', [
                                'type' => 'file',
                                'label' => __d('panel', 'Certificate scan'),
                                'placeholder' => __d('panel', 'Certificate scan')
                            ]);
                            echo $this->Form->control('learner_profile.language_test_confirm', [
                                'type' => 'checkbox',
                                'label' => __d('panel', 'Language certificate confirm')
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div id="panel-last-study" class="panel shadow-0" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
                    <div class="panel-hdr">
                        <h2><?= __d('panel', 'Last place of study') ?></h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <?php
                            echo $this->Form->control('learner_profile.institution_title', [
                                'label' => __d('panel', 'Institution title'),
                                'placeholder' => __d('panel', 'Institution title')
                            ]);
                            ?>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <?php
                                    echo $this->Form->control('learner_profile.institution_graduation_year', [
                                        'label' => __d('panel', 'Graduation year'),
                                        'placeholder' => __d('panel', 'Graduation year')
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    echo $this->Form->control('learner_profile.institution_major', [
                                        'label' => __d('panel', 'Major'),
                                        'placeholder' => __d('panel', 'Major')
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <?php
                            echo $this->Form->control('learner_profile.diplom.file', [
                                'type' => 'file',
                                'label' => __d('panel', 'Diplom scan'),
                                'placeholder' => __d('panel', 'Diplom scan')
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->element('form/contacts', ['entity' => $user]) ?>
        <div class="row">
            <div class="col-md-6">
                <div id="panel-address" class="panel shadow-0" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
                    <div class="panel-hdr">
                        <h2><?= __d('panel', 'Address') ?></h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
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
                                'rows' => 3
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="panel-member" class="panel shadow-0" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
                    <div class="panel-hdr">
                        <h2><?= __d('panel', 'Member') ?></h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
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
                                'label' => __d('panel', 'Phone'),
                                'placeholder' => __d('panel', 'Phone')
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div id="panel-4" class="panel shadow-0 d-none d-lg-block" data-panel-close data-panel-collapsed data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Publish mode') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?= $this->Form->control('is_active', ['label' => __d('panel', 'Active')]) ?>
                    <div class="border-top pt-3 text-right">
                        <?= $this->Form->submit(__d('panel', 'Save')) ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="panel-study-group" class="panel shadow-0" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Study group') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?php

                    echo $this->Form->control('student_profile.student_groups.0.study_group_id', [
                        'label' => ['class' => 'sr-only'],
                        'empty' => __d('panel', 'Select study group'),
                        'class' => 'form-control select2 w-100'
                    ]);
                    echo $this->Form->control('student_profile.student_groups.0.semester', [
                        'label' => ['class' => 'sr-only'],
                        'options' => [
                            '1' => __d('panel', '{0} semester', 1),
                            '2' => __d('panel', '{0} semester', 2)
                        ]
                    ]);
                    echo $this->Form->control('student_profile.student_groups.0.notes', [
                        'label' => ['class' => 'sr-only'],
                        'type' => 'textarea',
                        'rows' => 2,
                        'placeholder' => __d('panel', 'Notes')
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <div id="panel-decree" class="panel shadow-0" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Decree') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?php
                    echo $this->Form->control('student_profile.student_groups.0.decree.number', [
                        'label' => __d('panel', 'Number')
                    ]);
                    echo $this->Form->control('student_profile.student_groups.0.decree.date_effective', [
                        'type' => 'date',
                        'label' => __d('panel', 'Effective date')
                    ]);
                    echo $this->Form->control('student_profile.student_groups.0.decree.scan.file', [
                        'type' => 'file',
                        'label' => __d('panel', 'Scan')
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <div id="panel-5" class="panel shadow-0" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Photo') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?= $this->Form->file('photo.file') ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>
