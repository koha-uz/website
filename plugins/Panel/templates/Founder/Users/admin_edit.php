<?php
$this->assign('title', mb_strtoupper($user->user_profile->full_name));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Administrators'), 'url' => ['action' => 'admins']],
    ['title' => mb_strtoupper($user->user_profile->full_name)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['admins'][1] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css('formplugins/select2/select2.bundle', ['block' => true]);
echo $this->Html->script('formplugins/select2/select2.bundle', ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('#roles-ids').select2({
        multiple:true,
        placeholder: '<?= __d('panel', 'Select roles') ?>',
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
                                echo $this->Image->display($user->photo, null, ['style' => 'width: 150px', 'class' => 'rounded-circle shadow-2 img-thumbnail']);
                            } else {
                                echo $this->Html->image('avatar.png', ['class' => 'rounded-circle shadow-2 img-thumbnail mb-1']);
                                echo $this->Html->link('Photo link', $this->Image->imageUrl($user->photo, null));
                            }
                        } else {
                            echo $this->Html->image('avatar.png', ['class' => 'rounded-circle shadow-2 img-thumbnail']);
                        }
                        ?>
                        <h5 class="mb-3 fw-700 text-center mt-3">
                            <span class="text-uppercase"><?= h($user->user_profile->full_name) ?></span>
                            <small class="text-muted mb-0">@<?= h($user->username) ?></small>
                        </h5>
                        <div><?= $this->Roles->list($user->roles) ?></div>
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
                            <a class="nav-link" data-toggle="tab" href="#tab-settings" role="tab">
                                <i class="fal fa-cog text-danger"></i>
                                <span class="hidden-sm-down ml-1"><?= __d('panel', 'Settings') ?></span>
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
                            <?= $this->element('form/contacts', ['entity' => $user]) ?>
                            <div class="border border-left-0 border-right-0 border-bottom-0 pt-3 text-right">
                                <?= $this->Form->submit(__d('panel', 'Save')) ?>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                        <div class="tab-pane fade" id="tab-settings" role="tabpanel" aria-labelledby="tab-settings">
                            <?= $this->Form->create($user) ?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <?php
                                    echo $this->Form->control('username', [
                                        'label' => __d('panel', 'Username'),
                                        'placeholder' => __d('panel', 'Username')
                                    ]);
                                    ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <?php
                                    echo $this->Form->control('roles._ids', [
                                        'label' => __d('panel', 'Roles'),
                                        'placeholder' => __d('panel', 'Select roles'),
                                        'class' => 'form-control select2 w-100'
                                    ]);
                                    ?>
                                </div>
                                <div class="col-12 mb-3">

                                    <?php
                                    echo $this->Form->control('is_active', [
                                        'label' => __d('panel', 'Active')
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div class="border border-left-0 border-right-0 border-bottom-0 pt-3 text-right">
                                <?= $this->Form->submit(__d('panel', 'Save')) ?>
                            </div>
                            <?= $this->Form->end() ?>
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
