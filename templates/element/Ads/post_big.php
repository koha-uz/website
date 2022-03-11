<article class="post">
    <div class="card">
        <?php if (!empty($ad->cover)): ?>
        <figure class="card-img-top overlay overlay-1 hover-scale">
            <?php
            echo $this->Html->link(
                $this->Image->display($ad->cover, 'big'),
                ['_name' => 'ad_category_view', 'slug' => h($ad->ad_category->slug)],
                ['escape' => false]
            );
            ?>
            <figcaption>
                <h5 class="from-top mb-0">Read More</h5>
            </figcaption>
        </figure>
        <?php elseif (!empty($ad->youtubeId)): ?>
        <div class="card-img-top">
            <div class="player" data-plyr-provider="youtube" data-plyr-embed-id="<?= $ad->youtubeId ?>"></div>
        </div>
        <?php endif; ?>
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

            <?php if (!empty($ad->notes)): ?>
            <div class="post-content">
                <?= h($ad->notes) ?>
            </div>
            <!-- /.post-content -->
            <?php endif; ?>
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