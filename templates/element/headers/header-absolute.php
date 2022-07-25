<header class="wrapper bg-soft-primary">
    <nav class="navbar navbar-expand-lg center-nav transparent position-absolute navbar-dark">
        <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100">
                <a href="<?= $this->Url->build(['_name' => 'home']) ?>">
                    <?php
                    echo $this->Html->image('logo.png', [
                        'class' => 'logo-dark',
                        'srcset' => $this->Url->image('Frontend.logo-2x.png'). ' 2x'
                    ]);
                    echo $this->Html->image('logo-light.png', [
                        'class' => 'logo-light',
                        'srcset' => $this->Url->image('Frontend.logo-light-2x.png'). ' 2x'
                    ]);
                    ?>
                </a>

            </div>
            <?= $this->element('headers/nav') ?>
        </div>
        <!-- /.container -->
    </nav>
    <!-- /.navbar -->
</header>
<!-- /header -->