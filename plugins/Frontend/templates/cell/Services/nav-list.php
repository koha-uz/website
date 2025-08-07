<?php if (!empty($services)): ?>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><?= __d('frontend', 'Services') ?></a>
    <ul class="dropdown-menu">
        <?php foreach($services as $service): ?>
        <li class="nav-item">
            <?php
            echo $this->Html->link(
                h($service->title),
                ['_name' => 'service-view', 'slug' => h($service->slug)],
                ['title' => h($service->title), 'class' => 'dropdown-item']
            )
            ?>
        </li>
        <?php endforeach; ?>
    </ul>
</li>
<?php endif; ?>