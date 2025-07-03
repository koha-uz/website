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
                                'label' => __d('panel', 'Current password'),
                                'placeholder' => __d('panel', 'Current password'),
                                'type'        => 'password'
                            ],
                            'new_password'  => [
                                'label' => __d('panel', 'New password'),
                                'placeholder' => __d('panel', 'New password'),
                                'type'        => 'password'
                            ],
                            'new_password_confirm'  => [
                                'label' => __d('panel', 'Confirm new password'),
                                'placeholder' => __d('panel', 'Confirm new password'),
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
