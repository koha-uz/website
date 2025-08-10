<?php
$this->assign('title', __d('panel', 'Services'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Services')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['services']['list'] = true;
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
        <i class="subheader-icon fal fa-concierge-bell"></i> <?= __d('panel', 'Services') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Services') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?= $this->Html->link(__d('panel', 'Create new'), ['controller' => 'Services', 'action' => 'add'], ['class' => 'btn btn-xs btn-success']) ?>
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
                                <th class="min-desktop align-middle"><?= __d('panel', 'Date Created') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Date Published') ?></th>
                                <th class="min-phone text-center"><?= __d('panel', 'Mode') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($services as $service): ?>
                            <tr>
                                <td class="align-middle">
                                    <?php
                                    if (null !== $service->parent_page) {
                                        echo h($service->parent_page->title);
                                        echo $this->Html->tag('code', h($service->parent_page->slug), ['class' => 'd-block']);
                                    } else {
                                        echo $this->Html->tag('span', __d('panel', 'Root'), ['class' => 'color-danger-600 fs-xl font-italic']);
                                    }
                                    ?>
                                </td>
                                <td class="align-middle">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-external-link-alt']),
                                        [
                                            'controller' => 'Services',
                                            'action' => 'view',
                                            'slug' => h($service->slug),
                                            'lang' => 'ru',
                                            'prefix' => false
                                        ],
                                        ['escape' => false, 'target' => '_blank']
                                    );
                                    ?>
                                    <span class="h4 ml-2">
                                        <?= isset($service->title) ? h($service->title) : $this->Panel->notSet('') ?>
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                        ['controller' => 'Services', 'action' => 'edit', h($service->id)],
                                        ['escape' => false]
                                    );
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    $color = 'success';
                                    $title = $this->Html->tag('i', '', ['class' => 'fal fa-plus']);
                                    if (array_key_exists('en', $service->_translations)) {
                                        $color = 'info';
                                        $title = $this->Html->tag('i', '', ['class' => 'fal fa-pencil']);
                                    }
                                    echo $this->Html->link($title,
                                        ['controller' => 'Services', 'action' => 'translate', h($service->id), 'en'],
                                        ['escape' => false, 'class' => 'text-' . $color]
                                    );
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    $color = 'success';
                                    $title = $this->Html->tag('i', '', ['class' => 'fal fa-plus']);
                                    if (array_key_exists('uz', $service->_translations)) {
                                        $color = 'info';
                                        $title = $this->Html->tag('i', '', ['class' => 'fal fa-pencil']);
                                    }
                                    echo $this->Html->link($title,
                                        ['controller' => 'Services', 'action' => 'translate', h($service->id), 'uz'],
                                        ['escape' => false, 'class' => 'text-' . $color]
                                    );
                                    ?>
                                </td>
                                <td class="align-middle" data-order="<?= !isset($service->created) ? : $service->created->getTimestamp() ?>">
                                    <?= isset($service->created) ? $service->created->format('d.m.Y H:i:s') : $this->Panel->notSet('') ?>
                                </td>
                                <td class="align-middle" data-order="<?= !isset($service->published) ? : $service->published->getTimestamp() ?>">
                                    <?php
                                    if (isset($service->published)) {
                                        echo $this->Time->i18nFormat($service->published, 'd MMMM Y H:mm:ss');
                                    } else {
                                        echo $this->Panel->notSet('');
                                    }
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?= $this->Published->publishLink($service) ?>
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
