<?php
$this->assign('title', __d('panel', 'Question #{0}', $question->id));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Questions'), 'url' => ['controller' => 'Questions', 'action' => 'index']],
    ['title' => __d('panel', 'Question #{0}', $question->id)]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['questions'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css([

], ['block' => true]);

echo $this->Html->script([

], ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {

});
</script>
<?php $this->end(); ?>

<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-question"></i> <?= __d('panel', 'Question #{0}', $question->id) ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('panel', 'General') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?php
                    echo $this->Form->postLink(
                        __d('panel', 'Confirm'),
                        $this->Url->build(['controller' => 'Questions', 'action' => 'confirm', h($question->id)]),
                        [
                            'class' => 'btn btn-xs btn-warning',
                            'data-title' => __d('panel', 'Are you sure you want to confirm the question?')
                        ]
                    );

                    echo $this->Form->postLink(
                        __d('panel', 'Delete'),
                        $this->Url->build(['action' => 'delete', h($question->id)]),
                        [
                            'class' => 'btn btn-xs btn-danger ml-2',
                            'data-title' => __d('panel', 'Are you sure you want to delete the question?'),
                            'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                        ]
                    );
                    ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <dl class="row fs-xl mb-0">
                        <dt class="col-md-2 col-xl-1"><?= __d('panel', 'Fullname') ?></dt>
                        <dd class="col-md-10 col-xl-11"><?= $question->fullname ?></dd>
                        <dt class="col-md-2 col-xl-1"><?= __d('panel', 'Telephone') ?></dt>
                        <dd class="col-md-10 col-xl-11"><?= $question->telephone ?></dd>

                        <?php if (!empty($question->email)): ?>
                        <dt class="col-md-2 col-xl-1"><?= __d('panel', 'Email') ?></dt>
                        <dd class="col-md-10 col-xl-11"><?= $question->email ?></dd>
                        <?php endif; ?>

                        <dt class="col-md-2 col-xl-1"><?= __d('panel', 'Message') ?></dt>
                        <dd class="col-md-10 col-xl-11"><?= $question->body ?></dd>

                        <dt class="col-md-2 col-xl-1"><?= __d('panel', 'Date created') ?></dt>
                        <dd class="col-md-10 col-xl-11"><?= $this->Time->i18nFormat($question->date_created, 'd MMMM Y H:mm:ss') ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>