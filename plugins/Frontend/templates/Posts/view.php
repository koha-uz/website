<?php
$this->assign('meta', $this->MetaRender
    ->init($post->meta_tag)
    ->render()
);
$breadcrumbs = [
    ['title' => __d('frontend', 'Posts'), 'url' => ['controller' => 'Posts', 'action' => 'index']],
    ['title' => $post->post_category->title, 'url' => ['_name' => 'post_category_view', 'slug' => $post->post_category->slug]],
    ['title' => $post->title]
];
$this->set('breadcrumbs', $breadcrumbs);

$this->start('header');
echo $this->element('/headers/header-primary');
$this->end();
?>

<?php if ($this->Identity->isLoggedIn()): ?>
<!--<div class="row mb-5">
    <div class="col-lg-9">
        <?php if ($post->published): ?>
        <div class="alert alert-success alert-icon" role="alert">
            <strong><i class="uil uil-check-circle"></i> <?= __d('frontend', 'Success!') ?></strong>
            <?= __d('frontend', 'Post published.') ?>
        </div>
        <?php else: ?>
        <div class="alert alert-warning alert-icon" role="alert">
            <strong><i class="uil uil-exclamation-triangle"></i> <?= __d('frontend', 'Warning!') ?></strong>
            <?= __d('frontend', 'Post not published.') ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="col-lg-3">
        <div class="d-grid gap-2">
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'uil uil-edit']) . ' ' . __d('frontend', 'Edit'),
                [
                    'controller' => 'posts',
                    'action' => 'edit',
                    $post->id,
                    'prefix' => 'Admin'
                ],
                ['escape' => false, 'class' => 'btn btn-lg btn-primary mt-1']
            );
            ?>
        </div>
    </div>
</div>-->
<?php endif; ?>

<!-- /header -->
<section class="wrapper bg-soft-primary">
    <div class="container pt-10 pb-19 pt-md-14 pb-md-20 text-center">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="post-header">
                    <div class="post-category text-line">
                        <?php
                        echo $this->Html->link(
                            h($post->post_category->title),
                            [
                                '_name' => 'post_category_view',
                                'slug' => h($post->post_category->slug)
                            ],
                            ['class' => 'hover', 'rel' => 'category']
                        );
                        ?>
                    </div>
                    <!-- /.post-category -->
                    <h1 class="display-1 mb-4"><?= $post->title ?></h1>
                    <ul class="post-meta mb-5">
                        <?php if (isset($post->published)): ?>
                        <li class="post-date">
                            <i class="uil uil-calendar-alt"></i>
                            <span><?= $post->published->i18nFormat('d MMMM Y HH:mm') ?></span>
                        </li>
                        <?php endif; ?>
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
<!-- /section -->

<section class="wrapper bg-light">
    <div class="container pb-14 pb-md-16">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="blog single mt-n17">
                    <div class="mb-6">
                        <?php
                        if (isset($post->youtubeId) && !empty($post->youtubeId)) {
                            echo $this->Html->tag('div', '', [
                                'class' => 'player',
                                'data-plyr-provider' => 'youtube',
                                'data-plyr-embed-id' => $post->youtubeId
                            ]);
                        }
                        ?>
                    </div>

                    <div class="card mb-6">
                        <figure class="card-img-top"><?= $this->Image->display($post->cover, '1070x670', ['class' => 'img-fluid']) ?></figure>
                    </div>
                        
                    <div class="classic-view">
                        <article class="post">
                            <div class="post-content mb-5"><?= $post->body ?></div>
                            <!-- /.post-content -->
                            <div class="post-footer d-md-flex flex-md-row justify-content-md-between align-items-center mt-8">

                                <?php if (!empty($post->tags)): ?>
                                <div>
                                    <ul class="list-unstyled tag-list mb-0">
                                        <?php foreach($post->tags as $tag): ?>
                                        <li>
                                            <?php
                                            echo $this->Html->link(h($tag->label), [
                                                'controller' => 'Posts',
                                                'action' => 'index',
                                                '?' => ['tag' => h($tag->slug)]
                                            ],
                                            ['class' => 'btn btn-soft-ash btn-sm rounded-pill mb-0']);
                                            ?>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php endif; ?>

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
                            
                    <?= $this->cell('Posts::samePostCategory', ['post' => $post]) ?>
                </div>
                <!-- /.blog -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->


<?= $this->element('breadcrumbs') ?>