<?php
$this->start('header');
echo $this->element('/headers/header-light');
$this->end();
?>

<section class="wrapper bg-light">
    <div class="container pt-12 pt-md-14 pb-14 pb-md-16">
        <div class="row">
            <div class="col-lg-9 col-xl-8 mx-auto">
                <figure class="mb-10">
                    <?php
                    echo $this->Html->image('illustrations/404.png', [
                        'class' => 'img-fluid',
                        'srcset' => $this->Url->image('Frontend.404-2x.png'). ' 2x'
                    ]);
                    ?>    
                </figure>
            </div>
            <!-- /column -->
            <div class="col-lg-8 col-xl-7 col-xxl-6 mx-auto text-center">
                <h1 class="mb-3"><?= __d('frontend', 'Oops! Page Not Found.') ?></h1>
                <p class="lead mb-7 px-md-12 px-lg-5 px-xl-7"><?= __d('frontend', 'The page you are looking for is not available or has been moved. Try a different page or go to homepage with the button below.') ?></p>
                <?php
                echo $this->Html->link(
                    __d('frontend', 'Go to Homepage'),
                    ['_name' => 'home'],
                    [
                        'class' => 'btn btn-primary rounded-pill'
                    ]
                );
                ?>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->