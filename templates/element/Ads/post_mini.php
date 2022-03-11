<article class="item post col-md-6">
    <div class="card">
        <figure class="card-img-top overlay overlay-1 hover-scale">
            <a href="#"> <img src="./assets/img/photos/b4.jpg" alt="" /></a>
            <figcaption>
                <h5 class="from-top mb-0">Read More</h5>
            </figcaption>
        </figure>
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
                <h2 class="post-title h3 mt-1 mb-3">
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