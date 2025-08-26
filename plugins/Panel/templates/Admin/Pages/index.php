<?php
$this->assign('title', __d('admin', 'Dynamic Pages'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('admin', 'Pages')],
    ['title' => __d('admin', 'Dynamic Pages')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['pages']['dynamic'] = true;
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
        <i class="subheader-icon fal fa-file-alt"></i> <?= __d('admin', 'Dynamic Pages') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('admin', 'Dynamic Pages') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?= $this->AuthUser->link(__d('admin', 'Create new'), ['controller' => 'Pages', 'action' => 'add'], ['class' => 'btn btn-xs btn-success']) ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="min-desktop"><?= __d('admin', 'Parent') ?></th>
                                <th class="all"><?= __d('admin', 'Title') ?></th>
                                <th class="min-desktop text-center"><?= $this->Html->image('flag/ru.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop text-center"><?= $this->Html->image('flag/en.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop text-center"><?= $this->Html->image('flag/uz.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop"><?= __d('admin', 'Date Published') ?></th>
                                <th class="min-phone text-center"><?= __d('admin', 'Mode') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pages as $page): ?>
                            <tr>
                                <td class="align-middle">
                                    <?php
                                    if (null !== $page->parent_page) {
                                        echo h($page->parent_page->title);
                                        echo $this->Html->tag('code', h($page->parent_page->slug), ['class' => 'd-block']);
                                    } else {
                                        echo $this->Html->tag('span', __d('admin', 'Root'), ['class' => 'color-danger-600 fs-xl font-italic']);
                                    }
                                    ?>
                                </td>
                                <td class="align-middle">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-external-link-alt']),
                                        ['controller' => 'Pages', 'action' => 'view', 'slug' => h($page->slug), 'prefix' => false],
                                        ['escape' => false, 'target' => '_blank']
                                    );
                                    ?>
                                    <span class="h4 ml-2">
                                        <?= isset($page->title) ? h($page->title) : $this->Panel->notSet('title') ?>
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    echo $this->AuthUser->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                        ['controller' => 'Pages', 'action' => 'edit', h($page->id)],
                                        ['escape' => false]
                                    );
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    $color = 'success';
                                    $title = $this->Html->tag('i', '', ['class' => 'fal fa-plus']);
                                    if (array_key_exists('en', $page->_translations)) {
                                        $color = 'info';
                                        $title = $this->Html->tag('i', '', ['class' => 'fal fa-pencil']);
                                    }
                                    echo $this->AuthUser->link($title,
                                        ['controller' => 'Pages', 'action' => 'translate', h($page->id), 'en'],
                                        ['escape' => false, 'class' => 'text-' . $color]
                                    );
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    $color = 'success';
                                    $title = $this->Html->tag('i', '', ['class' => 'fal fa-plus']);
                                    if (array_key_exists('uz', $page->_translations)) {
                                        $color = 'info';
                                        $title = $this->Html->tag('i', '', ['class' => 'fal fa-pencil']);
                                    }
                                    echo $this->AuthUser->link($title,
                                        ['controller' => 'Pages', 'action' => 'translate', h($page->id), 'uz'],
                                        ['escape' => false, 'class' => 'text-' . $color]
                                    );
                                    ?>
                                </td>
                                <td class="align-middle" data-order="<?= !isset($page->published) ? : $page->published->getTimestamp() ?>">
                                    <?php
                                    if (isset($page->published)) {
                                        echo $this->Time->i18nFormat($page->published, 'd MMMM Y H:mm:ss');
                                    } else {
                                        echo $this->Panel->notSet('');
                                    }
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    if ($this->AuthUser->hasAccess(['controller' => $page->getSource(), 'action' => 'setPublished', h($page->id)])) {
                                        echo $this->Published->publishLink($page);
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
