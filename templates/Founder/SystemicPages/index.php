<?php
$this->assign('title', __d('panel', 'Systemic pages'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Systemic pages')]
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
        pageLength: 25,
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [3],
            orderable: false
        }],
        order: [[1, 'asc']]
    });
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-paperclip"></i> <?= __d('panel', 'Systemic pages') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="min-desktop"><?= __d('panel', 'Notation') ?></th>
                                <th class="all" style="width: 60%"><?= __d('panel', 'Short name') ?></th>
                                <th class="min-desktop" style="width: 18%"><?= __d('panel', 'Date modified') ?></th>
                                <th class="all" style="width: 5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($systemicPages as $page): ?>
                            <tr>
                                <td><?= h($page->notation) ?></td>
                                <td><?= h($page->short_name) ?></td>
                                <td>
                                    <?php
                                    if ($page->has('date_modified')) {
                                        echo $page->date_modified->format('d.m.Y H:i');
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                        ['action' => 'edit', h($page->id)],
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
