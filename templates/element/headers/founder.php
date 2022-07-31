<?php if ($this->Identity->isLoggedIn()): ?>
<div class="bg-primary fs-15 text-center p-1">
    <?php
    echo $this->Html->link(
        __d('frontend', 'Go to office'),
        [
            'controller' => 'SystemicPages',
            'action' => 'dashboard',
            'prefix' => 'Founder'
        ],
        ['class' => 'text-white hover']
    );
    ?>
</div>
<?php endif; ?>