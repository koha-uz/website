<header class="wrapper bg-soft-primary">
    <?= $this->element('headers/founder') ?>
    <nav class="navbar navbar-expand-lg center-nav transparent position-absolute navbar-dark">
        <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100">
                <a href="<?= $this->Url->build(['_name' => 'home']) ?>">
                    <?php
                    echo $this->Html->image('logo.svg', [
                        'class' => 'logo-dark',
                    ]);
                    echo $this->Html->image('logo-light.svg', [
                        'class' => 'logo-light',
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