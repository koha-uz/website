<?= $this->Form->create($user, ['autocomplete' => 'off']) ?>
<div class="row justify-content-md-center">
    <div class="col-xl-8">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <?php
                    echo $this->Form->controls(
                        [
                            'current_password'  => [
                                'label' => __d('admin', 'Current password'),
                                'placeholder' => __d('admin', 'Current password'),
                                'type'        => 'password'
                            ],
                            'new_password'  => [
                                'label' => __d('admin', 'New password'),
                                'placeholder' => __d('admin', 'New password'),
                                'type'        => 'password'
                            ],
                            'new_password_confirm'  => [
                                'label' => __d('admin', 'Confirm new password'),
                                'placeholder' => __d('admin', 'Confirm new password'),
                                'type'        => 'password'
                            ],
                        ],
                        ['fieldset' => false, 'legend' => false]
                    );
                    ?>
                    <div class="mt-5 pt-3 border-top text-right"><?= $this->Form->submit() ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>
