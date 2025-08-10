<?php
use Cake\Core\Configure;
?>

<ul id="js-nav-menu" class="nav-menu">
    <!-- Dashboard menu -->
    <li class="<?= !isset($menu['dashboard']) ?: 'active' ?>">
        <?php
        echo $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-home']).
            ' '.
            $this->Html->tag('span', __d('panel', 'Dashboard'),
                ['class' => 'nav-link-text']
            ),
            ['controller' => 'SystemicPages', 'action' => 'dashboard'],
            ['escape' => false, 'title' => __d('panel', 'Dashboard'), 'data-filter-tags' => __d('panel', 'dashboard')]
        );
        ?>
    </li>

    <!-- ########################### Begin publications and files ########################### -->

    <li class="nav-title"><?= __d('panel', 'Publications and files') ?></li>

    <!-- Begin pages -->
    <li class="<?= !isset($menu['pages']) ?: 'active open' ?>">
        <?php
        echo $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-file-alt']) .
            $this->Html->tag(
                'span',
                __d('panel', 'Pages'),
                ['class' => 'nav-link-text']
            ),
            '#',
            ['escape' => false, 'title' => __d('panel', 'Pages'), 'data-filter-tags' => __d('panel', 'pages')]
        );
        ?>
        <ul>
            <li class="<?= !isset($menu['pages']['dynamic']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span', __d('panel', 'Dynamic'), ['class' => 'nav-link-text']),
                    ['controller' => 'Pages', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('panel', 'Dynamic pages'), 'data-filter-tags' => __d('panel', 'dynamic pages')]
                );
                ?>
            </li>
            <li class="<?= !isset($menu['pages']['systemic']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span', __d('panel', 'Systemic'), ['class' => 'nav-link-text']),
                    ['controller' => 'SystemicPages', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('panel', 'Systemic pages'), 'data-filter-tags' => __d('panel', 'systemic pages')]
                );
                ?>
            </li>
        </ul>
    </li>
    <!-- End pages -->

    <!-- Begin Posts -->
    <li class="<?= !isset($menu['posts']) ?: 'active open' ?>">
        <?php
        echo $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-newspaper']) .
            $this->Html->tag(
                'span',
                __d('panel', 'Posts'),
                ['class' => 'nav-link-text']
            ),
            '#',
            ['escape' => false, 'title' => __d('panel', 'posts'), 'data-filter-tags' => __d('panel', 'posts')]
        );
        ?>
        <ul>
            <li class="<?= !isset($menu['posts']['list']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span', __d('panel', 'List'), ['class' => 'nav-link-text']),
                    ['controller' => 'Posts', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('panel', 'List posts'), 'data-filter-tags' => __d('panel', 'list posts')]
                );
                ?>
            </li>

            <!-- Post Categories menu -->
            <li class="<?= !isset($menu['posts']['categories']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span', __d('panel', 'Categories'), ['class' => 'nav-link-text']),
                    ['controller' => 'PostCategories', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('panel', 'Post categories'), 'data-filter-tags' => __d('panel', 'post categories')]
                );
                ?>
            </li>
        </ul>
    </li>
    <!-- End Posts -->

    <!-- Begin Services -->
    <li class="<?= !isset($menu['services']) ?: 'active open' ?>">
        <?php
        echo $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-concierge-bell']) .
            $this->Html->tag(
                'span',
                __d('panel', 'Services'),
                ['class' => 'nav-link-text']
            ),
            '#',
            ['escape' => false, 'title' => __d('panel', 'services'), 'data-filter-tags' => __d('panel', 'services')]
        );
        ?>
        <ul>
            <li class="<?= !isset($menu['services']['list']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span', __d('panel', 'List'), ['class' => 'nav-link-text']),
                    ['controller' => 'Services', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('panel', 'List services'), 'data-filter-tags' => __d('panel', 'list services')]
                );
                ?>
            </li>

            <!-- Services FAQs -->
            <li class="<?= !isset($menu['services']['faqs']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span', __d('panel', 'FAQs'), ['class' => 'nav-link-text']),
                    ['controller' => 'Faqs', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('panel', 'Services FAQs'), 'data-filter-tags' => __d('panel', 'services faqs')]
                );
                ?>
            </li>
        </ul>
    </li>
    <!-- End Services -->

    <!-- Begin files -->
    <li class="<?= !isset($menu['files']) ?: 'active open' ?>">
        <?php
        echo $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fa-lg fa-fw fal fa-film']) .
            $this->Html->tag('span',
                __d('panel', 'File Storage'),
                ['class' => 'nav-link-text']
            ),
            '#',
            ['escape' => false, 'title' => __d('panel', 'File Storage'), 'data-filter-tags' => __d('panel', 'file storage')]
        );
        ?>
        <ul>
            <li class="<?= !isset($menu['files']['upload']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span',
                        __d('panel', 'Upload'),
                        ['class' => 'nav-link-text']
                    ),
                    ['controller' => 'Files', 'action' => 'add'],
                    ['escape' => false, 'title' => __d('panel', 'Upload file(s)'), 'data-filter-tags' => __d('panel', 'upload file')]
                );
                ?>
            </li>
            <li class="<?= !isset($menu['files']['list']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span',
                        __d('panel', 'List'),
                        ['class' => 'nav-link-text']
                    ),
                    ['controller' => 'Files', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('panel', 'List files'), 'data-filter-tags' => __d('panel', 'list files')]
                );
                ?>
            </li>
            <li class="<?= !isset($menu['files']['types']) ?: 'active open' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span',
                        __d('panel', 'By type'),
                        ['class' => 'nav-link-text']
                    ),
                    '#',
                    ['escape' => false, 'title' => __d('panel', 'Files by type'), 'data-filter-tags' => __d('panel', 'files by type')]
                );
                ?>
                <ul>
                    <li class="<?= !isset($menu['files']['types']['documents']) ?: 'active' ?>">
                        <?php
                        echo $this->Html->link(
                            $this->Html->tag('span',
                                __d('panel', 'Documents'),
                                ['class' => 'nav-link-text']
                            ),
                            ['controller' => 'Files', 'action' => 'documents'],
                            ['escape' => false, 'title' => __d('panel', 'Documents'), 'data-filter-tags' => __d('panel', 'documents')]
                        );
                        ?>
                    </li>
                    <li class="<?= !isset($menu['files']['types']['images']) ?: 'active' ?>">
                        <?php
                        echo $this->Html->link(
                            $this->Html->tag('span',
                                __d('panel', 'Images'),
                                ['class' => 'nav-link-text']
                            ),
                            ['controller' => 'Files', 'action' => 'images'],
                            ['escape' => false, 'title' => __d('panel', 'Images'), 'data-filter-tags' => __d('panel', 'images')]
                        );
                        ?>
                    </li>
                    <li class="<?= !isset($menu['files']['types']['videos']) ?: 'active' ?>">
                        <?php
                        echo $this->Html->link(
                            $this->Html->tag('span',
                                __d('panel', 'Videos'),
                                ['class' => 'nav-link-text']
                            ),
                            ['controller' => 'Files', 'action' => 'videos'],
                            ['escape' => false, 'title' => __d('panel', 'Videos'), 'data-filter-tags' => __d('panel', 'videos')]
                        );
                        ?>
                    </li>
                    <li class="<?= !isset($menu['files']['types']['open_graph']) ?: 'active' ?>">
                        <?php
                        echo $this->Html->link(
                            $this->Html->tag('span',
                                __d('panel', 'OpenGraph'),
                                ['class' => 'nav-link-text']
                            ),
                            ['controller' => 'Files', 'action' => 'openGraph'],
                            ['escape' => false, 'title' => __d('panel', 'OpenGraph'), 'data-filter-tags' => __d('panel', 'opengraph')]
                        );
                        ?>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <!-- End files -->

    <!-- ########################### End publications and files ########################### -->


    <!-- ########################### Begin settings ########################### -->

    <li class="nav-title"><?= __d('panel', 'Settings') ?></li>

    <!-- Begin Settings -->
    <li class="<?= !isset($menu['settings']) ?: 'active open' ?>">
        <?php
        echo $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fa-lg fa-fw fal fa-cog']) .
                $this->Html->tag('span', __d('panel', 'Settings'), ['class' => 'nav-link-text']),
            '#',
            ['escape' => false, 'title' => __d('panel', 'Settings'), 'data-filter-tags' => __d('panel', 'settings')]
        );
        ?>
        <ul>
            <li class="<?= !isset($menu['settings']['create']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span', __d('panel', 'Create'), ['class' => 'nav-link-text']),
                    ['controller' => 'Settings', 'action' => 'add'],
                    ['escape' => false, 'title' => __d('panel', 'Create Setting'), 'data-filter-tags' => __d('panel', 'create setting')]
                );
                ?>
            </li>
            <li class="<?= !isset($menu['settings']['list']) ?: 'active' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span', __d('panel', 'List'), ['class' => 'nav-link-text']),
                    ['controller' => 'Settings', 'action' => 'index'],
                    ['escape' => false, 'title' => __d('panel', 'List Settings'), 'data-filter-tags' => __d('panel', 'list settings')]
                );
                ?>
            </li>
            <li class="<?= !isset($menu['settings']['keys']) ?: 'active open' ?>">
                <?php
                echo $this->Html->link(
                    $this->Html->tag('span', __d('panel', 'By Key'), ['class' => 'nav-link-text']),
                    '#',
                    ['escape' => false, 'title' => __d('panel', 'Settings by Key'), 'data-filter-tags' => __d('panel', 'settings by key')]
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
        </ul>
    </li>
    <!-- End Settings -->

    <!-- ########################### End settings ########################### -->

</ul>