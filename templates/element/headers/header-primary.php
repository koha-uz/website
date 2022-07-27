<header class="wrapper bg-soft-primary">
    <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100">
                <?php
                echo $this->Html->image('logo-2x.png', [
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