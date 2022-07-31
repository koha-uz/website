<?php if (!empty($posts)): ?>
<section class="wrapper bg-light">
    <div class="container pb-14">
        <div class="row">
            <div class="col-lg-9 col-xl-8 col-xxl-7 mx-auto">
                <h3 class="display-4 mb-6 text-center"><?= __d('frontend', 'Our publications') ?></h3>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="position-relative">
            <div class="shape bg-dot primary rellax w-17 h-20" data-rellax-speed="1" style="top: 0; left: -1.7rem;"></div>
            <div class="swiper-container dots-closer blog grid-view mb-6" data-margin="0" data-dots="true" data-items-xl="3" data-items-md="2" data-items-xs="1">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach($posts as $post): ?>
                        <div class="swiper-slide">
                            <div class="item-inner">
                                <article>
                                    <div class="card">
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
                                        <div class="card-body">
                                            <div class="post-header">
                                                <div class="post-category text-line">
                                                    <?php
                                                    echo $this->Html->link(
                                                        $post->post_category->title,
                                                        ['_name' => 'post_category_view', 'slug' => h($post->post_category->slug)],
                                                        ['class' => 'hover', 'rel' => 'category']
                                                    );
                                                    ?>
                                                </div>
                                                <!-- /.post-category -->
                                                <h2 class="post-title h3 mt-1 mb-3">
                                                    <?php
                                                    echo $this->Html->link(
                                                        $post->title,
                                                        ['_name' => 'post_view', 'slug' => h($post->slug)],
                                                        ['class' => 'link-dark']
                                                    );
                                                    ?>
                                                </h2>
                                            </div>
                                            <!-- /.post-header -->
                                            <div class="post-content">
                                                <p><?= $post->notes ?></p>
                                            </div>
                                            <!-- /.post-content -->
                                        </div>
                                        <!--/.card-body -->
                                        <div class="card-footer">
                                            <ul class="post-meta d-flex mb-0">
                                                <li class="post-date"><i class="uil uil-calendar-alt"></i><span><?= $post->date_published->i18nFormat('d MMMM Y HH:mm') ?></span></li>
                                                <li class="ms-auto"><i class="uil uil-eye"></i><span><?= $post->viewed ?></span></li>
                                            </ul>
                                            <!-- /.post-meta -->
                                        </div>
                                        <!-- /.card-footer -->
                                    </div>
                                    <!-- /.card -->
                                </article>
                                <!-- /article -->
                            </div>
                            <!-- /.item-inner -->
                        </div>
                        <!--/.swiper-slide -->
                        <?php endforeach; ?>
                    </div>
                    <!--/.swiper-wrapper -->
                </div>
                <!-- /.swiper -->
            </div>
            <!-- /.swiper-container -->
        </div>
        <!-- /.position-relative -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
<?php endif; ?>