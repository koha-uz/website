<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocVersion $docVersion
 * @var string[]|\Cake\Collection\CollectionInterface $docs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $docVersion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $docVersion->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Doc Versions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docVersions form content">
            <?= $this->Form->create($docVersion) ?>
            <fieldset>
                <legend><?= __('Edit Doc Version') ?></legend>
                <?php
                    echo $this->Form->control('doc_id', ['options' => $docs]);
                    echo $this->Form->control('version');
                    echo $this->Form->control('body');
                    echo $this->Form->control('is_current');
                    echo $this->Form->control('url');
                    echo $this->Form->control('date_approved');
                    echo $this->Form->control('date_created');
                    echo $this->Form->control('date_modified', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
