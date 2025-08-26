<?php
use Cake\Core\Configure;
?>

<ul id="js-nav-menu" class="nav-menu">

    <?php if ($this->AuthUser->hasAccess(['controller' => 'SystemicPages', 'action' => 'dashboard'])): ?>
    <!-- Dashboard menu -->
    <li class="<?= !isset($menu['dashboard']) ?: 'active' ?>">
        <?php
        echo $this->AuthUser->link(
            $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-home']).
            ' '.
            $this->Html->tag('span', __d('admin', 'Dashboard'),
                ['class' => 'nav-link-text']
            ),
            ['controller' => 'SystemicPages', 'action' => 'dashboard'],
            ['escape' => false, 'title' => __d('admin', 'Dashboard'), 'data-filter-tags' => __d('admin', 'dashboard')]
        );
        ?>
    </li>
    <?php endif; ?>

    <!-- ########################### Begin publications and files ########################### -->

    <?php
    if (
        $this->AuthUser->hasAccess(['controller' => 'Pages', 'action' => 'index']) ||
        $this->AuthUser->hasAccess(['controller' => 'SystemicPages', 'action' => 'index']) ||
        $this->AuthUser->hasAccess(['controller' => 'Posts', 'action' => 'index']) ||
        $this->AuthUser->hasAccess(['controller' => 'PostCategories', 'action' => 'index']) ||
        $this->AuthUser->hasAccess(['controller' => 'Services', 'action' => 'index']) ||
        $this->AuthUser->hasAccess(['controller' => 'Faqs', 'action' => 'index']) ||
        $this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'add']) ||
        $this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'index']) ||
        $this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'documents']) ||
        $this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'images']) ||
        $this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'openGraph'])
    ):
    ?>
    <li class="nav-title"><?= __d('admin', 'Publications and files') ?></li>
    <?php endif; ?>

    <?php
    if (
        $this->AuthUser->hasAccess(['controller' => 'Pages', 'action' => 'index']) ||
        $this->AuthUser->hasAccess(['controller' => 'SystemicPages', 'action' => 'index'])
    ):
    ?>
    <!-- Begin pages -->
    <li class="<?= !isset($menu['pages']) ?: 'active open' ?>">
        <?php
        echo $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-file-alt']) .
            $this->Html->tag(
                'span',
                __d('admin', 'Pages'),
                ['class' => 'nav-link-text']
            ),
            '#',
            ['escape' => false, 'title' => __d('admin', 'Pages'), 'data-filter-tags' => __d('admin', 'pages')]
        );
        ?>
        <ul>
            <?php if ($this->AuthUser->hasAccess(['controller' => 'Pages', 'action' => 'index'])): ?>
            <li class="<?= !isset($menu['pages']['dynamic']) ?: 'active' ?>">
                <?php
                echo $this->AuthUser->link(
                    $this->Html->tag('span', __d('admin', 'Dynamic'), ['class' => 'nav-link-text']),
                    ['controller' => 'Pages', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('admin', 'Dynamic pages'), 'data-filter-tags' => __d('admin', 'dynamic pages')]
                );
                ?>
            </li>
            <?php endif; ?>

            <?php if ($this->AuthUser->hasAccess(['controller' => 'SystemicPages', 'action' => 'index'])): ?>
            <li class="<?= !isset($menu['pages']['systemic']) ?: 'active' ?>">
                <?php
                echo $this->AuthUser->link(
                    $this->Html->tag('span', __d('admin', 'Systemic'), ['class' => 'nav-link-text']),
                    ['controller' => 'SystemicPages', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('admin', 'Systemic pages'), 'data-filter-tags' => __d('admin', 'systemic pages')]
                );
                ?>
            </li>
            <?php endif; ?>
        </ul>
    </li>
    <!-- End pages -->
    <?php endif; ?>

    <?php
    if (
        $this->AuthUser->hasAccess(['controller' => 'Posts', 'action' => 'index']) ||
        $this->AuthUser->hasAccess(['controller' => 'PostCategories', 'action' => 'index'])
    ):
    ?>
    <!-- Begin Posts -->
    <li class="<?= !isset($menu['posts']) ?: 'active open' ?>">
        <?php
        echo $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-newspaper']) .
            $this->Html->tag(
                'span',
                __d('admin', 'Posts'),
                ['class' => 'nav-link-text']
            ),
            '#',
            ['escape' => false, 'title' => __d('admin', 'posts'), 'data-filter-tags' => __d('admin', 'posts')]
        );
        ?>
        <ul>
            <?php if ($this->AuthUser->hasAccess(['controller' => 'Posts', 'action' => 'index'])): ?>
            <li class="<?= !isset($menu['posts']['list']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span', __d('admin', 'List'), ['class' => 'nav-link-text']),
                    ['controller' => 'Posts', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('admin', 'List posts'), 'data-filter-tags' => __d('admin', 'list posts')]
                );
                ?>
            </li>
            <?php endif; ?>

            <?php if ($this->AuthUser->hasAccess(['controller' => 'PostCategories', 'action' => 'index'])): ?>
            <!-- Post Categories menu -->
            <li class="<?= !isset($menu['posts']['categories']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span', __d('admin', 'Categories'), ['class' => 'nav-link-text']),
                    ['controller' => 'PostCategories', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('admin', 'Post categories'), 'data-filter-tags' => __d('admin', 'post categories')]
                );
                ?>
            </li>
            <?php endif; ?>
        </ul>
    </li>
    <!-- End Posts -->
    <?php endif; ?>

    <?php
    if (
        $this->AuthUser->hasAccess(['controller' => 'Services', 'action' => 'index']) ||
        $this->AuthUser->hasAccess(['controller' => 'Faqs', 'action' => 'index'])
    ):
    ?>
    <!-- Begin Services -->
    <li class="<?= !isset($menu['services']) ?: 'active open' ?>">
        <?php
        echo $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-concierge-bell']) .
            $this->Html->tag(
                'span',
                __d('admin', 'Services'),
                ['class' => 'nav-link-text']
            ),
            '#',
            ['escape' => false, 'title' => __d('admin', 'services'), 'data-filter-tags' => __d('admin', 'services')]
        );
        ?>
        <ul>
            <?php if ($this->AuthUser->hasAccess(['controller' => 'Services', 'action' => 'index'])): ?>
            <li class="<?= !isset($menu['services']['list']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span', __d('admin', 'List'), ['class' => 'nav-link-text']),
                    ['controller' => 'Services', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('admin', 'List services'), 'data-filter-tags' => __d('admin', 'list services')]
                );
                ?>
            </li>
            <?php endif; ?>

            <?php if ($this->AuthUser->hasAccess(['controller' => 'Faqs', 'action' => 'index'])): ?>
            <!-- Services FAQs -->
            <li class="<?= !isset($menu['services']['faqs']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span', __d('admin', 'FAQs'), ['class' => 'nav-link-text']),
                    ['controller' => 'Faqs', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('admin', 'Services FAQs'), 'data-filter-tags' => __d('admin', 'services faqs')]
                );
                ?>
            </li>
            <?php endif; ?>
        </ul>
    </li>
    <!-- End Services -->
    <?php endif; ?>

    <?php
    if (
        $this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'add']) ||
        $this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'index']) ||
        $this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'documents']) ||
        $this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'images']) ||
        $this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'openGraph'])
    ):
    ?>
    <!-- Begin files -->
    <li class="<?= !isset($menu['files']) ?: 'active open' ?>">
        <?php
        echo $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fa-lg fa-fw fal fa-film']) .
            $this->Html->tag('span',
                __d('admin', 'File Storage'),
                ['class' => 'nav-link-text']
            ),
            '#',
            ['escape' => false, 'title' => __d('admin', 'File Storage'), 'data-filter-tags' => __d('admin', 'file storage')]
        );
        ?>
        <ul>
            <?php if ($this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'add'])): ?>
            <li class="<?= !isset($menu['files']['upload']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span',
                        __d('admin', 'Upload'),
                        ['class' => 'nav-link-text']
                    ),
                    ['controller' => 'Files', 'action' => 'add'],
                    ['escape' => false, 'title' => __d('admin', 'Upload file(s)'), 'data-filter-tags' => __d('admin', 'upload file')]
                );
                ?>
            </li>
            <?php endif; ?>

            <?php if ($this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'index'])): ?>
            <li class="<?= !isset($menu['files']['list']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span',
                        __d('admin', 'List'),
                        ['class' => 'nav-link-text']
                    ),
                    ['controller' => 'Files', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('admin', 'List files'), 'data-filter-tags' => __d('admin', 'list files')]
                );
                ?>
            </li>
            <?php endif; ?>

            <?php
            if (
                $this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'documents']) ||
                $this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'images']) ||
                $this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'openGraph'])
            ):
            ?>
            <li class="<?= !isset($menu['files']['types']) ?: 'active open' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span',
                        __d('admin', 'By type'),
                        ['class' => 'nav-link-text']
                    ),
                    '#',
                    ['escape' => false, 'title' => __d('admin', 'Files by type'), 'data-filter-tags' => __d('admin', 'files by type')]
                );
                ?>
                <ul>
                    <?php if ($this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'documents'])): ?>
                    <li class="<?= !isset($menu['files']['types']['documents']) ?: 'active' ?>">
                        <?php
                        echo $this->Html->link(
                            $this->Html->tag('span',
                                __d('admin', 'Documents'),
                                ['class' => 'nav-link-text']
                            ),
                            ['controller' => 'Files', 'action' => 'documents'],
                            ['escape' => false, 'title' => __d('admin', 'Documents'), 'data-filter-tags' => __d('admin', 'documents')]
                        );
                        ?>
                    </li>
                    <?php endif; ?>

                    <?php if ($this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'images'])): ?>
                    <li class="<?= !isset($menu['files']['types']['images']) ?: 'active' ?>">
                        <?php
                        echo $this->Html->link(
                            $this->Html->tag('span',
                                __d('admin', 'Images'),
                                ['class' => 'nav-link-text']
                            ),
                            ['controller' => 'Files', 'action' => 'images'],
                            ['escape' => false, 'title' => __d('admin', 'Images'), 'data-filter-tags' => __d('admin', 'images')]
                        );
                        ?>
                    </li>
                    <?php endif; ?>

                    <?php if ($this->AuthUser->hasAccess(['controller' => 'Files', 'action' => 'openGraph'])): ?>
                    <li class="<?= !isset($menu['files']['types']['open_graph']) ?: 'active' ?>">
                        <?php
                        echo $this->Html->link(
                            $this->Html->tag('span',
                                __d('admin', 'OpenGraph'),
                                ['class' => 'nav-link-text']
                            ),
                            ['controller' => 'Files', 'action' => 'openGraph'],
                            ['escape' => false, 'title' => __d('admin', 'OpenGraph'), 'data-filter-tags' => __d('admin', 'opengraph')]
                        );
                        ?>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </li>
    <!-- End files -->
    <?php endif; ?>

    <!-- ########################### End publications and files ########################### -->


    <!-- ########################### Begin settings ########################### -->

    <?php
    if (
        $this->AuthUser->hasAccess(['controller' => 'Settings', 'action' => 'add']) ||
        $this->AuthUser->hasAccess(['controller' => 'Settings', 'action' => 'index']) ||
        $this->AuthUser->hasAccess(['controller' => 'Settings', 'action' => 'byKey'])
    ):
    ?>
    <li class="nav-title"><?= __d('admin', 'Settings') ?></li>

    <!-- Begin Settings -->
    <li class="<?= !isset($menu['settings']) ?: 'active open' ?>">
        <?php
        echo $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fa-lg fa-fw fal fa-cog']) .
                $this->Html->tag('span', __d('admin', 'Settings'), ['class' => 'nav-link-text']),
            '#',
            ['escape' => false, 'title' => __d('admin', 'Settings'), 'data-filter-tags' => __d('admin', 'settings')]
        );
        ?>
        <ul>
            <?php if ($this->AuthUser->hasAccess(['controller' => 'Settings', 'action' => 'add'])): ?>
            <li class="<?= !isset($menu['settings']['create']) ?: 'active' ?>">
                <?php
                echo $this->AuthUser->link(
                    $this->Html->tag('span', __d('admin', 'Create'), ['class' => 'nav-link-text']),
                    ['controller' => 'Settings', 'action' => 'add'],
                    ['escape' => false, 'title' => __d('admin', 'Create Setting'), 'data-filter-tags' => __d('admin', 'create setting')]
                );
                ?>
            </li>
            <?php endif; ?>

            <?php if ($this->AuthUser->hasAccess(['controller' => 'Settings', 'action' => 'index'])): ?>
            <li class="<?= !isset($menu['settings']['list']) ?: 'active' ?>">
                <?php
                echo $this->AuthUser->link(
                    $this->Html->tag('span', __d('admin', 'List'), ['class' => 'nav-link-text']),
                    ['controller' => 'Settings', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('admin', 'List Settings'), 'data-filter-tags' => __d('admin', 'list settings')]
                );
                ?>
            </li>
            <?php endif; ?>

            <?php if ($this->AuthUser->hasAccess(['controller' => 'Settings', 'action' => 'byKey'])): ?>
            <li class="<?= !isset($menu['settings']['keys']) ?: 'active open' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span', __d('admin', 'By Key'), ['class' => 'nav-link-text']),
                    '#',
                    ['escape' => false, 'title' => __d('admin', 'Settings by Key'), 'data-filter-tags' => __d('admin', 'settings by key')]
                );
                ?>
                <ul>
                    <?php foreach(Configure::read('Settings') as $key => $setting): ?>
                    <li class="<?= !isset($menu['settings']['keys'][$key]) ?: 'active' ?>">
                        <?php
                        echo $this->Html->link(
                            $this->Html->tag('span', $key, ['class' => 'nav-link-text']),
                            ['controller' => 'Settings', 'action' => 'byKey', 'key' => $key],
                            ['escape' => false, 'title' => $key, 'data-filter-tags' => $key]
                        );
                        ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </li>
    <!-- End Settings -->
    <?php endif; ?>

    <!-- ########################### End settings ########################### -->

</ul>