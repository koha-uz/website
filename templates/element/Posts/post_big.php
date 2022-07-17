<article class="post">
    <div class="card">
        <?php if (!empty($post->youtubeId)): ?>
        <div class="card-img-top">
            <div class="player" data-plyr-provider="youtube" data-plyr-embed-id="<?= $post->youtubeId ?>"></div>
        </div>
        
        <?php elseif (!empty($post->cover)): ?>
        <figure class="card-img-top overlay overlay-1 hover-scale">
            <?php
            echo $this->Html->link(
                $this->Image->display($post->cover, 'big'),
                ['_name' => 'post_view', 'slug' => h($post->slug)],
                ['escape' => false, 'title' => h($post->title)]
            );
            ?>
            <figcaption>
                <h5 class="from-top mb-0"><?= __d('frontend', 'Read More') ?></h5>
            </figcaption>
        </figure>
        <?php endif; ?>
        <div class="card-body">
            <div class="post-header">
                <div class="post-category text-line">
                    <?php
                    echo $this->Html->link(
                        h($post->post_category->title),
                        ['_name' => 'post_category_view', 'slug' => h($post->post_category->slug)],
                        ['class' => 'hover', 'rel' => 'category', 'title' => h($post->post_category->title)]
                    );
                    ?>
                </div>
                <!-- /.post-category -->
                <h2 class="post-title mt-1 mb-0">
                    <?php
                    echo $this->Html->link(
                        h($post->title),
                        ['_name' => 'post_view', 'slug' => h($post->slug)],
                        ['class' => 'link-dark', 'title' => h($post->title)]
                    );
                    ?>
                </h2>
            </div>
            <!-- /.post-header -->

            <?php if (!empty($post->notes)): ?>
            <div class="post-content">
                <?= h($post->notes) ?>
            </div>
            <!-- /.post-content -->
            <?php endif; ?>
        </div>
        <!--/.card-body -->
        <div class="card-footer">
            <ul class="post-meta d-flex mb-0">
                <li class="post-date">
                    <i class="uil uil-calendar-alt"></i><span><?= $post->date_published->i18nFormat('d MMMM Y HH:mm') ?></span>
                </li>
                <li class="ms-auto">
                    <i class="uil uil-eye"></i><span><?= $post->viewed ?></span>
                </li>
            </ul>
            <!-- /.post-meta -->
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
</article>
<!-- /.post -->