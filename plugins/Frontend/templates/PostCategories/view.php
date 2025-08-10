<?php
$this->assign('meta', $this->MetaRender
    ->init($postCategory->meta_tag)
    ->render()
);

$breadcrumbs = [
    ['title' => __d('frontend', 'Posts'), 'url' => ['controller' => 'Posts', 'action' => 'index']],
    ['title' => $postCategory->title]
];
$this->set('breadcrumbs', $breadcrumbs);

$this->start('header');
echo $this->element('/headers/header-light');
$this->end();
?>

<section class="wrapper">
    <div class="container pt-10">
        <div class="row">
            <div class="col-12">
                <?= $this->element('breadcrumbs') ?>
                <h1 class="display-2 mb-3"><?= $postCategory->title ?></h1>
                <p class="lead fs-lg pe-lg-15 pe-xxl-12"><?= $postCategory->body ?></p>
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
        <div class="row">
            <div class="col-12">
                <?php
                echo $this->element('Posts/list', ['posts' => $posts]);
                echo $this->element('paginator', ['entities' => $posts]);
                ?>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->