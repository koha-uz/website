<?php
$this->assign('meta', $this->MetaRender
    ->init($page->meta_tag, ['og' => ['type' => 'article']])
    ->render()
);

$this->start('header');
switch ($page->header) {
    case 1:
        echo $this->element('/headers/header-light');
        break;
    case 2:
        echo $this->element('/headers/header-absolute');
        break;
    case 3:
        echo $this->element('/headers/header-gray');
        break;
    case 4:
        echo $this->element('/headers/header-primary');
        break;
}
$this->end();

echo $page->body;
echo $this->element('show_room');
?>