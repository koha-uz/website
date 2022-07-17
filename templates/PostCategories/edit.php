<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AdCategory $adCategory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $adCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $adCategory->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Ad Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="adCategories form content">
            <?= $this->Form->create($adCategory) ?>
            <fieldset>
                <legend><?= __('Edit Ad Category') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('slug');
                    echo $this->Form->control('body');
                    echo $this->Form->control('date_created');
                    echo $this->Form->control('date_modified', ['empty' => true]);
                    echo $this->Form->control('date_published', ['empty' => true]);
                    echo $this->Form->control('published');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
