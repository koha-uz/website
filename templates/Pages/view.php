<?php
$this->assign('meta', $this->MetaRender
    ->init($page->meta_tag, ['og' => ['type' => 'article']])
    ->render()
);

$this->start('header');
echo $this->element('headers/header-gray');
$this->end();

echo $page->body;
?>