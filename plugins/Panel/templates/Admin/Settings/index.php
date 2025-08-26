<?php
$this->assign('title', __d('admin', 'Settings'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('admin', 'Settings')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['settings']['list'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([
    '/vendor/bootstrap4-editable/css/bootstrap-editable',
    'datagrid/datatables/datatables.bundle'
], ['block' => true]);

echo $this->Html->script([
    '/vendor/bootstrap4-editable/js/bootstrap-editable',
    'datagrid/datatables/datatables.bundle'
], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function () {
    $('.datatable').dataTable({
        pageLength: 25,
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [2, 5],
            orderable: false
        }],
    });

    $('.xeditable').editable({
        mode: 'inline',
        params: function (params) {
            params['_csrfToken'] = '<?= $this->request->getParam('_csrfToken') ?>';
            return params;
        }
    });
});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-cog"></i> <?= __d('admin', 'Settings') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('admin', 'Settings') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?= $this->AuthUser->link(__d('admin', 'Create new'), ['controller' => 'Settings', 'action' => 'add'], ['class' => 'btn btn-xs btn-success']) ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-striped table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all" style="min-width: 15%;"><?= __d('admin', 'Title') ?></th>
                                <th class="text-center min-desktop"><?= __d('admin', 'Type') ?></th>
                                <th class="w-50 min-desktop"><?= __d('admin', 'Value') ?></th>
                                <th class="min-desktop"><?= __d('admin', 'Created') ?></th>
                                <th class="min-desktop"><?= __d('admin', 'Modified') ?></th>
                                <th class="all" style="width: 5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($settings as $key => $setting): ?>
                            <tr>
                                <td>
                                    <?= h($setting->title) ?>
                                    <code class="d-block"><?= "Settings.{$setting->field_key}" ?></code>
                                </td>
                                <td class="text-center">
                                    <?= isset($setting->field_type) ? h($setting->field_type) : $this->Panel->notSet('') ?>
                                </td>
                                <td>
                                    <?php
                                    if ($this->AuthUser->hasAccess(['controller' => 'Settings', 'action' => 'edit', '_ext' => 'json'])) {
                                        echo $this->Html->link(
                                            $setting->value,
                                            '#',
                                            [
                                                'data-type' => h($setting->field_type),
                                                'data-pk' => h($setting->id),
                                                'data-value' => h($setting->value),
                                                'data-url' => $this->Url->build(['controller' => 'Settings', 'action' => 'edit', '_ext' => 'json']),
                                                'class' => 'xeditable'
                                            ]
                                        );
                                    } else {
                                        echo h($setting->value);
                                    }
                                    ?>
                                </td>
                                <td data-order="<?= !isset($setting->created) ? : $setting->created->getTimestamp() ?>">
                                    <?= isset($setting->created) ? $setting->created->format('d.m.Y H:i') : $this->Panel->notSet('') ?>
                                </td>
                                <td data-order="<?= !isset($setting->modified) ? : $setting->modified->getTimestamp() ?>">
                                    <?= isset($setting->modified) ? $setting->modified->format('d.m.Y H:i:s') : $this->Panel->notSet('') ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if ($this->AuthUser->hasAccess(['controller' => 'Settings', 'action' => 'delete', h($setting->id)])) {
                                        echo $this->Form->deleteLink(
                                            $this->Html->tag('i', '', ['class' => 'fal fa-trash']),
                                            ['controller' => 'Settings', 'action' => 'delete', h($setting->id)],
                                            [
                                                'class' => 'text-danger',
                                                'confirm' => __d('admin', 'Are you sure you want to delete this setting?'),
                                                'escape' => false
                                            ]
                                        );
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