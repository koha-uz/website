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

        <!-- Begin Ads -->
        <li class="<?php if (isset($menu['ads'])) echo 'active open'; ?>">
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-newspaper']) .
                $this->Html->tag(
                    'span',
                    __d('panel', 'Ads'),
                    ['class' => 'nav-link-text']
                ),
                '#',
                ['escape' => false, 'title' => __d('panel', 'ads'), 'data-filter-tags' => __d('panel', 'ads')]
            );
            ?>
            <ul>
                <li <?php if (isset($menu['ads'][0])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-plus-circle']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Create'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Ads', 'action' => 'add'],
                        ['escape' => false, 'title' => __d('panel', 'Create ad'), 'data-filter-tags' => __d('panel', 'create ad')]
                    );
                    ?>
                </li>
                <li <?php if (isset($menu['ads'][1])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-table']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'List'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Ads', 'action' => 'index'],
                        ['escape' => false, 'title' => __d('panel', 'List ads'), 'data-filter-tags' => __d('panel', 'list ads')]
                    );
                    ?>
                </li>

                <!-- Ad Categories menu -->
                <li class="<?php if (isset($menu['ads']['categories'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-archive']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Categories'),
                            ['class' => 'nav-link-text']
                        ),
                        '#',
                        ['escape' => false, 'title' => __d('panel', 'Ad categories'), 'data-filter-tags' => __d('panel', 'ad categories')]
                    );
                    ?>
                    <ul>
                        <li <?php if (isset($menu['ads']['categories'][0])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-plus-circle']) .
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Create'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'AdCategories', 'action' => 'add'],
                                ['escape' => false, 'title' => __d('panel', 'Create ad category'), 'data-filter-tags' => __d('panel', 'create ad category')]
                            );
                            ?>
                        </li>
                        <li <?php if (isset($menu['ads']['categories'][1])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-table']) .
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'List'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'AdCategories', 'action' => 'index'],
                                ['escape' => false, 'title' => __d('panel', 'List ad categories'), 'data-filter-tags' => __d('panel', 'list ad categories')]
                            );
                            ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <!-- End Ads -->


        <!-- Begin FAQs -->
        <li class="<?php if (isset($menu['faqs'])) echo 'active open'; ?>">
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-align-left']) .
                $this->Html->tag(
                    'span',
                    __d('panel', 'FAQs'),
                    ['class' => 'nav-link-text']
                ),
                '#',
                ['escape' => false, 'title' => __d('panel', 'faqs'), 'data-filter-tags' => __d('panel', 'faqs')]
            );
            ?>
            <ul>
                <li <?php if (isset($menu['faqs'][0])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-plus-circle']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Create'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Faqs', 'action' => 'add'],
                        ['escape' => false, 'title' => __d('panel', 'Create faq'), 'data-filter-tags' => __d('panel', 'create faq')]
                    );
                    ?>
                </li>
                <li <?php if (isset($menu['faqs'][1])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-table']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'List'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Faqs', 'action' => 'index'],
                        ['escape' => false, 'title' => __d('panel', 'List faqs'), 'data-filter-tags' => __d('panel', 'list faqs')]
                    );
                    ?>
                </li>

                <!-- Post Categories menu -->
                <li class="<?php if (isset($menu['faqs']['categories'])) echo 'active open'; ?>">
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-archive']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Categories'),
                            ['class' => 'nav-link-text']
                        ),
                        '#',
                        ['escape' => false, 'title' => __d('panel', 'Faq categories'), 'data-filter-tags' => __d('panel', 'faq categories')]
                    );
                    ?>
                    <ul>
                        <li <?php if (isset($menu['faqs']['categories'][0])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-plus-circle']) .
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'Create'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'FaqCategories', 'action' => 'add'],
                                ['escape' => false, 'title' => __d('panel', 'Create faq category'), 'data-filter-tags' => __d('panel', 'create faq category')]
                            );
                            ?>
                        </li>
                        <li <?php if (isset($menu['faqs']['categories'][1])) echo 'class="active"'; ?>>
                            <?php
                            echo $this->Html->link(
                                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-table']) .
                                $this->Html->tag(
                                    'span',
                                    __d('panel', 'List'),
                                    ['class' => 'nav-link-text']
                                ),
                                ['controller' => 'FaqCategories', 'action' => 'index'],
                                ['escape' => false, 'title' => __d('panel', 'List faq categories'), 'data-filter-tags' => __d('panel', 'list faq categories')]
                            );
                            ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <!-- End FAQs -->

        <!-- Begin docs -->
        <li class="<?php if (isset($menu['docs'])) echo 'active open'; ?>">
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-file-pdf']) .
                $this->Html->tag(
                    'span',
                    __d('panel', 'Documents'),
                    ['class' => 'nav-link-text']
                ),
                '#',
                ['escape' => false, 'title' => __d('panel', 'documents'), 'data-filter-tags' => __d('panel', 'documents')]
            );
            ?>
            <ul>
                <li <?php if (isset($menu['docs'][0])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-plus-circle']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'Create'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Docs', 'action' => 'add'],
                        ['escape' => false, 'title' => __d('panel', 'Create document'), 'data-filter-tags' => __d('panel', 'create document')]
                    );
                    ?>
                </li>
                <li <?php if (isset($menu['docs'][1])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-table']) .
                        $this->Html->tag(
                            'span',
                            __d('panel', 'List'),
                            ['class' => 'nav-link-text']
                        ),
                        ['controller' => 'Docs', 'action' => 'index'],
                        ['escape' => false, 'title' => __d('panel', 'List documents'), 'data-filter-tags' => __d('panel', 'list documents')]
                    );
                    ?>
                </li>
            </ul>
        </li>
        <!-- End docs -->

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


        <!-- ########################### Begin tools ########################### -->

        <li class="nav-title"><?= __d('panel', 'Tools') ?></li>

        <!-- Begin Questions -->
        <li class="<?php if (isset($menu['questions'])) echo 'active open'; ?>">
            <?php
            echo $this->Html->link(
                $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-question']).
                ' '.
                $this->Html->tag('span', __d('panel', 'Questions'),
                    ['class' => 'nav-link-text']
                ),
                ['controller' => 'Questions', 'action' => 'index'],
                ['escape' => false, 'title' => __d('panel', 'Questions'), 'data-filter-tags' => __d('panel', 'questions')]
            );
            ?>
        </li>
        <!-- End Questions -->

        <!-- ########################### End tools ########################### -->

        <!-- ########################### Begin settings ########################### -->

        <li class="nav-title"><?= __d('panel', 'Settings') ?></li>

        <!-- Begin i18n messages -->
        <?= $this->cell('Founder/I18nMessages::domainListMenu', ['menu' => $menu]) ?>
        <!-- End i18n messages -->


        <!-- ########################### End settings ########################### -->

    </ul>
