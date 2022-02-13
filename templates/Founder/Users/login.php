<?php $this->assign('title', __d('panel', 'Login')); ?>

<div class="blankpage-form-field">
    <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
        <?= $this->Html->image('logo.png', ['class' => 'text-center', 'url' => ['_name' => 'home']]) ?>
    </div>
    <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
        <?= $this->Flash->render() ?>
        <?php
        echo $this->Form->create(null, ['autocomplete' => 'off']);
        echo $this->Form->control('username', [
            'placeholder' => __d('panel', 'Username'),
            'templateVars' => ['help' => __d('panel', 'Your unique username')]
        ]);
        echo $this->Form->control('password', [
            'placeholder' => __d('panel', 'Password'),
            'templateVars' => ['help' => __d('panel', 'Your password')]
        ]);
        echo $this->Form->control('remember_me', ['type' => 'checkbox', 'checked' => true, 'label' => __d('panel', 'Remember me for the next 30 days')]);
        echo $this->Form->submit(__d('panel', 'Sign in'));
        echo $this->Form->end();
        ?>
    </div>
</div>
