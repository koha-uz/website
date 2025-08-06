<?php
$this->assign('title', __d('panel', 'Post Categories'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Posts'), 'url' => ['controller' => 'Posts', 'action' => 'index']],
    ['title' => __d('panel', 'Post categories')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['posts']['categories'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css('datagrid/datatables/datatables.bundle', ['block' => true]);
echo $this->Html->script('datagrid/datatables/datatables.bundle', ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.datatable').dataTable({
        pageLength: 25,
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [2, 3, 4, 6],
            orderable: false
        }],
        order: [[5, 'desc']]
    });
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-table"></i> <?= __d('panel', 'Post Categories') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Post Categories') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?= $this->Html->link(__d('panel', 'Create new'), ['controller' => 'PostCategories', 'action' => 'add'], ['class' => 'btn btn-xs btn-success']) ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="min-desktop"><?= __d('panel', 'Parent') ?></th>
                                <th class="all"><?= __d('panel', 'Title') ?></th>
                                <th class="min-desktop text-center"><?= $this->Html->image('flag/ru.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop text-center"><?= $this->Html->image('flag/en.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop text-center"><?= $this->Html->image('flag/uz.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Date Published') ?></th>
                                <th class="min-phone text-center"><?= __d('panel', 'Mode') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($postCategories as $postCategory): ?>
                            <tr>
                                <td class="align-middle">
                                    <?php
                                    if (null !== $postCategory->parent_post_category) {
                                        echo h($postCategory->parent_post_category->title);
                                        echo $this->Html->tag('code', h($postCategory->parent_post_category->slug), ['class' => 'd-block']);
                                    } else {
                                        echo $this->Html->tag('span', __d('panel', 'Root'), ['class' => 'color-danger-600 fs-xl font-italic']);
                                    }
                                    ?>
                                </td>
                                <td class="align-middle">
                                    <div class="h4">
                                        <?php
                                        if (isset($postCategory->title)) {
                                            echo h($postCategory->title);
                                        } else {
                                            echo $this->Panel->notSet('');
                                        }
                                        ?>
                                    </div>

                                    <?php if (isset($postCategory->slug) && isset($postCategory->is_published) && $postCategory->is_published): ?>
                                    <code class="d-block">
                                        <?php
                                        echo $this->Html->link(
                                            $this->Url->build(
                                                ['_name' => 'post_category_view', 'slug' => h($postCategory->slug)],
                                                ['fullBase' => true]
                                            ),
                                            ['_name' => 'post_category_view', 'slug' => h($postCategory->slug)],
                                            ['escape' => false, 'target' => '_blank']
                                        );
                                        ?>
                                    </code>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                        ['controller' => 'PostCategories', 'action' => 'edit', h($postCategory->id)],
                                        ['escape' => false]
                                    );
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    $color = 'success';
                                    $title = $this->Html->tag('i', '', ['class' => 'fal fa-plus']);
                                    if (array_key_exists('en', $postCategory->_translations)) {
                                        $color = 'info';
                                        $title = $this->Html->tag('i', '', ['class' => 'fal fa-pencil']);
                                    }
                                    echo $this->Html->link($title,
                                        ['controller' => 'PostCategories', 'action' => 'translate', h($postCategory->id), 'en'],
                                        ['escape' => false, 'class' => 'text-' . $color]
                                    );
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    $color = 'success';
                                    $title = $this->Html->tag('i', '', ['class' => 'fal fa-plus']);
                                    if (array_key_exists('uz', $postCategory->_translations)) {
                                        $color = 'info';
                                        $title = $this->Html->tag('i', '', ['class' => 'fal fa-pencil']);
                                    }
                                    echo $this->Html->link($title,
                                        ['controller' => 'PostCategories', 'action' => 'translate', h($postCategory->id), 'uz'],
                                        ['escape' => false, 'class' => 'text-' . $color]
                                    );
                                    ?>
                                </td>
                                <td class="align-middle" data-order="<?= !isset($postCategory->published) ? : $postCategory->published->getTimestamp() ?>">
                                    <?php
                                    if (isset($postCategory->published)) {
                                        echo $this->Time->i18nFormat($postCategory->published, 'd MMMM Y H:mm:ss');
                                    } else {
                                        echo $this->Panel->notSet('');
                                    }
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?= $this->Published->publishLink($postCategory) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
