<?php
$this->assign('meta', $this->MetaRender
    ->init($page->meta_tag, ['og' => ['type' => 'article']])
    ->render()
);

$this->start('header');
echo $this->element('header', ['theme' => $page->header]);
$this->end();

echo $page->body;
echo $this->element('show_room');
?>