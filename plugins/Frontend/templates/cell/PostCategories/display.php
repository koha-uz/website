<?php if (!empty($postCategories)): ?>
<div class="widget">
    <h4 class="widget-title mb-3"><?= __d('frontend', 'Categories') ?></h4>
    <ul class="unordered-list bullet-primary text-reset">
        <?php foreach($postCategories as $category): ?>
        <li>
            <?php
            echo $this->Html->link(
                $category->title . ' (' . count($category->posts) . ')',
                ['controller' => 'PostCategories', 'action' => 'view', 'slug' => $category->slug]
            );
            ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<!-- /.widget -->
<?php endif; ?>