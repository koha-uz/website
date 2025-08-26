<?php
$this->start('header');
echo $this->element('header', ['theme' => HEADER_THEME_PRIMARY]);
$this->end();
?>

<section class="wrapper bg-soft-primary">
    <div class="container pt-15 pb-md-21 text-center">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="display-1 mb-3"><?= __d('frontend', 'Sign In') ?></h1>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->

<section class="wrapper bg-light">
    <div class="container pb-14 pb-md-16">
        <div class="row">
            <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto mt-n20">
                <div class="card">
                    <div class="card-body p-11 text-center">
                        <h2 class="mb-3 text-start"><?= __d('frontend', 'Welcome Back') ?></h2>
                        <p class="lead mb-6 text-start"><?= __d('frontend', 'Fill your username and password to sign in.') ?></p>

                        <?php
                        echo $this->Flash->render();
                        echo $this->Form->create(null, ['autocomplete' => 'off', 'class' => 'text-start mb-3']);
                        echo $this->Form->control('username', [
                            'placeholder' => __d('frontend', 'Username')
                        ]);
                        echo $this->Form->control('password', [
                            'placeholder' => __d('frontend', 'Password')
                        ]);
                        echo $this->Form->control('remember_me', ['type' => 'checkbox', 'checked' => true, 'label' => __d('frontend', 'Remember me for the next 30 days')]);
                        echo $this->Form->submit(__d('frontend', 'Sign In'));
                        echo $this->Form->end();
                        ?>
                    </div>
                    <!--/.card-body -->
                </div>
                <!--/.card -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->