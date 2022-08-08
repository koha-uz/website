<!DOCTYPE html>
<html lang="<?= $this->request->getParam('lang') ?>">
    <head>
        <?php
        echo $this->Html->charset();

        echo $this->Html->meta(
            'viewport',
            'width=device-width, initial-scale=1.0'
        );
        echo $this->Html->meta('icon', 'Frontend.img/favicon.svg', ['type' => 'image/svg+xml']);
        echo $this->fetch('meta');

        echo $this->Html->css(['plugins', 'style'], ['fullBase' => true]);
        echo $this->fetch('css');

        echo \Cake\Core\Configure::read('Settings.Metrics.yandex');
        echo \Cake\Core\Configure::read('Settings.Metrics.google');
        ?>
    </head>

    <body>
        <div class="content-wrapper">
            <?= $this->fetch('header') ?>
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

        <?= $this->Html->script(['plugins', 'theme'], ['fullBase' => true]) ?>
    </body>
</html>