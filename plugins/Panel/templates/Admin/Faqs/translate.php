<?php
$this->assign('title', __d('admin', 'FAQ Translation: {0}', h($faq->title)));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('admin', 'Services'), 'url' => ['controller' => 'Services', 'action' => 'index']],
    ['title' => __d('admin', 'FAQ'), 'url' => ['controller' => 'Faqs', 'action' => 'index']],
    ['title' => h($faq->question), 'url' => ['controller' => 'Faqs', 'action' => 'edit', h($faq->id)]],
    ['title' => __d('admin', 'Translate')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['services']['faqs'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();
?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-globe"></i> <?= __d('admin', 'FAQ Translation:') ?> 
        <?= $this->Html->link(h($faq->question), ['controller' => 'Faqs', 'action' => 'edit', h($faq->id)]) ?>
    </h1>
</div>

<?= $this->Form->create($faq) ?>

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
                            <h2 class="h3 mb-5"><?= __d('admin', 'Original:') ?> <?= $this->Html->image('flag/ru.png', ['class' => 'ml-2', 'style' => 'width: 30px']) ?></h2>
                            <?php
                            echo $this->Form->control('question', [
                                'label' => __d('admin', 'Question'),
                                'disabled' => true,
                                'placeholder' => __d('admin', 'Question')
                            ]);
                            echo $this->Form->control('answer', [
                                'label' => __d('admin', 'Answer'),
                                'disabled' => true,
                                'rows' => 10,
                                'placeholder' => __d('admin', 'Answer')
                            ]);
                            echo $this->element('MetaTags/original');
                            ?>
                        </div>
                        <div class="col-lg-6">
                            <h2 class="h3 mb-5"><?= __d('admin', 'Translate To:') ?> <?= $this->Html->image('flag/' . $this->request->getParam('locale') . '.png', ['class' => 'ml-2', 'style' => 'width: 30px']) ?></h2>
                            <?php
                            echo $this->Form->control('_translations.' . $this->request->getParam('locale') . '.question', [
                                'label' => __d('admin', 'Question') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'placeholder' => __d('admin', 'Question')
                            ]);
                            echo $this->Form->control('_translations.' . $this->request->getParam('locale') . '.answer', [
                                'label' => __d('admin', 'Answer') . $this->Html->tag('span' , '*', ['class' => 'ml-1 text-danger']),
                                'escape' => false,
                                'rows' => 10,
                                'placeholder' => __d('admin', 'Answer')
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
                                    ['controller' => 'Faqs', 'action' => 'index'],
                                    ['class' => 'btn btn-default mr-2']
                                );
                                echo $this->Form->submit(__d('admin', 'Save'));
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
