<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AdCategory[]|\Cake\Collection\CollectionInterface $adCategories
 */
?>
<div class="adCategories index content">
    <?= $this->Html->link(__('New Ad Category'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Ad Categories') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
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
                <?php foreach ($adCategories as $adCategory): ?>
                <tr>
                    <td><?= $this->Number->format($adCategory->id) ?></td>
                    <td><?= h($adCategory->title) ?></td>
                    <td><?= h($adCategory->slug) ?></td>
                    <td><?= h($adCategory->date_created) ?></td>
                    <td><?= h($adCategory->date_modified) ?></td>
                    <td><?= h($adCategory->date_published) ?></td>
                    <td><?= h($adCategory->published) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $adCategory->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $adCategory->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $adCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $adCategory->id)]) ?>
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
