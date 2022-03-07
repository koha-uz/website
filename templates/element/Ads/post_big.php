<article class="post">
    <div class="card">
        <div class="card-body">
            <div class="post-header">
                <div class="post-category text-line">
                    <?php
                    echo $this->Html->link(
                        h($ad->ad_category->title),
                        ['_name' => 'ad_category_view', 'slug' => h($ad->ad_category->slug)],
                        ['class' => 'hover', 'rel' => 'category']
                    );
                    ?>
                </div>
                <!-- /.post-category -->
                <h2 class="post-title mt-1 mb-0">
                    <?php
                    echo $this->Html->link(
                        h($ad->title),
                        ['_name' => 'ad_view', 'slug' => h($ad->slug)],
                        ['class' => 'link-dark']
                    );
                    ?>
                </h2>
            </div>
            <!-- /.post-header -->
            <div class="post-content">
                <?= h($ad->body) ?>
            </div>
            <!-- /.post-content -->
        </div>
        <!--/.card-body -->
        <div class="card-footer">
            <ul class="post-meta d-flex mb-0">
                <li class="post-date">
                    <i class="uil uil-calendar-alt"></i>
                    <span><?= $ad->date_published->i18nFormat('d MMMM Y HH:mm') ?></span>
                </li>
            </ul>
            <!-- /.post-meta -->
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
</article>
<!-- /.post -->