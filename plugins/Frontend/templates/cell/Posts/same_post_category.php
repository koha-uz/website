<?php if (!empty($posts)): ?>
<hr class="my-10" />
<h3 class="mb-6"><?= __d('frontend', 'You Might Also Like') ?></h3>

<div class="swiper-container blog grid-view mb-10" data-margin="30" data-dots="true" data-items-md="2" data-items-xs="1">
    <div class="swiper">
        <div class="swiper-wrapper">
            <?php foreach($posts as $post): ?>
            <div class="swiper-slide">
                <article>
                    <figure class="overlay overlay-1 hover-scale rounded mb-5">
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
                    <div class="post-header">
                        <h2 class="post-title h3 mt-1 mb-3">
                            <?php
                            echo $this->Html->link(
                                $post->title,
                                ['_name' => 'post_view', 'slug' => h($post->slug)],
                                ['class' => 'link-dark', 'title' => h($post->title)]
                            );
                            ?>
                        </h2>
                    </div>
                    <!-- /.post-header -->
                    <div class="post-footer">
                        <ul class="post-meta mb-0">
                            <li class="post-date">
                                <i class="uil uil-calendar-alt"></i>
                                <span><?= $post->date_published->i18nFormat('d MMMM Y HH:mm') ?></span>
                            </li>
                            <li class="post-date">
                                <i class="uil uil-eye"></i><span><?= $post->viewed ?></span>
                            </li>
                        </ul>
                        <!-- /.post-meta -->
                    </div>
                    <!-- /.post-footer -->
                </article>
                <!-- /article -->
            </div>
            <!--/.swiper-slide -->
            <?php endforeach; ?>                       
        </div>
        <!--/.swiper-wrapper -->
    </div>
    <!-- /.swiper -->
</div>
<!-- /.swiper-container -->
<?php endif; ?>