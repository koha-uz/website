<?php
$this->assign('title', __d('panel', '{0} — Settings', $this->request->getParam('key')));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Settings')],
    ['title' => $this->request->getParam('key')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['settings'][$this->request->getParam('key')] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css(
    '/vendor/bootstrap4-editable/css/bootstrap-editable',
    ['block' => true]
);
$this->start('script');
echo $this->Html->script([
    '/vendor/bootstrap4-editable/js/bootstrap-editable'
]);
$this->end();
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function () {
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
        <i class="subheader-icon fal fa-cog"></i> <?= $this->request->getParam('key') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Publish mode') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-striped table-hover table-striped w-100">
                        <thead>
                            <tr>
                                <th><?= __d('panel', 'Title') ?></th>
                                <th><?= __d('panel', 'Value') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($settings as $key => $setting): ?>
                            <tr>
                                <td class="w-25">
                                    <?= h($setting->title) ?>
                                    <code class="d-block"><?= "Settings.{$setting->field_key}" ?></code>
                                </td>
                                <td class="w-75">
                                    <?php
                                    echo $this->Html->link(
                                        h($setting->value),
                                        '#',
                                        [
                                            'data-type' => h($setting->field_type),
                                            'data-pk' => h($setting->id),
                                            'data-value' => h($setting->value),
                                            'data-url' => $this->Url->build(['action' => 'edit', '_ext' => 'json']),
                                            'class' => 'xeditable'
                                        ]
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