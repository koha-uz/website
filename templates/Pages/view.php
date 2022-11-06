<?php
$this->assign('meta', $this->MetaRender
    ->init($page->meta_tag, ['og' => ['type' => 'article']])
    ->render()
);

$this->start('header');
echo $this->element('/headers/header-light');
$this->end();

echo $page->body;
echo $this->element('show_room');
?>