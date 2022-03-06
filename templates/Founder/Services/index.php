<?php
$this->assign('title', __d('panel', 'Services'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Services')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['services'][1] = true;
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
            targets: [0, 5],
            orderable: false
        }],
        order: [[2, 'asc']]
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
                    <?= $this->Html->link(__d('panel', 'Create new'), ['action' => 'add'], ['class' => 'btn btn-xs btn-success']) ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all"></th>
                                <th class="min-tablet"><?= __d('panel', 'Parent') ?></th>
                                <th class="all" style="width: 60%"><?= __d('panel', 'Title') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Date Published') ?></th>
                                <th class="min-phone text-center"><?= __d('panel', 'Mode') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($services as $service): ?>
                            <tr>
                                <td class="text-center">
                                    <?php
                                    if ($service->published) {
                                        echo $this->Html->link(
                                            $this->Html->tag('i', '', ['class' => 'fal fa-eye']),
                                            ['_name' => 'service_view', 'slug' => h($service->slug), 'lang' => 'en'],
                                            ['escape' => false, 'target' => '_blank']
                                        );
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (null !== $service->parent_service) {
                                        echo h($service->parent_service->title);
                                        echo $this->Html->tag('code', h($service->parent_service->slug), ['class' => 'd-block']);
                                    } else {
                                        echo $this->Html->tag('span', __d('panel', 'Root'), ['class' => 'color-danger-600 fs-xl font-italic']);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?= h($service->title) ?>
                                    <code class="d-block">
                                        <?php
                                        echo $this->Url->build(
                                            ['_name' => 'service_view', 'slug' => h($service->slug), 'lang' => 'en'],
                                            ['fullBase' => true]
                                        );
                                        ?>
                                    </code>
                                </td>
                                <td><?= $this->Time->i18nFormat($service->date_published, 'dd MMMM Y H:mm:ss') ?></td>
                                <td class="text-center"><?= $this->Published->publishLink($service) ?></td>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                        ['action' => 'edit', h($service->id)],
                                        ['escape' => false]
                                    );
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
