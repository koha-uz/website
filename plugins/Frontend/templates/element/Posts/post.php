<article class="item post col-12 col-md-6 col-lg-4">
    <div class="card">
        <?php if (isset($post->cover) && !empty($post->cover)): ?>
        <figure class="card-img-top overlay overlay-1 hover-scale">
            <?php
            echo $this->Html->link(
                $this->Image->display($post->cover, '400x250'),
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
                    if (isset($post->post_category->title) && !empty($post->post_category->title)) {
                        echo $this->Html->link(
                            h($post->post_category->title),
                            ['_name' => 'post_category_view', 'slug' => h($post->post_category->slug)],
                            ['class' => 'hover', 'rel' => 'category']
                        );
                    }
                    ?>
                </div>
                <!-- /.post-category -->
                <h2 class="post-title h3 mt-1 mb-0">
                    <?php
                    if (isset($post->title) && !empty($post->title)) {
                        echo $this->Html->link(
                            h($post->title),
                            ['_name' => 'post_view', 'slug' => h($post->slug)],
                            ['class' => 'link-dark']
                        );
                    }
                    ?>
                </h2>
            </div>
            <!-- /.post-header -->
        </div>
        <!--/.card-body -->
        <div class="card-footer">
            <ul class="post-meta d-flex mb-0">
                <?php if (isset($post->published)): ?>
                <li class="post-date">
                    <i class="uil uil-calendar-alt"></i><span><?= $post->published->i18nFormat('d MMMM Y HH:mm') ?></span>
                </li>
                <?php endif; ?>

                <?php if (isset($post->viewed)): ?>
                <li class="ms-auto">
                    <i class="uil uil-eye"></i><span><?= $post->viewed ?></span>
                </li>
                <?php endif; ?>
            </ul>
            <!-- /.post-meta -->
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
</article>
<!-- /.post -->