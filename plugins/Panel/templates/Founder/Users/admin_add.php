<?php
$this->assign('title', __d('panel', 'Create administrator'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Administrators'), 'url' => ['action' => 'admins']],
    ['title' => __d('panel', 'Create administrator')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['admins'][0] = true;
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

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-plus-circle"></i> <?= __d('panel', 'Create administrator') ?>
    </h1>
</div>

<?= $this->Form->create($user, ['type' => 'file']) ?>
<div class="row">
    <div class="col-md-9">
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
                        <div class="col-12">
                            <?php
                            echo $this->Form->control('roles._ids', [
                                'label' => __d('panel', 'Roles'),
                                'placeholder' => __d('panel', 'Select roles'),
                                'class' => 'form-control select2 w-100'
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

        <?= $this->element('form/contacts', ['entity' => $user]) ?>
    </div>
    <div class="col-md-3">
        <div id="panel-4" class="panel shadow-0" data-panel-close data-panel-collapsed data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
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
