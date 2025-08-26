<?php
$this->assign('meta', $this->MetaRender
    ->init($post->meta_tag)
    ->render()
);
$breadcrumbs = [
    ['title' => __d('frontend', 'Posts'), 'url' => ['controller' => 'Posts', 'action' => 'index']],
    ['title' => $post->post_category->title, 'url' => ['controller' => 'PostCategories', 'action' => 'view', 'slug' => $post->post_category->slug]],
    ['title' => $post->title]
];
$this->set('breadcrumbs', $breadcrumbs);

$this->start('header');
echo $this->element('/headers/header-gray');
$this->end();
?>

<div class="d-none">
    <?= $this->element('breadcrumbs') ?>
</div>

<!-- /header -->
<section class="wrapper bg-gray">
    <div class="container pt-10 pb-19 pt-md-14 pb-md-20 text-center">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="post-header">
                    <div class="post-category text-line">
                        <?php
                        echo $this->Html->link(
                            h($post->post_category->title),
                            [
                                'controller' => 'PostCategories', 'action' => 'view',
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
        <div class="row mb-10">
            <div class="col-lg-9 mx-auto">
                <div class="mt-n17">
                    <?php
                    if (isset($post->youtubeId) && !empty($post->youtubeId)) {
                        echo $this->Html->tag('div', '', [
                            'class' => 'player',
                            'data-plyr-provider' => 'youtube',
                            'data-plyr-embed-id' => $post->youtubeId
                        ]);
                    } elseif (isset($post->cover) && !empty($post->cover)) {
                        echo $this->Image->display($post->cover, '1070x670', ['class' => 'img-fluid mx-auto rounded shadow-lg']);
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 mx-auto">
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
                        </div>
                        <!-- /.post-footer -->
                    </article>
                    <!-- /.post -->
                </div>
                <!-- /.classic-view -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <?= $this->cell('Posts::samePostCategory', ['post' => $post]) ?>
            </div>
        </div>
    </div>
    <!-- /.container -->
</section>
<!-- /section -->