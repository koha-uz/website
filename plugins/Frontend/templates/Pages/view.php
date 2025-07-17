<?php
$this->assign('meta', $this->MetaRender
    ->init($page->meta_tag, ['og' => ['type' => 'article']])
    ->render()
);

$this->start('header');
switch ($page->header) {
    case HEADER_THEME_LIGHT:
        echo $this->element('/headers/header-light');
        break;
    case HEADER_THEME_ABSOLUTE:
        echo $this->element('/headers/header-absolute');
        break;
    case HEADER_THEME_GRAY:
        echo $this->element('/headers/header-gray');
        break;
    default:
        echo $this->element('/headers/header-primary');
        break;
}
$this->end();

echo $page->body;
echo $this->element('show_room');
?>