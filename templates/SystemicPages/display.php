<?php
$this->assign('meta', $this->MetaRender
    ->init($page->meta_tag)
    ->render()
);
?>

<section class="wrapper bg-soft-primary">
    <div class="container pt-10 pb-15 pt-md-14 pb-md-20 text-center">
        <div class="row">
            <div class="col-md-10 col-lg-8 col-xl-8 col-xxl-6 mx-auto mb-13">
                <h1 class="display-1 mb-4">Поддержка библиотек на базе АБИС Koha</h1>
                <p class="lead fs-lg px-xl-12 px-xxl-6 mb-7">Управляйте вашей платформой библиотечных услуг с помощью open-source решений</p>
                <div class="d-flex justify-content-center">
                    <span><a class="btn btn-primary rounded mx-1">О Коха</a></span>
                    <span><a class="btn btn-green rounded mx-1">Демо-версия</a></span>
                </div>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->

<section class="wrapper bg-light">
    <div class="container">
        <div class="row gx-0 mb-16 mb-mb-20">
            <div class="col-9 col-sm-10 col-lg-9 mx-auto mt-n15 mt-md-n20">
                <img class="img-fluid mx-auto rounded shadow-lg" src="/frontend/img/photos/sa1.jpg" srcset="/frontend/img/photos/sa1@2x.jpg 2x" alt="" />
                <img class="position-absolute rounded shadow-lg" src="/frontend/img/photos/sa2.jpg" srcset="/frontend/img/photos/sa2@2x.jpg 2x" style="top: 20%; right:-10%; max-width:30%; height: auto;" alt="" />
                <img class="position-absolute rounded shadow-lg" src="/frontend/img/photos/sa3.jpg" srcset="/frontend/img/photos/sa3@2x.jpg 2x" style="top: 10%; left:-10%; max-width:30%; height: auto;" alt="" />
                <img class="position-absolute rounded shadow-lg" src="/frontend/img/photos/sa4.jpg" srcset="/frontend/img/photos/sa4@2x.jpg 2x" style="bottom: 10%; left:-13%; max-width:30%; height: auto;" alt="" />
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->

        <div class="row gx-0 mb-16 mb-mb-20 align-items-center">
            <div class="col-lg-6 order-lg-2">
                <div class="row gx-md-5 gy-5">
                    <div class="col-md-4 offset-md-2 align-self-end">
                        <figure class="rounded"><img src="/frontend/img/photos/g1.jpg" srcset="/frontend/img/photos/g1@2x.jpg 2x" alt=""></figure>
                    </div>
                    <!--/column -->
                    <div class="col-md-6 align-self-end">
                        <figure class="rounded"><img src="/frontend/img/photos/g2.jpg" srcset="/frontend/img/photos/g2@2x.jpg 2x" alt=""></figure>
                    </div>
                    <!--/column -->
                    <div class="col-md-6 offset-md-1">
                        <figure class="rounded"><img src="/frontend/img/photos/g3.jpg" srcset="/frontend/img/photos/g3@2x.jpg 2x" alt=""></figure>
                    </div>
                    <!--/column -->
                    <div class="col-md-4 align-self-start">
                        <figure class="rounded"><img src="/frontend/img/photos/g4.jpg" srcset="/frontend/img/photos/g4@2x.jpg 2x" alt=""></figure>
                    </div>
                    <!--/column -->
                </div>
                <!--/.row -->
            </div>
            <!--/column -->
          
            <div class="col-lg-6">
                <img src="/frontend/img/icons/lineal/megaphone.svg" class="svg-inject icon-svg icon-svg-md mb-4" alt="" />
                <h2 class="display-4 mb-3">Кто мы?</h2>
                <p class="lead fs-lg">Мы сотрудники библиотеки Университета Пучон в Ташкенте и помогаем внедрять АБИС Коха в Узбекистане</p>
                <p class="mb-6">Для автоматизации процессов в нашей библиотеке мы используем open-source решения, которые позволяют улучшить качество предоставляемых услуг и существенно уменьшить нагрузку на бюджет университета. Наш опыт оказался востребованным в Узбекистане, и мы им делимся.</p>
                <a href="#" class="btn btn-primary rounded-pill mb-0">Подробнее о нас</a>
            </div>
            <!--/column -->
        </div>
        <!-- /.row -->

        <div class="row gx-0 mb-16 mb-mb-20 align-items-center">
            <div class="col-md-8 col-lg-6 position-relative">
                <div class="shape bg-dot primary rellax w-17 h-21" data-rellax-speed="1" style="top: -2rem; left: -1.9rem;"></div>
                <div class="shape rounded bg-soft-primary rellax d-md-block" data-rellax-speed="0" style="bottom: -1.8rem; right: -1.5rem; width: 85%; height: 90%; "></div>
                <figure class="rounded"><img src="/frontend/img/photos/about7.jpg" srcset="/frontend/img/photos/about7@2x.jpg 2x" alt="" /></figure>
            </div>
            <!--/column -->
            <div class="col-lg-5 col-xl-4 offset-lg-1">
                <h3 class="display-4 mb-7">Услуги, которые мы предлагаем:</h3>
                <div class="d-flex flex-row mb-6">
                    <div>
                        <span class="icon btn btn-block btn-soft-primary disabled me-5"><span class="number fs-18">1</span></span>
                    </div>
                    <div>
                        <h4 class="mb-1">Установка и настройка АБИС Коха</h4>
                        <p class="mb-0">В течение 5-ти рабочих дней мы проведём установку и настройку всех компонентов системы.</p>
                    </div>
                </div>
                <div class="d-flex flex-row mb-6">
                    <div>
                        <span class="icon btn btn-block btn-soft-primary disabled me-5"><span class="number fs-18">2</span></span>
                    </div>
                    <div>
                        <h4 class="mb-1">Интеграция с библиотечным оборудованием</h4>
                        <p class="mb-0">Подключим чековые и этикеточные принтеры, а также библиотечное оборудование по протоколу SIP 2.0.</p>
                    </div>
                </div>
                <div class="d-flex flex-row mb-8">
                    <div>
                        <span class="icon btn btn-block btn-soft-primary disabled me-5"><span class="number fs-18">3</span></span>
                    </div>
                    <div>
                        <h4 class="mb-1">Обучение персонала</h4>
                        <p class="mb-0">В течение 20-ти часового интенсивного курса обучения, будут освоены навыки управления системой.</p>
                    </div>
                </div>

                <a href="#" class="btn btn-primary rounded-pill mb-0">Подробнее о наших услугах</a>
            </div>
            <!--/column -->
        </div>
        <!--/.row -->
    </div>
</section>

<section id="snippet-4" class="wrapper bg-light">
    <div class="container pb-14">
        <div class="card image-wrapper bg-full bg-image bg-overlay bg-overlay-300" data-image-src="/frontend/img/photos/bg16.png">
            <div class="card-body p-10 p-xl-12">
                <div class="row text-center">
                    <div class="col-xl-11 col-xxl-9 mx-auto">
                        <h3 class="display-3 mb-8 px-lg-8 text-white">Хотите увидеть работу АБИС Коха в <span class="underline-3 style-2 yellow">действующей</span> библиотеке?</h3>
                        <p class="lead fs-lg mb-4 px-xl-10 px-xxl-15 text-white">Записывайтесь на консультацию</p>
                        <p class="text-center text-white display-4 mb-3">+998 (93) 581-60-51</p>
                        <div class="text-center text-white display-1">
                            <a href="" target="_blank" class="text-white"><i class="uil uil-telegram"></i></a>
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
<!-- /section -->

<?= $this->cell('Posts::last') ?>

<div><?= $page->body ?></div>