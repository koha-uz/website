<?php
use Cake\Core\Configure;
?>

    <ul id="js-nav-menu" class="nav-menu">
        <!-- Dashboard menu -->
        <li class="<?php if (isset($menu['dashboard'])) echo 'active open'; ?>">
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-home']).
                ' '.
                $this->Html->tag('span', __d('panel', 'Dashboard'),
                    ['class' => 'nav-link-text']
                ),
                ['prefix' => 'Founder', 'controller' => 'SystemicPages', 'action' => 'dashboard'],
                ['escape' => false, 'title' => __d('panel', 'Dashboard'), 'data-filter-tags' => __d('panel', 'dashboard')]
            );
            ?>
        </li>

        <!-- ########################### Begin publications and files ########################### -->

        <li class="nav-title"><?= __d('panel', 'Publications and files') ?></li>

        <!-- Begin pages -->
        <li class="<?php if (isset($menu['pages'])) echo 'active open'; ?>">
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
                <li class="<?php if (isset($menu['pages']['dynamic'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-paper-plane']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Dynamic'),
                            ['class' => 'nav-link-text']
                        ),
                        '#',
                        ['escape' => false, 'title' => __d('panel', 'Dynamic pages'), 'data-filter-tags' => __d('panel', 'dynamic pages')]
                    );
                    ?>
                    <ul>
                        <li <?php if (isset($menu['pages']['dynamic'][0])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-plus-circle']) .
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Create'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'Pages', 'action' => 'add'],
                                ['escape' => false, 'title' => __d('panel', 'Create dynamic page'), 'data-filter-tags' => __d('panel', 'create dynamic page')]
                            );
                            ?>
                        </li>
                        <li <?php if (isset($menu['pages']['dynamic'][1])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-table']) .
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'List'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'Pages', 'action' => 'index'],
                                ['escape' => false, 'title' => __d('panel', 'List dynamic pages'), 'data-filter-tags' => __d('panel', 'list dynamic pages')]
                            );
                            ?>
                        </li>
                    </ul>
                </li>
                <li class="<?php if (isset($menu['pages']['systemic'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-paperclip']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Systemic'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'SystemicPages', 'action' => 'index'],
                        ['escape' => false, 'title' => __d('panel', 'Systemic pages'), 'data-filter-tags' => __d('panel', 'systemic pages')]
                    );
                    ?>
                </li>
            </ul>
        </li>
        <!-- End pages -->

        <!-- Begin Posts -->
        <li class="<?php if (isset($menu['posts'])) echo 'active open'; ?>">
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
                <li <?php if (isset($menu['posts'][0])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-plus-circle']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Create'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Posts', 'action' => 'add'],
                        ['escape' => false, 'title' => __d('panel', 'Create post'), 'data-filter-tags' => __d('panel', 'create post')]
                    );
                    ?>
                </li>
                <li <?php if (isset($menu['posts'][1])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-table']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'List'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Posts', 'action' => 'index'],
                        ['escape' => false, 'title' => __d('panel', 'List posts'), 'data-filter-tags' => __d('panel', 'list posts')]
                    );
                    ?>
                </li>

                <!-- Posr Categories menu -->
                <li class="<?php if (isset($menu['posts']['categories'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-archive']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Categories'),
                            ['class' => 'nav-link-text']
                        ),
                        '#',
                        ['escape' => false, 'title' => __d('panel', 'Post categories'), 'data-filter-tags' => __d('panel', 'post categories')]
                    );
                    ?>
                    <ul>
                        <li <?php if (isset($menu['posts']['categories'][0])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-plus-circle']) .
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Create'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'PostCategories', 'action' => 'add'],
                                ['escape' => false, 'title' => __d('panel', 'Create post category'), 'data-filter-tags' => __d('panel', 'create post category')]
                            );
                            ?>
                        </li>
                        <li <?php if (isset($menu['posts']['categories'][1])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-table']) .
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'List'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'PostCategories', 'action' => 'index'],
                                ['escape' => false, 'title' => __d('panel', 'List post categories'), 'data-filter-tags' => __d('panel', 'list post categories')]
                            );
                            ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <!-- End Posts -->

        <!-- Begin services -->
        <li class="<?php if (isset($menu['services'])) echo 'active open'; ?>">
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fa-lg fa-fw far fa-concierge-bell']) .
                $this->Html->tag(
                    'span',
                    __d('panel', 'Services'),
                    ['class' => 'nav-link-text']
                ),
                '#',
                ['escape' => false, 'title' => __d('panel', 'Services'), 'data-filter-tags' => __d('panel', 'services')]
            );
            ?>
            <ul>
                <li <?php if (isset($menu['services'][0])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-plus-circle']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Create'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Services', 'action' => 'add'],
                        ['escape' => false, 'title' => __d('panel', 'Create service'), 'data-filter-tags' => __d('panel', 'create service')]
                    );
                    ?>
                </li>
                <li <?php if (isset($menu['services'][1])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-table']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'List'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Services', 'action' => 'index'],
                        ['escape' => false, 'title' => __d('panel', 'List services'), 'data-filter-tags' => __d('panel', 'list services')]
                    );
                    ?>
                </li>
            </ul>
        </li>
        <!-- End services -->

        <!-- Begin files -->
        <li class="<?php if (isset($menu['files'])) echo 'active open'; ?>">
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-file']) .
                $this->Html->tag(
                    'span',
                    __d('panel', 'Files'),
                    ['class' => 'nav-link-text']
                ),
                '#',
                ['escape' => false, 'title' => __d('panel', 'Files'), 'data-filter-tags' => __d('panel', 'files')]
            );
            ?>
            <ul>
                <li <?php if (isset($menu['files'][0])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-plus-circle']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Create'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Files', 'action' => 'add'],
                        ['escape' => false, 'title' => __d('panel', 'Create file(s)'), 'data-filter-tags' => __d('panel', 'create file')]
                    );
                    ?>
                </li>
                <li <?php if (isset($menu['files'][1])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-table']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'List'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Files', 'action' => 'index'],
                        ['escape' => false, 'title' => __d('panel', 'List files'), 'data-filter-tags' => __d('panel', 'list files')]
                    );
                    ?>
                </li>
                <li class="<?php if (isset($menu['files']['types'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-file-word']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'By type'),
                            ['class' => 'nav-link-text']
                        ),
                        '#',
                        ['escape' => false, 'title' => __d('panel', 'Files by type'), 'data-filter-tags' => __d('panel', 'files by type')]
                    );
                    ?>
                    <ul>
                        <li <?php if (isset($menu['files']['types'][0])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Documents'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'Files', 'action' => 'documents'],
                                ['escape' => false, 'title' => __d('panel', 'Documents'), 'data-filter-tags' => __d('panel', 'documents')]
                            );
                            ?>
                        </li>
                        <li <?php if (isset($menu['files']['types'][1])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Images'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'Files', 'action' => 'images'],
                                ['escape' => false, 'title' => __d('panel', 'Images'), 'data-filter-tags' => __d('panel', 'images')]
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

        <!-- Begin settings -->
        <li class="<?php if (isset($menu['settings'])) echo 'active open'; ?>">
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fa-lg fa-fw fal fa-cog']) .
                $this->Html->tag(
                    'span',
                    __d('panel', 'Settings'),
                    ['class' => 'nav-link-text']
                ),
                '#',
                ['escape' => false, 'title' => __d('panel', 'Settings'), 'data-filter-tags' => __d('panel', 'settings')]
            );
            ?>
            <ul>
                <li <?php if (isset($menu['settings'][0])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-plus-circle']) .
                        $this->Html->tag(
                            'span',
                            __('Create'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Settings', 'action' => 'add'],
                        ['escape' => false, 'title' => __d('panel', 'Create setting'), 'data-filter-tags' => __d('panel', 'create setting')]
                    );
                    ?>
                </li>

                <?php foreach(Configure::read('Settings') as $key => $setting): ?>
                <li <?php if (isset($menu['settings'][$key])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('span', $key, ['class' => 'nav-link-text']),
                        ['_name' => 'settings', 'key' => $key],
                        ['escape' => false, 'title' => $key, 'data-filter-tags' => $key]
                    );
                    ?>
                </li>
                <?php endforeach; ?>
            </ul>

        <!-- End settings -->

        <!-- Begin i18n messages -->
        <?= $this->cell('Founder/I18nMessages::domainListMenu', ['menu' => $menu]) ?>
        <!-- End i18n messages -->


        <!-- ########################### End settings ########################### -->

    </ul>
