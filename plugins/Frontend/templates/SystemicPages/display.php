<?php
$this->assign('meta', $this->MetaRender
    ->init($page->meta_tag)
    ->render()
);

$this->start('header');
echo $this->element('header', ['theme' => HEADER_THEME_PRIMARY]);
$this->end();

echo $page->body;
echo $this->element('show_room');
echo $this->cell('Posts::last');
?>