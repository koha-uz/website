<?php
$this->assign('meta', $this->MetaRender
    ->init($ad->meta_tag)
    ->render()
);
?>


<section class="wrapper image-wrapper bg-image bg-overlay text-white" data-image-src="./assets/img/photos/bg5.jpg">
    <div class="container pt-17 pb-13 pt-md-19 pb-md-17 text-center">
        <div class="row">
            <div class="col-md-10 col-xl-8 mx-auto">
                <div class="post-header">
                    <div class="post-category text-line text-white">
                        <?php
                        echo $this->Html->link(
                            h($ad->ad_category->title),
                            ['_name' => 'ad_category_view', 'slug' => h($ad->ad_category->slug)],
                            ['class' => 'text-reset', 'rel' => 'category']
                        );
                        ?>
                    </div>
                    <!-- /.post-category -->
                    <h1 class="display-1 mb-4 text-white"><?= $ad->title ?></h1>
                    <ul class="post-meta text-white">
                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span><?= $ad->date_published->i18nFormat('d MMMM Y HH:mm') ?></span></li>
                    </ul>
                    <!-- /.post-meta -->
                </div>
                <!-- /.post-header -->
            </div>
        <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <div class="row gx-lg-8 gx-xl-12">
            <div class="col-lg-8">
                <div class="blog single">
                    <div class="card">
                        <?php if (!empty($ad->cover)): ?>
                        <figure class="card-img-top"><img src="./assets/img/photos/b1.jpg" alt="" /></figure>
                        <?php elseif (!empty($ad->youtubeId)): ?>
                        <div class="card-img-top">
                            <div class="player" data-plyr-provider="youtube" data-plyr-embed-id="<?= $ad->youtubeId ?>"></div>
                        </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="classic-view">
                                <article class="post">
                                    <div class="post-content mb-5"><?= $ad->body ?></div>
                                    <!-- /.post-content -->
                                    <div class="post-footer d-md-flex flex-md-row justify-content-md-between align-items-center mt-8">
                                        <div class="mb-0 mb-md-2">
                                            <div class="dropdown share-dropdown btn-group">
                                                <button class="btn btn-sm btn-red rounded-pill btn-icon btn-icon-start dropdown-toggle mb-0 me-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="uil uil-share-alt"></i> Share
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#"><i class="uil uil-twitter"></i>Twitter</a>
                                                    <a class="dropdown-item" href="#"><i class="uil uil-facebook-f"></i>Facebook</a>
                                                    <a class="dropdown-item" href="#"><i class="uil uil-linkedin"></i>Linkedin</a>
                                                </div>
                                                <!--/.dropdown-menu -->
                                            </div>
                                            <!--/.share-dropdown -->
                                        </div>
                                    </div>
                                    <!-- /.post-footer -->
                                </article>
                                <!-- /.post -->
                            </div>
                            <!-- /.classic-view -->
                            <hr />
                            
                            <h3 class="mb-6">You Might Also Like</h3>
                            <div class="carousel owl-carousel blog grid-view mb-16" data-margin="30" data-dots="true" data-autoplay="false" data-autoplay-timeout="5000" data-responsive='{"0":{"items": "1"}, "768":{"items": "2"}, "992":{"items": "2"}, "1200":{"items": "2"}}'>
                                <div class="item">
                                    <article>
                                        <figure class="overlay overlay-1 hover-scale rounded mb-5">
                                            <a href="#"> <img src="./assets/img/photos/b4.jpg" alt="" /></a>
                                            <figcaption>
                                                <h5 class="from-top mb-0">Read More</h5>
                                            </figcaption>
                                        </figure>
                                        <div class="post-header">
                                            <div class="post-category text-line">
                                                <a href="#" class="hover" rel="category">Coding</a>
                                            </div>
                                            <!-- /.post-category -->
                                            <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="./blog-post.html">Ligula tristique quis risus</a></h2>
                                        </div>
                                        <!-- /.post-header -->
                                        <div class="post-footer">
                                            <ul class="post-meta mb-0">
                                                <li class="post-date"><i class="uil uil-calendar-alt"></i><span>14 Apr 2021</span></li>
                                                <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>4</a></li>
                                            </ul>
                                            <!-- /.post-meta -->
                                        </div>
                                        <!-- /.post-footer -->
                                    </article>
                                    <!-- /article -->
                                </div>
                                <!-- /.item -->
                                <div class="item">
                                    <article>
                                        <figure class="overlay overlay-1 hover-scale rounded mb-5">
                                            <a href="#"> <img src="./assets/img/photos/b5.jpg" alt="" /></a>
                                            <figcaption>
                                                <h5 class="from-top mb-0">Read More</h5>
                                            </figcaption>
                                        </figure>
                                        <div class="post-header">
                                            <div class="post-category text-line">
                                                <a href="#" class="hover" rel="category">Workspace</a>
                                            </div>
                                            <!-- /.post-category -->
                                            <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="./blog-post.html">Nullam id dolor elit id nibh</a></h2>
                                        </div>
                                        <!-- /.post-header -->
                                        <div class="post-footer">
                                            <ul class="post-meta mb-0">
                                                <li class="post-date"><i class="uil uil-calendar-alt"></i><span>29 Mar 2021</span></li>
                                                <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>3</a></li>
                                            </ul>
                                            <!-- /.post-meta -->
                                        </div>
                                        <!-- /.post-footer -->
                                    </article>
                                    <!-- /article -->
                                </div>
                                <!-- /.item -->
                                <div class="item">
                                    <article>
                                        <figure class="overlay overlay-1 hover-scale rounded mb-5">
                                            <a href="#"> <img src="./assets/img/photos/b6.jpg" alt="" /></a>
                                            <figcaption>
                                                <h5 class="from-top mb-0">Read More</h5>
                                            </figcaption>
                                        </figure>
                                        <div class="post-header">
                                            <div class="post-category text-line">
                                                <a href="#" class="hover" rel="category">Meeting</a>
                                            </div>
                                            <!-- /.post-category -->
                                            <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="./blog-post.html">Ultricies fusce porta elit</a></h2>
                                        </div>
                                        <!-- /.post-header -->
                                        <div class="post-footer">
                                            <ul class="post-meta mb-0">
                                                <li class="post-date"><i class="uil uil-calendar-alt"></i><span>26 Feb 2021</span></li>
                                                <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>6</a></li>
                                            </ul>
                                            <!-- /.post-meta -->
                                        </div>
                                        <!-- /.post-footer -->
                                    </article>
                                    <!-- /article -->
                                </div>
                                <!-- /.item -->
                                <div class="item">
                                    <article>
                                        <figure class="overlay overlay-1 hover-scale rounded mb-5">
                                            <a href="#"> <img src="./assets/img/photos/b7.jpg" alt="" /></a>
                                            <figcaption>
                                                <h5 class="from-top mb-0">Read More</h5>
                                            </figcaption>
                                        </figure>
                                        <div class="post-header">
                                            <div class="post-category text-line">
                                                <a href="#" class="hover" rel="category">Business Tips</a>
                                            </div>
                                            <!-- /.post-category -->
                                            <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="./blog-post.html">Morbi leo risus porta eget</a></h2>
                                        </div>
                                        <div class="post-footer">
                                            <ul class="post-meta mb-0">
                                                <li class="post-date"><i class="uil uil-calendar-alt"></i><span>7 Jan 2021</span></li>
                                                <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>2</a></li>
                                            </ul>
                                            <!-- /.post-meta -->
                                        </div>
                                        <!-- /.post-footer -->
                                    </article>
                                    <!-- /article -->
                                </div>
                                <!-- /.item -->
                            </div>
                            <!-- /.owl-carousel -->

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.blog -->
            </div>
            <!-- /column -->
            <aside class="col-lg-4 sidebar mt-11 mt-lg-6">
                <div class="widget">
                    <h4 class="widget-title mb-3">Categories</h4>
                    <ul class="unordered-list bullet-primary text-reset">
                        <li><a href="#">Teamwork (21)</a></li>
                        <li><a href="#">Ideas (19)</a></li>
                        <li><a href="#">Workspace (16)</a></li>
                        <li><a href="#">Coding (7)</a></li>
                        <li><a href="#">Meeting (12)</a></li>
                        <li><a href="#">Business Tips (14)</a></li>
                    </ul>
                </div>
                <!-- /.widget -->
            </aside>
            <!-- /column .sidebar -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->