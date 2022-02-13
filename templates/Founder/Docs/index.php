<?php
$this->assign('title', __d('panel', 'Documents'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Documents')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['docs'][1] = true;
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
            targets: [0, 4],
            orderable: false
        }],
        order: [[1, 'asc']]
    });
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-file-pdf"></i> <?= __d('panel', 'Documents') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Documents') ?></h2>
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
                                <th class="all"><?= __d('panel', 'Title') ?></th>
                                <th class="all"><?= __d('panel', 'Number of versions') ?></th>
                                <th class="min-phone text-center"><?= __d('panel', 'Date modified') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($docs as $doc): ?>
                            <tr>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-eye']),
                                        ['_name' => 'doc_view', 'slug' => h($doc->slug)],
                                        ['escape' => false, 'target' => '_blank']
                                    );
                                    ?>
                                </td>
                                <td>
                                    <?= h($doc->title) ?>
                                    <code class="d-block">
                                        <?php
                                        echo $this->Url->build(
                                            ['_name' => 'doc_view', 'slug' => h($doc->slug), 'lang' => 'en'],
                                            ['fullBase' => true]
                                        );
                                        ?>
                                    </code>
                                </td>
                                <td class="text-center"><?= count($doc->doc_versions) ?></td>
                                <td><?= $this->Time->i18nFormat($doc->date_modified, 'dd MMMM Y h:mm:ss') ?></td>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                        ['action' => 'edit', h($doc->id)],
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
