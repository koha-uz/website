<!DOCTYPE html>
<html lang="<?= $this->request->getParam('lang') ?>">
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= $this->fetch('meta') ?>
        <title><?= $this->fetch('title') ?></title>
        <?= $this->Html->meta('icon') ?>
        <?= $this->Html->css('plugins', ['fullBase' => true]) ?>
        <?= $this->Html->css('style', ['fullBase' => true]) ?>
        <?= $this->fetch('css') ?>
    </head>

    <body>
        <div class="content-wrapper">
            <?= $this->element('header') ?>
            <!-- /header -->
            <?= $this->fetch('breadcrumbs') ?>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
        <!-- /.content-wrapper -->
        <?= $this->element('footer') ?>
        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>

        <?= $this->Html->script('plugins') ?>
        <?= $this->Html->script('theme') ?>
    </body>
</html>