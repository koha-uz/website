<?php if (!empty($posts)): ?>
<div class="widget">
    <h4 class="widget-title mb-3"><?= __d('frontend', 'Popular Posts') ?></h4>
    <ul class="image-list">
        <?php foreach($posts as $post): ?>
        <li>
            <figure class="rounded">
                <?php
                echo $this->Html->link(
                    $this->Image->display($post->cover, 'crop100'),
                    ['_name' => 'post_view', 'slug' => h($post->slug)],
                    ['escape' => false, 'title' => h($post->title)]
                );
                ?>
            </figure>
            <div class="post-content">
                <h6 class="mb-2">
                    <?php
                    echo $this->Html->link(
                        $post->title,
                        ['_name' => 'post_view', 'slug' => $post->slug],
                        ['class' => 'link-dark', 'title' => $post->title]
                    );
                    ?>
                </h6>
                <ul class="post-meta">
                    <li class="post-date">
                        <i class="uil uil-calendar-alt"></i><span><?= $post->date_published->i18nFormat('d MMMM Y HH:mm') ?></span>
                    </li>
                    <li class="post-date">
                        <i class="uil uil-eye pr-0"></i><span><?= $post->viewed ?></span>
                    </li>
                </ul>
                <!-- /.post-meta -->
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
    <!-- /.image-list -->
</div>
<!-- /.widget -->
<?php endif; ?>