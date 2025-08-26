<?php
$this->assign('title', __d('admin', 'Posts'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('admin', 'Posts')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['posts']['list'] = true;
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
            targets: [2, 3, 4, 7],
            orderable: false
        }],
        order: [[6, 'desc']]
    });
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-newspaper"></i> <?= __d('admin', 'Posts') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('admin', 'Posts') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?php
                    echo $this->AuthUser->link(
                        __d('admin', 'Create new'),
                        ['controller' => 'Posts', 'action' => 'add'],
                        ['class' => 'btn btn-xs btn-success']
                    ); ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all align-middle" style="width: 50%"><?= __d('admin', 'Title') ?></th>
                                <th class="min-desktop align-middle"><?= __d('admin', 'Category') ?></th>
                                <th class="min-desktop text-center align-middle"><?= $this->Html->image('flag/ru.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop text-center align-middle"><?= $this->Html->image('flag/en.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop text-center align-middle"><?= $this->Html->image('flag/uz.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop align-middle"><?= __d('admin', 'Date Created') ?></th>
                                <th class="min-desktop align-middle"><?= __d('admin', 'Date Published') ?></th>
                                <th class="min-tablet text-center align-middle"><?= __d('admin', 'Mode') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($posts as $post): ?>
                            <tr>
                                <td class="align-middle">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-external-link-alt']),
                                        ['controller' => 'Posts', 'action' => 'view', 'slug' => h($post->slug), 'prefix' => false],
                                        ['escape' => false, 'target' => '_blank']
                                    );
                                    ?>
                                    <span class="h4 ml-2">
                                        <?= isset($post->title) ? h($post->title) : $this->Panel->notSet('title') ?>
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <?php
                                    if ($this->AuthUser->hasAccess(['controller' => 'PostCategories', 'action' => 'edit', $post->post_category->id])) {
                                        echo $this->Html->link(
                                            $post->post_category->title,
                                            ['controller' => 'PostCategories', 'action' => 'edit', $post->post_category->id]
                                        );
                                        echo ' ' . $this->Panel->boolIcon($post->post_category->is_published);
                                    }
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    echo $this->AuthUser->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                        ['controller' => 'Posts', 'action' => 'edit', h($post->id)],
                                        ['escape' => false]
                                    );
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    $color = 'success';
                                    $title = $this->Html->tag('i', '', ['class' => 'fal fa-plus']);
                                    if (array_key_exists('en', $post->_translations)) {
                                        $color = 'info';
                                        $title = $this->Html->tag('i', '', ['class' => 'fal fa-pencil']);
                                    }
                                    echo $this->AuthUser->link($title,
                                        ['controller' => 'Posts', 'action' => 'translate', h($post->id), 'en'],
                                        ['escape' => false, 'class' => 'text-' . $color]
                                    );
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    $color = 'success';
                                    $title = $this->Html->tag('i', '', ['class' => 'fal fa-plus']);
                                    if (array_key_exists('uz', $post->_translations)) {
                                        $color = 'info';
                                        $title = $this->Html->tag('i', '', ['class' => 'fal fa-pencil']);
                                    }
                                    echo $this->AuthUser->link($title,
                                        ['controller' => 'Posts', 'action' => 'translate', h($post->id), 'uz'],
                                        ['escape' => false, 'class' => 'text-' . $color]
                                    );
                                    ?>
                                </td>
                                <td class="align-middle" data-order="<?= !isset($post->created) ? : $post->created->getTimestamp() ?>">
                                    <?= isset($post->created) ? $post->created->format('d.m.Y H:i:s') : $this->Panel->notSet('') ?>
                                </td>
                                <td class="align-middle" data-order="<?= !isset($post->published) ? : $post->published->getTimestamp() ?>">
                                    <?= isset($post->published) ? $post->published->format('d.m.Y H:i') : $this->Panel->notSet('') ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    if ($this->AuthUser->hasAccess(['controller' => $post->getSource(), 'action' => 'setPublished', h($post->id)])) {
                                        echo $this->Published->publishLink($post);
                                    }
                                    ?>
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
