<?php
use Cake\Core\Configure;
?>

<div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
    <div class="offcanvas-header d-lg-none">
        <?= $this->Html->image('logo-light.svg') ?>
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
                            ['_name' => 'page_view', 'slug' => 'about-ils-koha'],
                            ['title' => __d('frontend', 'About Koha'), 'class' => 'dropdown-item']
                        );
                        ?>
                    </li>
                    <li class="nav-item">
                        <?php
                        echo $this->Html->link(
                            __d('frontend', 'Demo Koha'),
                            ['_name' => 'page_view', 'slug' => 'demo-ils-koha'],
                            ['title' => __d('frontend', 'Demo Koha'), 'class' => 'dropdown-item']
                        );
                        ?>
                    </li>
                    <li class="nav-item">
                        <?php
                        echo $this->Html->link(
                            __d('frontend', 'Translation by Koha'),
                            ['_name' => 'page_view', 'slug' => 'translation-by-koha'],
                            ['title' => __d('frontend', 'Translation by Koha'), 'class' => 'dropdown-item']
                        );
                        ?>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <?php
                echo $this->Html->link(
                    __d('frontend', 'Services'),
                    ['_name' => 'page_view', 'slug' => 'services'],
                    ['title' => __d('frontend', 'Services'), 'class' => 'nav-link']
                );
                ?>
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
                    ['_name' => 'page_view', 'slug' => 'contacts'],
                    ['title' => __d('frontend', 'Contacts'), 'class' => 'nav-link']
                );
                ?>
            </li>
        </ul>
        <!-- /.navbar-nav -->
        <div class="offcanvas-footer d-lg-none">
            <div>
                <a href="mailto:<?= Configure::read('Settings.Contacts.email') ?>" class="link-inverse">
                    <?= Configure::read('Settings.Contacts.email') ?>
                </a>
                <br /> 
                
                <a href="tel:<?= Configure::read('Settings.Contacts.telephone') ?>" class="link-inverse">
                    <?= Configure::read('Settings.Contacts.telephone') ?>
                </a>
                <br/>

                <address class="mt-3">
                    <a href="<?= Configure::read('Settings.Contacts.address_google') ?>" target="_blank" class="link-inverse">
                        <?= Configure::read('Settings.Contacts.address') ?>
                    </a>
                </address>

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
    <ul class="navbar-nav flex-row align-items-center ms-auto">
        <li class="nav-item dropdown language-select">
            <a class="nav-link dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= $this->I18n->titleLocale() ?>
            </a>
            <ul class="dropdown-menu">                  
                <li class="nav-item">
                    <?php
                    echo $this->Html->link($this->I18n->titleLocale('uz'), $this->I18n->changeLocaleUri('uz'), ['title' => $this->I18n->titleLocale('uz'), 'class' => 'dropdown-item', 'hreflang' => 'uz']);
                    echo $this->Html->link($this->I18n->titleLocale('ru'), $this->I18n->changeLocaleUri('ru'), ['title' => $this->I18n->titleLocale('ru'), 'class' => 'dropdown-item', 'hreflang' => 'ru']);
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