<?php
$this->assign('title', __d('admin', 'Upload file(s)'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('admin', 'Files'), 'url' => ['action' => 'index']],
    ['title' => __d('admin', 'Upload file(s)')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['files']['upload'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css('formplugins/dropzone/dropzone', ['block' => true]);
echo $this->Html->script('formplugins/dropzone/dropzone', ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
Dropzone.autoDiscover = false;
$(document).ready(function() {
    $("#form").dropzone({
        maxFilesize: 100,
        init: function() {
            this.on("uploadprogress", function (file, progress) {
                console.log("File progress", progress);
            });
        }
    });
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-plus-circle"></i> <?= __d('admin', 'Upload file(s)') ?>
    </h1>
    <div class="subheader-block d-none d-sm-flex align-items-center">
        <?= $this->AuthUser->link(__d('admin', 'Upload OpenGraph image(s)'), ['controller' => 'Files', 'action' => 'addOpenGraph'], ['class' => 'btn btn-xs btn-success']) ?>
    </div>
</div>

<?= $this->Form->create($file, ['type' => 'file', 'class' => 'dropzone needsclick', 'id' => 'form']) ?>
<div class="dz-message needsclick">
    <i class="fal fa-cloud-upload text-muted mb-3"></i> <br>
    <span class="text-uppercase"><?= __d('admin', 'Drop files here or click to upload') ?></span>
</div>
<?= $this->Form->end() ?>
