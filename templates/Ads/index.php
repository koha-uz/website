<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ad[]|\Cake\Collection\CollectionInterface $ads
 */
?>
<div class="ads index content">
    <?= $this->Html->link(__('New Ad'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Ads') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('add_category_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('slug') ?></th>
                    <th><?= $this->Paginator->sort('date_created') ?></th>
                    <th><?= $this->Paginator->sort('date_modified') ?></th>
                    <th><?= $this->Paginator->sort('date_published') ?></th>
                    <th><?= $this->Paginator->sort('published') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ads as $ad): ?>
                <tr>
                    <td><?= $this->Number->format($ad->id) ?></td>
                    <td><?= $ad->has('ad_category') ? $this->Html->link($ad->ad_category->title, ['controller' => 'AdCategories', 'action' => 'view', $ad->ad_category->id]) : '' ?></td>
                    <td><?= h($ad->title) ?></td>
                    <td><?= h($ad->slug) ?></td>
                    <td><?= h($ad->date_created) ?></td>
                    <td><?= h($ad->date_modified) ?></td>
                    <td><?= h($ad->date_published) ?></td>
                    <td><?= h($ad->published) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ad->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ad->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ad->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ad->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
