<?php
$this->assign('title', __d('panel', 'Create setting'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Settings')],
    ['title' => __d('panel', 'Create')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['settings'][0] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();
?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-plus-circle"></i> <?= __d('panel', 'Create setting') ?>
    </h1>
</div>

<?= $this->Form->create($setting) ?>

<div class="row">
    <div class="col-md-9">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
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
        </div>
    </div>
    <div class="col-md-3">
        <div id="panel-2" class="panel shadow-0" data-panel-close data-panel-collapsed data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'Publish mode') ?></h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content text-right">
                    <?= $this->Form->submit(__d('panel', 'Save')) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>