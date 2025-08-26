<?php
$this->assign('title', __d('admin', 'Systemic Pages'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('admin', 'Pages')],
    ['title' => __d('admin', 'Systemic Pages')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['pages']['systemic'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css('datagrid/datatables/datatables.bundle', ['block' => true]);
echo $this->Html->script('datagrid/datatables/datatables.bundle', ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.datatable').dataTable({
        serviceLength: 25,
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [2, 3, 4],
            orderable: false
        }],
        order: false
    });
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-file-alt"></i> <?= __d('admin', 'Systemic Pages') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('admin', 'Systemic Pages') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?php
                    echo $this->AuthUser->link(
                        __d('admin', 'Create new'),
                        ['controller' => 'SystemicPages', 'action' => 'add'],
                        ['class' => 'btn btn-xs btn-success']
                    );
                    ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="min-desktop align-middle"><?= __d('admin', 'Notation') ?></th>
                                <th class="all align-middle"><?= __d('admin', 'Short name') ?></th>
                                <th class="min-desktop text-center align-middle"><?= $this->Html->image('flag/ru.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop text-center align-middle"><?= $this->Html->image('flag/en.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop text-center align-middle"><?= $this->Html->image('flag/uz.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop align-middle" style="width: 18%"><?= __d('admin', 'Date modified') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($systemicPages as $page): ?>
                            <tr>
                                <td class="align-middle"><?= h($page->notation) ?></td>
                                <td class="align-middle">
                                    <div class="h4 mb-0">
                                        <?= isset($page->short_name) ? h($page->short_name) : $this->Panel->notSet('') ?>
                                    </div>
                                    
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    echo $this->AuthUser->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                        ['controller' => 'SystemicPages', 'action' => 'edit', h($page->id)],
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
                                        ['controller' => 'SystemicPages', 'action' => 'translate', h($page->id), 'en'],
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
                                        ['controller' => 'SystemicPages', 'action' => 'translate', h($page->id), 'uz'],
                                        ['escape' => false, 'class' => 'text-' . $color]
                                    );
                                    ?>
                                </td>
                                <td class="align-middle">
                                    <?php
                                    if ($page->has('modified')) {
                                        echo $page->modified->format('d.m.Y H:i:s');
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
