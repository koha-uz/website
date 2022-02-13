<?php
$this->assign('title', __d('panel', 'Faqs'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Faqs')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['faqs'][1] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css('datagrid/datatables/datatables.bundle', ['block' => true]);
echo $this->Html->script('datagrid/datatables/datatables.bundle', ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.datatable').dataTable({
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [5],
            orderable: false
        }],
        order: [[0, 'asc']]
    });
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-align-left"></i> <?= __d('panel', 'FAQs') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'FAQs') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?= $this->Html->link(__d('panel', 'Create new'), ['action' => 'add'], ['class' => 'btn btn-xs btn-success']) ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all" style="width: 50%"><?= __d('panel', 'Title') ?></th>
                                <th class="min-tablet"><?= __d('panel', 'Category') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Date created'); ?></th>
                                <th class="min-desktop text-center"><?= __d('panel', 'Popular'); ?></th>
                                <th class="min-tablet text-center"><?= __d('panel', 'Mode') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($faqs as $faq): ?>
                            <tr>
                                <td><?= h($faq->title) ?></td>
                                <td>
                                    <?php
                                    echo $this->Html->link(h($faq->faq_category->title),
                                        ['controller' => 'FaqCategories', 'action' => 'edit', h($faq->faq_category->id)]
                                    );
                                    ?>
                                </td>
                                <td><?= $faq->date_created->format('d-m-Y H:i:s') ?></td>
                                <td class="text-center" data-order="<?= $faq->popular ?>">
                                    <?php
                                    $status = 'fal fa-ban text-danger';
                                    if ($faq->popular) {
                                        $status = 'fal fa-check text-success';
                                    }
                                    echo $this->Html->tag('i', '', ['class' => $status])
                                    ?>
                                </td>
                                <td class="text-center"><?php echo $this->Published->publishLink($faq) ?></td>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                        ['action' => 'edit', h($faq->id)],
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
