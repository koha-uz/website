<?php if (!empty($taggeds)): ?>
<div class="widget">
    <h4 class="widget-title mb-3"><?= __d('frontend', 'Tags') ?></h4>
    <ul class="list-unstyled tag-list">
        <?php foreach($taggeds as $tagged): ?>
        <li>
            <?php
            echo $this->Html->link(
                h($tagged->tag->label),
                [
                    'controller' => 'Posts',
                    'action' => 'index',
                    '?' => ['tag' => h($tagged->tag->slug)]
                ],
                ['class' => 'btn btn-soft-ash btn-sm rounded-pill']
            );
            ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<!-- /.widget -->
<?php endif; ?>