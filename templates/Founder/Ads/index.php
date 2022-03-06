<?php
$this->assign('title', __d('panel', 'Ads'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Ads')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['ads'][1] = true;
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
            targets: [0, 4, 5],
            orderable: false
        }],
        order: [[3, 'asc']]
    });
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-newspaper"></i> <?= __d('panel', 'Ads') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Ads') ?></h2>
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
                                <th class="min-tablet"><?= __d('panel', 'Category') ?></th>
                                <th class="all" style="width: 60%"><?= __d('panel', 'Title') ?></th>
                                <th class="min-desktop"><?= __d('panel', 'Date Published') ?></th>
                                <th class="min-phone text-center"><?= __d('panel', 'Mode') ?></th>
                                <th class="all"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ads as $ad): ?>
                            <tr>
                                <td class="text-center">
                                    <?php
                                    if ($ad->published && $ad->ad_category->published) {
                                        echo $this->Html->link(
                                            $this->Html->tag('i', '', ['class' => 'fal fa-eye']),
                                            ['_name' => 'ad_view', 'slug' => h($ad->slug), 'lang' => 'en'],
                                            ['escape' => false, 'target' => '_blank']
                                        );
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $this->Html->link(
                                        $ad->ad_category->title,
                                        ['controller' => 'AdCategories', 'action' => 'edit', $ad->ad_category->id]
                                    );
                                    echo ' ' . $this->Panel->boolIcon($ad->ad_category->published);
                                    ?>
                                </td>
                                <td>
                                    <?= h($ad->title) ?>
                                    <code class="d-block">
                                        <?php
                                        echo $this->Url->build(
                                            ['_name' => 'ad_view', 'slug' => h($ad->slug), 'lang' => 'en'],
                                            ['fullBase' => true]
                                        );
                                        ?>
                                    </code>
                                </td>
                                <td><?= $this->Time->i18nFormat($ad->date_published, 'dd MMMM Y H:mm:ss') ?></td>
                                <td class="text-center"><?= $this->Published->publishLink($ad) ?></td>
                                <td class="text-center">
                                    <?php
                                    echo $this->Html->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                        ['action' => 'edit', h($ad->id)],
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
