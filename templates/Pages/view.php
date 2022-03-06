<?php
$this->assign('meta', $this->MetaRender
    ->init($page->meta_tag, ['og' => ['type' => 'article']])
    ->render()
);

$this->start('header');
//echo $this->element('header');
$this->end();
?>

<h1><?= h($page->title) ?></h1>
<div><?= $page->body ?></div>