<?php
$this->assign('title', __d('panel', 'Change password'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Change password')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu = true;
echo $this->element('navigation', compact('menu'));
$this->end();

echo $this->element('Panel.change_password');
?>
