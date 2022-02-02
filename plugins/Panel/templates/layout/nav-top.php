<!DOCTYPE html>
<html lang="<?= $this->request->getParam('lang') ?>">
    <head>
        <?= $this->Html->charset() ?>
        <title><?= $this->fetch('title') ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <?= $this->fetch('meta') ?>
        <!-- base css -->
        <?= $this->Html->css('vendors.bundle') ?>
        <?= $this->Html->css('app.bundle') ?>
        <?= $this->fetch('css') ?>

        <!-- Place favicon.ico in the root directory -->
        <?= $this->Html->meta('icon') ?>
        <link rel="apple-touch-icon" sizes="180x180" href="/panel/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/panel/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="/panel/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <!--<link rel="stylesheet" media="screen, print" href="css/your_styles.css">-->
    </head>
    <body class="nav-function-top">
    <script>
            /**
             *	This script should be placed right after the body tag for fast execution
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /**
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /**
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);
            }
            /**
             * Save to localstorage
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /**
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
        <!-- BEGIN Page Wrapper -->
        <div class="alert alert-info m-0 p-0 rounded-0 px-1 py-2">
            <div class="container-fluid">
                <div class="text-center">
                    <strong><?= __d('panel', 'Beta testing of the updated user account is underway. Email address for inquiries: {0}', $this->Html->tag('u', 'support@but.uz')) ?></strong>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <aside class="page-sidebar">
                    <div class="page-logo">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                            <img src="/panel/img/logo.png" alt="<?= __d('panel', 'Control panel') ?>" aria-roledescription="logo">
                            <span class="page-logo-text mr-1"><?= __d('panel', 'Control panel') ?></span>
                            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                        </a>
                    </div>

                    <!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav" class="primary-nav" role="navigation">
                        <div class="nav-filter">
                            <div class="position-relative">
                                <input type="text" id="nav_filter_input" placeholder="<?= __d('panel', 'Filter menu') ?>" class="form-control" tabindex="0">
                                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                    <i class="fal fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>

                        <div class="info-card">
                            <?php
                            $photo = $this->request->getSession()->read('Auth.photo');
                            if (null !== $photo) {
                                list($type, ) = explode('/', $photo->mime_type);
                                if ($type == 'image' && file_exists($this->Image->imageUrl($photo))) {
                                    echo $this->Image->display($photo, null, ['class' => 'profile-image rounded-circle']);
                                } else {
                                    echo $this->Html->image('avatar-m.png', ['class' => 'profile-image rounded-circle']);
                                }
                            } else {
                                echo $this->Html->image('avatar-m.png', ['class' => 'profile-image rounded-circle']);
                            }
                            ?>
                            <div class="info-card-text">
                                <span class="d-flex align-items-center text-white">
                                    <span class="text-truncate text-truncate-sm d-inline-block fw-700">
                                        <?php
                                        $userProfile = $this->request->getSession()->read('Auth.user_profile');
                                        if (null !== $userProfile) {
                                            echo $userProfile->full_name;
                                        } else {
                                            echo ucfirst($this->request->getSession()->read('Auth.username'));
                                        }
                                        ?>
                                    </span>
                                </span>
                                <span class="d-inline-block text-truncate text-truncate-sm">
                                    <?php
                                    /*$roles = $this->request->getSession()->read('Auth.roles');
                                    foreach($roles as $role) {
                                        echo $role->name;
                                    }*/
                                    ?>
                                </span>
                            </div>
                            <?= $this->Html->image('card-backgrounds/cover-5-lg.png', ['class' => 'cover']) ?>
                            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                                <i class="fal fa-angle-down"></i>
                            </a>
                        </div>

                        <?= $this->fetch('navigation') ?>
                    </nav>
                    <!-- END PRIMARY NAVIGATION -->
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
                    <header class="page-header" role="banner">
                        <div class="page-logo">
                            <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                                <img src="/panel/img/logo.png" alt="<?= __d('panel', 'Control panel') ?>" aria-roledescription="logo">
                                <span class="page-logo-text mr-1"><?= __d('panel', 'Control panel') ?></span>
                                <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                            </a>
                        </div>
                        <!-- DOC: nav menu layout change shortcut -->
                        <div class="hidden-md-down dropdown-icon-menu position-relative">
                            <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                                <i class="ni ni-menu"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                                        <i class="ni ni-minify-nav"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                                        <i class="ni ni-lock-nav"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- DOC: mobile button appears during mobile width -->
                        <div class="hidden-lg-up">
                            <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                                <i class="ni ni-menu"></i>
                            </a>
                        </div>
                        <div class="ml-auto d-flex">
                            <!-- app user menu -->
                            <div>
                                <a href="#" data-toggle="dropdown" class="header-icon d-flex align-items-center justify-content-center ml-2">
                                    <?php
                                    $photo = $this->request->getSession()->read('Auth.photo');
                                    if (null !== $photo) {
                                        list($type, ) = explode('/', $photo->mime_type);
                                        if ($type == 'image' && file_exists($this->Image->imageUrl($photo))) {
                                            echo $this->Image->display($photo, null, ['class' => 'profile-image rounded-circle']);
                                        } else {
                                            echo $this->Html->image('avatar-m.png', ['class' => 'profile-image rounded-circle']);
                                        }
                                    } else {
                                        echo $this->Html->image('avatar-m.png', ['class' => 'profile-image rounded-circle']);
                                    }
                                    ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg">

                                    <div class="dropdown-divider m-0"></div>
                                    <a href="#" class="dropdown-item" data-action="app-fullscreen">
                                        <span><?= __d('panel', 'Fullscreen') ?></span>
                                        <i class="float-right text-muted fw-n">F11</i>
                                    </a>
                                    <div class="dropdown-multilevel dropdown-multilevel-left">
                                        <div class="dropdown-item"><?= __d('panel', 'Language') ?></div>
                                        <div class="dropdown-menu">
                                            <?php
                                            echo $this->Html->link('English', $this->I18n->changeLocaleUri('en'), ['title' => 'English', 'hreflang' => 'en', 'class' => 'dropdown-item']);
                                            echo $this->Html->link('Русский', $this->I18n->changeLocaleUri('ru'), ['title' => 'Русский', 'hreflang' => 'ru', 'class' => 'dropdown-item']);
                                            echo $this->Html->link('O\'zbek', $this->I18n->changeLocaleUri('uz'), ['title' => 'O\'zbek', 'hreflang' => 'uz', 'class' => 'dropdown-item']);
                                            ?>
                                        </div>
                                    </div>
                                    <?php if ($this->Identity->isLoggedIn()): ?>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'changePassword']) ?>" class="dropdown-item">
                                        <span><?= __d('panel', 'Change password') ?></span>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item fw-500 pt-3 pb-3" href="<?= $this->Url->build(['_name' => 'logout']) ?>">
                                        <span><?= __d('panel', 'Logout') ?></span>
                                        <span class="float-right fw-n">&commat;<?= $this->Identity->get('username') ?></span>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                        <?= $this->fetch('breadcrumbs') ?>
                        <?= $this->Flash->render() ?>
                        <?= $this->fetch('content') ?>
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    <?= $this->element('footer') ?>
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                    <div class="modal fade modal-backdrop-transparent" id="modal-shortcut" tabindex="-1" role="dialog" aria-labelledby="modal-shortcut" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-top modal-transparent" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <ul class="app-list w-auto h-auto p-0 text-left">
                                        <li>
                                            <a href="/" class="app-list-item text-white border-0 m-0">
                                                <div class="icon-stack">
                                                    <i class="base base-7 icon-stack-3x opacity-100 color-primary-500 "></i>
                                                    <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                                    <i class="fal fa-home icon-stack-1x opacity-100 color-white"></i>
                                                </div>
                                                <span class="app-list-name"><?= __d('panel', 'Home') ?></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Shortcuts -->
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->
        <nav class="shortcut-menu d-none d-sm-block">
            <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
            <label for="menu_open" class="menu-open-button ">
                <span class="app-shortcut-icon d-block"></span>
            </label>
            <a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
                <i class="fal fa-arrow-up"></i>
            </a>
            <a href="<?= $this->Url->build(['_name' => 'logout']) ?>" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Logout">
                <i class="fal fa-sign-out"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left" title="Full Screen">
                <i class="fal fa-expand"></i>
            </a>
        </nav>
        <!-- END Quick Menu -->


        <?= $this->Html->script('vendors.bundle') ?>
        <?= $this->Html->script('dependency/moment/moment') ?>
        <?= $this->Html->script('moment-timezone-with-data') ?>

        <script>
        moment.tz.setDefault("Asia/Tashkent");
        </script>

        <?= $this->Html->script('app.bundle') ?>

        <?= $this->fetch('script') ?>
        <script>
            function postModal(url, title = null, message = null)
            {
                let modalTitle = '<?php __d('panel', 'Are you sure?') ?>';
                if (title) {
                    modalTitle = title;
                }

                let modalMessage = '';
                if (message) {
                    modalMessage = '<br/>' + message;
                }
                bootbox.confirm({
                    title: '<?= __d('panel', 'Critical action') ?>',
                    message: '<div class="alert alert-warning text-secondary mb-0">' +
                                '<div class="d-flex align-items-center">' +
                                    '<div class="alert-icon">' +
                                        '<span class="icon-stack icon-stack-md">' +
                                            '<i class="fal fa-exclamation-triangle icon-stack-3x color-warning-900"></i>' +
                                        '</span>' +
                                    '</div>' +
                                '<div class="flex-1 ml-2">' +
                                    '<span class="h5 color-warning-900">' + modalTitle + '</span>' +
                                    modalMessage +
                                '</div>' +
                            '</div>',
                    callback: function (result) {
                        if (result) {
                            let form = document.createElement('form');
                            form.action = url;
                            form.method = 'POST';
                            form.innerHTML = '<input type="hidden" name="_method" value="POST"/>';
                            document.body.append(form);
                            form.submit();
                        }
                    }
                });
            }

            $('#js-page-content').smartPanel(
            {
                localStorage: true,
                onChange: function() {},
                onSave: function() {},
                opacity: 1,
                deleteSettingsKey: '#deletesettingskey-options',
                settingsKeyLabel: 'Reset settings?',
                deletePositionKey: '#deletepositionkey-options',
                positionKeyLabel: 'Reset position?',
                sortable: true,
                buttonOrder: '%collapse% %fullscreen% %close%',
                buttonOrderDropdown: '%refresh% %locked% %color% %custom% %reset%',
                customButton: false,
                onCustom: function() {},
                closeButton: true,
                onClosepanel: function()
                {
                    if (myapp_config.debugState)
                        console.log($(this).closest(".panel").attr('id') + " onClosepanel")
                },
                fullscreenButton: true,
                onFullscreen: function()
                {
                    if (myapp_config.debugState)
                        console.log($(this).closest(".panel").attr('id') + " onFullscreen")
                },
                collapseButton: true,
                onCollapse: function()
                {
                    if (myapp_config.debugState)
                        console.log($(this).closest(".panel").attr('id') + " onCollapse")
                },
                lockedButton: true,
                lockedButtonLabel: "Lock Position",
                onLocked: function()
                {
                    if (myapp_config.debugState)
                        console.log($(this).closest(".panel").attr('id') + " onLocked")
                },
                refreshButton: true,
                refreshButtonLabel: "Refresh Content",
                onRefresh: function(){},
                colorButton: false,
                resetButton: false,
                resetButtonLabel: "Reset Panel",
                onReset: function()
                {
                    if (myapp_config.debugState)
                        console.log($(this).closest(".panel").attr('id') + " onReset callback")
                }
            });

            $(document).ready(function()
            {
                localStorage.clear();

            });
        </script>
        <?= $this->fetch('script-code') ?>
    </body>
</html>
