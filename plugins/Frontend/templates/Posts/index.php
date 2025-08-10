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
} else {
    $breadcrumbs = [
        ['title' => __d('frontend', 'Posts')]
    ];
}

$this->set('breadcrumbs', $breadcrumbs);

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