<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Doc $doc
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $doc->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $doc->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Docs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docs form content">
            <?= $this->Form->create($doc) ?>
            <fieldset>
                <legend><?= __('Edit Doc') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('slug');
                    echo $this->Form->control('body');
                    echo $this->Form->control('date_created');
                    echo $this->Form->control('date_modified', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
