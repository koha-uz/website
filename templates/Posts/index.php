<?php
$title = $page->title;
$body = $page->body;
$metaTitle = $page->meta_tag->title;
if (isset($tag)) {
    $title = '#' . $tag->label;
    $metaTitle = __d('frontend', '#{0} – Posts', $tag->label);
    $body = '';
    $breadcrumbs = [
        ['title' => __d('frontend', 'Posts'), 'url' => ['controller' => 'Posts', 'action' => 'index']],
        ['title' => $title]
    ];
    $this->set('breadcrumbs', $breadcrumbs);
}
$this->assign('meta', $this->MetaRender
    ->init($page->meta_tag, ['title' => $metaTitle])
    ->render()
);

$this->start('header');
echo $this->element('/headers/header-light');
$this->end();
?>

<section class="wrapper">
    <div class="container pt-10">
        <div class="row">
            <div class="col-12">
                <?= $this->element('breadcrumbs') ?>
                <h1 class="display-2 mb-3"><?= $title ?></h1>
                <p class="lead fs-lg pe-lg-15 pe-xxl-12"><?= $body ?></p>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->

<section class="wrapper">
    <div class="container py-10">
        <div class="row gx-lg-8 gx-xl-12">
            <div class="col-lg-8">
                <?php
                $count = $posts->count();
                if ($count > 0) {
                    foreach($posts as $key => $post) {
                        if ($key === 0) {
                            echo '<div class="blog classic-view">';
                        }

                        if (
                            $count <= 4 ||
                            (in_array($count, [5, 7]) && $key <= 2) ||
                            ($count  === 6 && $key <= 3)
                        ) {
                            echo $this->element('Posts/post_big', ['post' => $post]);
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
                            ((in_array($count, [5, 7]) && $key >= 3)) ||
                            ($count === 6 && $key >= 4)
                        ) {
                            echo $this->element('Posts/post_mini', ['post' => $post]);
                        }

                        if (in_array($count, [5, 6, 7]) && $count === ($key + 1)) {
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                } else {

                }
                ?>

                <?= $this->element('paginator', ['entities' => $posts]) ?>
            </div>
            <!-- /column -->
          
            <aside class="col-lg-4 sidebar mt-10 mt-md-0">
                <?= $this->cell('Posts::popular') ?>
                <?= $this->cell('PostCategories') ?>
                <?= $this->cell('Posts::tags') ?>
            </aside>
            <!-- /column .sidebar -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->