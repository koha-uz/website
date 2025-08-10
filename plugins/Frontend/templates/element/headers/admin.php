<?php if ($this->Identity->isLoggedIn()): ?>
<!--<div class="bg-dark fs-11 py-1 px-3">
    <?php
    echo $this->Html->link(
        __d('frontend', 'Go to office'),
        [
            'controller' => 'SystemicPages',
            'action' => 'dashboard',
            'prefix' => 'Admin'
        ],
        ['class' => 'text-white hover']
    );
    ?>
</div>-->
<?php endif; ?>