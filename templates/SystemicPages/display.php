<?php
$this->assign('meta', $this->MetaRender
    ->init($page->meta_tag)
    ->render()
);

$this->start('header');
$menu['home'] = true;
//echo $this->element('header', compact('menu'));
$this->end();

$breadcrumbs = [
    ['title' => __d('panel', 'Home')]
];

//echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
?>
<h1><?= h($page->title) ?></h1>
<div><?= $page->body ?></div>
