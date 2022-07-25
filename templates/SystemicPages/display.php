<?php
$this->assign('meta', $this->MetaRender
    ->init($page->meta_tag)
    ->render()
);

$this->start('header');
echo $this->element('/headers/header-primary');
$this->end();

echo $page->body;
echo $this->cell('Posts::last');
?>