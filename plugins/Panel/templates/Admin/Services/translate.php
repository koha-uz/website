<?php
$this->assign('title', __d('panel', 'Service Translation: {0}', h($service->title)));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Services'), 'url' => ['controller' => 'Services', 'action' => 'index']],
    ['title' => h($service->title), 'url' => ['controller' => 'Services', 'action' => 'edit', h($service->id)]],
    ['title' => __d('panel', 'Translate')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['services']['list'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();
?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-globe"></i> <?= __d('panel', 'Service Translation:') ?> 
        <?= $this->Html->link(h($service->title), ['action' => 'edit', h($service->id)]) ?>
    </h1>
</div>

<?= $this->Form->create($service) ?>

<?php
echo $this->Form->control('_locale', [
    'type' => 'hidden',
    'value' => $this->request->getParam('locale')
]);
?>

<div class="row">
    <div class="col-12">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <h2 class="h3 mb-5"><?= __d('panel', 'Original:') ?> <?= $this->Html->image('flag/ru.png', ['class' => 'ml-2', 'style' => 'width: 30px']) ?></h2>
                            <?php
                            echo $this->Form->control('title', [
                                'label' => __d('admin', 'Title'),
                                'disabled' => true,
                                'placeholder' => __d('panel', 'Title')
                            ]);
                            echo $this->Form->control('body', [
                                'label' => __d('admin', 'Body'),
                                'disabled' => true,
                                'rows' => 10,
                                'placeholder' => __d('panel', 'Body')
                            ]);
                            echo $this->element('MetaTags/original');
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <h2 class="h3 mb-5"><?= __d('panel', 'Translate To:') ?> <?= $this->Html->image('flag/' . $this->request->getParam('locale') . '.png', ['class' => 'ml-2', 'style' => 'width: 30px']) ?></h2>
                            <?php
                            echo $this->Form->control('_translations.' . $this->request->getParam('locale') . '.title', [
                                'label' => __d('admin', 'Title') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('panel', 'Title')
                            ]);
                            echo $this->Form->control('_translations.' . $this->request->getParam('locale') . '.body', [
                                'label' => __d('admin', 'Body') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'rows' => 10,
                                'placeholder' => __d('panel', 'Body')
                            ]);
                            echo $this->element('MetaTags/translate', ['locale' => $this->request->getParam('locale')]);
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="border-top pt-3 text-right">
                                <?php
                                echo $this->Html->link(
                                    __d('admin', 'Cancel'),
                                    ['controller' => 'Services', 'action' => 'index'],
                                    ['class' => 'btn btn-default mr-2']
                                );
                                echo $this->Form->submit(__d('panel', 'Save'));
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
