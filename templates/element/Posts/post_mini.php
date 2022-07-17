<article class="item post col-md-6">
    <div class="card">
        <?php if (!empty($post->cover)): ?>
        <figure class="card-img-top overlay overlay-1 hover-scale">
            <?php
            echo $this->Html->link(
                $this->Image->display($post->cover, 'mini'),
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
                        ['class' => 'hover', 'rel' => 'category']
                    );
                    ?>
                </div>
                <!-- /.post-category -->
                <h2 class="post-title h3 mt-1 mb-3">
                    <?php
                    echo $this->Html->link(
                        h($post->title),
                        ['_name' => 'post_view', 'slug' => h($post->slug)],
                        ['class' => 'link-dark']
                    );
                    ?>
                </h2>
            </div>
            <!-- /.post-header -->
            <div class="post-content">
                <?= h($post->notes) ?>
            </div>
            <!-- /.post-content -->
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