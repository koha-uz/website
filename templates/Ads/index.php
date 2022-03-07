<?php
$this->assign('meta', $this->MetaRender
    ->init($page->meta_tag)
    ->render()
);
?>

<section class="wrapper bg-soft-primary">
    <div class="container pt-10 pb-12 pt-md-14 pb-md-16">
        <div class="row">
            <div class="col-md-7 col-lg-6 col-xl-5 mx-auto">
                <h1 class="display-1 mb-3"><?= $page->title ?></h1>
                <p class="lead px-lg-5 px-xxl-8">Welcome to our journal. Here you can find the latest company news and business articles.</p>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->

<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <div class="row gx-lg-8 gx-xl-12">
            <div class="col-lg-8">
                <?php
                $count = $ads->count();
                if ($count > 0) {
                    foreach($ads as $key => $ad) {
                        if ($key === 0) {
                            echo '<div class="blog classic-view">';
                        }

                        if (
                            $count <= 4 ||
                            (in_array($count, [5, 7]) && $key < 2) ||
                            ($count  === 6 && $key < 3)
                        ) {
                            echo $this->element('Ads/post_big', ['ad' => $ad]);
                        }

                        if (
                            ($count <= 4 && $count === ($key + 1)) ||
                            (in_array($count, [5, 7]) && 3 === ($key + 1)) ||
                            ($count === 6 && 4 === ($key + 1))
                        ) {
                            echo '</div>';
                        }

                        if (
                            (in_array($count, [5, 7]) && 4 === ($key + 1)) ||
                            ($count === 6 && 5 === ($key + 1))
                        ) {
                            echo '<div class="blog grid grid-view">';
                            echo '<div class="row isotope gx-md-8 gy-8 mb-8">';
                        }

                        if (
                            
                        ) {
                            echo $this->element('Ads/post_mini.php', ['ad' => $ad]);
                        }

                        if (
                            (in_array($count, [5, 6, 7]) && $count === ($key + 1)) {
                                echo '</div>';
                                echo '</div>';
                            }
                        )
                    }
                } else {

                }
                ?>

                <nav class="d-flex" aria-label="pagination">
                    <ul class="pagination">
                        <?= $this->Paginator->prev(__d('frontend', 'Previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__d('frontend', 'Next')) ?>
                    </ul>
                    <!-- /.pagination -->
                </nav>
                <!-- /nav -->
                <?php else: ?>

                <?php endif; ?>
            </div>
            <!-- /column -->
          
            <aside class="col-lg-4 sidebar mt-8 mt-lg-6">
                <div class="widget">
                    <h4 class="widget-title mb-3">About Us</h4>
                    <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum. Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus.</p>
                    <nav class="nav social">
                        <a href="#"><i class="uil uil-twitter"></i></a>
                        <a href="#"><i class="uil uil-facebook-f"></i></a>
                        <a href="#"><i class="uil uil-dribbble"></i></a>
                        <a href="#"><i class="uil uil-instagram"></i></a>
                        <a href="#"><i class="uil uil-youtube"></i></a>
                    </nav>
                    <!-- /.social -->
                    <div class="clearfix"></div>
                </div>
                <!-- /.widget -->
            
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