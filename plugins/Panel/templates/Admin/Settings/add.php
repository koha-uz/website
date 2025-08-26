<?php
$this->assign('title', __d('admin', 'Create Setting'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('admin', 'Settings')],
    ['title' => __d('admin', 'Create')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['settings']['create'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();
?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-plus-circle"></i> <?= __d('admin', 'Create Setting') ?>
    </h1>
</div>

<?= $this->Form->create($setting) ?>
<div class="row">
    <div class="col-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('admin', 'Create Setting') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row mb-4">
                        <div class="col-12">
                            <?php
                            echo $this->Form->control('field_key', [
                                'label' => __d('admin', 'Key') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('admin', 'Key')
                            ]);
                            echo $this->Form->control('field_type', [
                                'type' => 'select',
                                'options' => [
                                    'text' => __d('admin', 'Text'),
                                    'checkbox' => __d('admin', 'Checkbox'),
                                    'textarea' => __d('admin', 'Textarea')
                                ],
                                'label' => __d('admin', 'Type') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('admin', 'Type')
                            ]);
                            echo $this->Form->control('title', [
                                'label' => __d('admin', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('admin', 'Title')
                            ]);
                            echo $this->Form->control('value', [
                                'label' => __d('admin', 'Value') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('admin', 'Value')
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="border-top pt-3 text-right">
                                <?php
                                echo $this->AuthUser->link(
                                    __d('admin', 'Cancel'),
                                    ['controller' => 'Settings', 'action' => 'index'],
                                    ['class' => 'btn btn-default mr-2']
                                );
                                echo $this->Form->submit(__d('admin', 'Create'));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>