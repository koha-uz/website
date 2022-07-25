<header class="wrapper bg-gray">
    <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100">
                <?php
                echo $this->Html->image('logo.png', [
                    'url' => ['_name' => 'home'],
                    'srcset' => $this->Url->image('Frontend.logo-2x.png'). ' 2x'
                ]);
                ?>
            </div>
            <?= $this->element('headers/nav') ?>
        </div>
        <!-- /.container -->
    </nav>
    <!-- /.navbar -->
</header>
<!-- /header -->