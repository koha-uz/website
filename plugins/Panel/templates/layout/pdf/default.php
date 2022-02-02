<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->Html->charset() ?>
        <title><?= $this->fetch('title') ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <style type="text/css">
            <?= file_get_contents(ROOT . DS . 'plugins' . DS . 'Panel' . DS . 'webroot' . DS . 'css' . DS . 'vendors.bundle.css') ?>
            <?= file_get_contents(ROOT . DS . 'plugins' . DS . 'Panel' . DS . 'webroot' . DS . 'css' . DS . 'app.bundle.css') ?>
        </style>
        <?= $this->Html->meta('icon') ?>

        <style>
        .new-page {
            page-break-before: always;
        }
        </style>
    </head>
    <body>
        <?= $this->fetch('content') ?>
    </body>
</html>
