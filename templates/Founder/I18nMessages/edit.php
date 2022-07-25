<?php
use Cake\Utility\Inflector;

$title = __d('panel', '{0} «{1}» domain messages', Inflector::camelize($this->request->getParam('locale')), Inflector::camelize($this->request->getParam('domain')));
$this->assign('title', $title);

$this->start('breadcrumbs');
$breadcrumbs = [['title' => $title]];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['i18n_messages'][$this->request->getParam('domain')][$this->request->getParam('locale')] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css('formplugins/summernote/summernote', ['block' => true]);

echo $this->Html->script(
    [
        '/vendor/bundle.umd.min',
        'formplugins/summernote/summernote'
    ],
    ['block' => true]
);
?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-flag"></i> <?= $title ?>
    </h1>
</div>

<?= $this->Form->create($i18nMessages) ?>
<div class="row">
    <div class="col">
        <div id="panel-1" class="panel">
            <div class="panel-container show">
                <div class="panel-content">
                    <?php foreach($i18nMessages as $key => $i18nMessage): ?>
                    <div class="row border border-faded rounded p-3 m-1 mb-3 shadow-hover-inset-2">
                        <div class="col-md-6">
                            <dl class="row fs-xl">
                                <dt class="col-sm-3"><?= __d('panel', 'Singular') ?></dt>
                                <dd class="col-sm-9"><code><?= $i18nMessage->singular ?></code></dd>

                                <?php if ($i18nMessage->has('context')): ?>
                                <dt class="col-sm-3"><?= __d('panel', 'Plural') ?></dt>
                                <dd class="col-sm-9"><?= $i18nMessage->plural ?></dd>
                                <?php endif; ?>

                                <?php if ($i18nMessage->has('context')): ?>
                                <dt class="col-sm-3"><?= __d('panel', 'Context') ?></dt>
                                <dd class="col-sm-9"><?= $i18nMessage->context ?></dd>
                                <?php endif; ?>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control($key . '.id', [
                                'type' => 'hidden',
                                'value' => $i18nMessage->id
                            ]);
                            echo $this->Form->control($key . '.value_0', [
                                'label' => ['class' => 'sr-only'],
                                'class' => 'form-control form-control-sm',
                                'placeholder' => __d('panel', 'Value 0')
                            ]);

                            echo $this->Form->control($key . '.value_1', [
                                'label' => ['class' => 'sr-only'],
                                'class' => 'form-control form-control-sm',
                                'placeholder' => __d('panel', 'Value 1')
                            ]);

                            echo $this->Form->control($key . '.value_2', [
                                'label' => ['class' => 'sr-only'],
                                'class' => 'form-control form-control-sm',
                                'placeholder' => __d('panel', 'Value 2')
                            ]);
                            ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0">
                    <?= $this->Form->submit(__d('panel', 'Save')) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>
