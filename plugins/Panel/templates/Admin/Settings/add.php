<?php
$this->assign('title', __d('panel', 'Create Setting'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Settings')],
    ['title' => __d('panel', 'Create')]
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
        <i class="subheader-icon fal fa-plus-circle"></i> <?= __d('panel', 'Create Setting') ?>
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
                                'label' => __d('panel', 'Key') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Key')
                            ]);
                            echo $this->Form->control('field_type', [
                                'type' => 'select',
                                'options' => [
                                    'text' => __d('panel', 'Text'),
                                    'checkbox' => __d('panel', 'Checkbox'),
                                    'textarea' => __d('panel', 'Textarea')
                                ],
                                'label' => __d('panel', 'Type') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Type')
                            ]);
                            echo $this->Form->control('title', [
                                'label' => __d('panel', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Title')
                            ]);
                            echo $this->Form->control('value', [
                                'label' => __d('panel', 'Value') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Value')
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="border-top pt-3 text-right">
                                <?php
                                echo $this->Html->link(
                                    __d('admin', 'Cancel'),
                                    ['controller' => 'Settings', 'action' => 'index'],
                                    ['class' => 'btn btn-default mr-2']
                                );
                                echo $this->Form->submit(__d('panel', 'Create'));
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