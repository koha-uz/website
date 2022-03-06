<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ad $ad
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Ad'), ['action' => 'edit', $ad->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Ad'), ['action' => 'delete', $ad->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ad->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Ads'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Ad'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ads view content">
            <h3><?= h($ad->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Ad Category') ?></th>
                    <td><?= $ad->has('ad_category') ? $this->Html->link($ad->ad_category->title, ['controller' => 'AdCategories', 'action' => 'view', $ad->ad_category->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($ad->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Slug') ?></th>
                    <td><?= h($ad->slug) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($ad->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Created') ?></th>
                    <td><?= h($ad->date_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Modified') ?></th>
                    <td><?= h($ad->date_modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Published') ?></th>
                    <td><?= h($ad->date_published) ?></td>
                </tr>
                <tr>
                    <th><?= __('Published') ?></th>
                    <td><?= $ad->published ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Body') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($ad->body)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
