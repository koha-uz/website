<header class="wrapper bg-soft-primary">
    <?= $this->element('headers/founder') ?>
    <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100">
                <?= $this->Html->image('logo.svg', ['url' => ['_name' => 'home']]) ?>
            </div>
            <?= $this->element('headers/nav') ?>
        </div>
        <!-- /.container -->
    </nav>
    <!-- /.navbar -->
</header>
<!-- /header -->