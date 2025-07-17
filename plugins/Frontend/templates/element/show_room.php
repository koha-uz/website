<section class="wrapper bg-light">
    <div class="container pb-14">
        <div class="card image-wrapper bg-full bg-image bg-overlay bg-overlay-10" data-image-src="https://koha.uz/assets/file_storage/79/5e/7b/c0536afe9adb4f0f9f63f3a420cad700/c0536afe9adb4f0f9f63f3a420cad700.png">
            <div class="card-body p-10 p-xl-12">
                <div class="row text-center">
                    <div class="col-xl-11 col-xxl-9 mx-auto">
                        <h3 class="display-3 mb-8 px-lg-8 text-white"><?= __d('frontend', 'Would you like to see the work of ABIS Koha in <span class="underline-3 style-2 yellow">the current</span> library?') ?></h3>
                        <p class="lead fs-lg mb-4 px-xl-10 px-xxl-15 text-white"><?= __d('frontend', 'Sign up for a consultation') ?></p>
                        <p class="text-center text-white display-6 mb-3"><?= \Cake\Core\Configure::read('Settings.Contacts.telephone') ?></p>
                        <div class="text-center text-white display-1">
                            <a href="https://t.me/<?= \Cake\Core\Configure::read('Settings.Contacts.telegram') ?>" target="_blank" class="text-white"><i class="uil uil-telegram"></i></a>
                        </div>
                    </div>
                    <!-- /column -->
                </div>
                <!-- /.row -->
            </div>
            <!--/.card-body -->
        </div>
        <!--/.card -->
    </div>
    <!-- /.container -->
</section>