<header class="wrapper bg-soft-primary">
    <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100">
                <?php
                echo $this->Html->image('logo.png', [
                    'url' => ['_name' => 'home']
                ]);
                ?>
            </div>
            <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                <div class="offcanvas-header d-lg-none">
                    <?= $this->Html->image('logo-white.png') ?>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php
                            echo $this->Html->link(
                                __d('frontend', 'About Us'),
                                ['_name' => 'page_view', 'slug' => 'about-us'],
                                ['title' => __d('frontend', 'About Us'), 'class' => 'nav-link']
                            );
                            ?>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><?= __d('frontend', 'Koha') ?></a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <?php
                                    echo $this->Html->link(
                                        __d('frontend', 'About Koha'),
                                        ['_name' => 'page_view', 'slug' => 'about-koha'],
                                        ['title' => __d('frontend', 'About Koha'), 'class' => 'dropdown-item']
                                    );
                                    ?>
                                </li>
                                <li class="nav-item">
                                    <?php
                                    echo $this->Html->link(
                                        __d('frontend', 'Demo Koha'),
                                        ['_name' => 'page_view', 'slug' => 'demo-koha'],
                                        ['title' => __d('frontend', 'Demo Koha'), 'class' => 'dropdown-item']
                                    );
                                    ?>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <?php
                            echo $this->Html->link(
                                __d('frontend', 'Articles'),
                                ['controller' => 'Posts', 'action' => 'index'],
                                ['title' => __d('frontend', 'Articles'), 'class' => 'nav-link']
                            );
                            ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            echo $this->Html->link(
                                __d('frontend', 'Contacts'),
                                ['_name' => 'contacts'],
                                ['title' => __d('frontend', 'Contacts'), 'class' => 'nav-link']
                            );
                            ?>
                        </li>
                    </ul>
                    <!-- /.navbar-nav -->
                    <div class="offcanvas-footer d-lg-none">
                        <div>
                            <a href="mailto:<?= \Cake\Core\Configure::read('Settings.Contacts.email') ?>" class="link-inverse">
                                <?= \Cake\Core\Configure::read('Settings.Contacts.email') ?>
                            </a>
                            <br /> <?= \Cake\Core\Configure::read('Settings.Contacts.telephone') ?> <br />
                            <nav class="nav social social-white mt-4">
                                <?= $this->element('social') ?>
                            </nav>
                            <!-- /.social -->
                        </div>
                    </div>
                    <!-- /.offcanvas-footer -->
                </div>
                <!-- /.offcanvas-body -->
            </div>
            <!-- /.navbar-collapse -->
            <div class="navbar-other w-100 d-flex ms-auto">
                <?php $lang = $this->request->getParam('lang'); ?>
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <li class="nav-item dropdown language-select text-uppercase">
                        <a class="nav-link dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $lang ?></a>
                        <ul class="dropdown-menu">                  
                            <li class="nav-item">
                                <?php
                                if ($lang == 'ru') {
                                    echo $this->Html->link('Uz', $this->I18n->changeLocaleUri('uz'), ['title' => 'O\'zbek', 'class' => 'dropdown-item', 'hreflang' => 'uz']);
                                } else {
                                    echo $this->Html->link('Ru', $this->I18n->changeLocaleUri('ru'), ['title' => 'Russian', 'class' => 'dropdown-item', 'hreflang' => 'ru']);
                                }
                                ?>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item d-lg-none">
                        <button class="hamburger offcanvas-nav-btn"><span></span></button>
                    </li>
                </ul>
                <!-- /.navbar-nav -->
            </div>
            <!-- /.navbar-other -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- /.navbar -->
</header>
<!-- /header -->