<?php
$this->assign('meta', $this->MetaRender->init($page->meta_tag)->render());

$this->start('header');
echo $this->element('/headers/header-absolute');
$this->end();

echo $page->body;
?>