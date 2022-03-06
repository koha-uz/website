<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ad $ad
 * @var string[]|\Cake\Collection\CollectionInterface $adCategories
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ad->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ad->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Ads'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ads form content">
            <?= $this->Form->create($ad) ?>
            <fieldset>
                <legend><?= __('Edit Ad') ?></legend>
                <?php
                    echo $this->Form->control('add_category_id', ['options' => $adCategories]);
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
