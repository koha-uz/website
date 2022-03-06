<?php
$this->assign('meta', $this->MetaRender
    ->init($page->meta_tag)
    ->render()
);
?>
<div><?= $page->body ?></div>