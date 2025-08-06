<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->Html->charset() ?>
        <title><?= $this->fetch('title') ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <?= $this->Html->css('vendors.bundle') ?>
        <?= $this->Html->css('app.bundle') ?>
        <?= $this->Html->css('page-login') ?>
        <?= $this->Html->meta('icon') ?>
    </head>
    <body>
        <div class="page-wrapper auth">
            <div class="page-inner bg-brand-gradient">
                <div class="page-content-wrapper bg-transparent m-0">
                    <div class="flex-1">
                        <div class="text-center mt-5 mb-4">
                            <a href="https://bucheon.uz">
                            </a>

                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <?= $this->Flash->render() ?>
                                </div>
                            </div>
                        </div>
                        
                        <?= $this->fetch('content') ?>

                        <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                            2021 - <?= date('Y') ?> © <?= __('Bucheon University in Tashkent') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->Html->script('vendors.bundle') ?>
        <?= $this->Html->script('app.bundle') ?>
    </body>
</html>