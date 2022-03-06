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
            <?= $this->Html->link(__('Edit Ad Category'), ['action' => 'edit', $adCategory->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Ad Category'), ['action' => 'delete', $adCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $adCategory->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Ad Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Ad Category'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="adCategories view content">
            <h3><?= h($adCategory->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($adCategory->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Slug') ?></th>
                    <td><?= h($adCategory->slug) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($adCategory->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Created') ?></th>
                    <td><?= h($adCategory->date_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Modified') ?></th>
                    <td><?= h($adCategory->date_modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Published') ?></th>
                    <td><?= h($adCategory->date_published) ?></td>
                </tr>
                <tr>
                    <th><?= __('Published') ?></th>
                    <td><?= $adCategory->published ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Body') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($adCategory->body)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
