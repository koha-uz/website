<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Doc[]|\Cake\Collection\CollectionInterface $docs
 */
?>
<div class="docs index content">
    <?= $this->Html->link(__('New Doc'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Docs') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('slug') ?></th>
                    <th><?= $this->Paginator->sort('date_created') ?></th>
                    <th><?= $this->Paginator->sort('date_modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($docs as $doc): ?>
                <tr>
                    <td><?= $this->Number->format($doc->id) ?></td>
                    <td><?= h($doc->title) ?></td>
                    <td><?= h($doc->slug) ?></td>
                    <td><?= h($doc->date_created) ?></td>
                    <td><?= h($doc->date_modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $doc->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $doc->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $doc->id], ['confirm' => __('Are you sure you want to delete # {0}?', $doc->id)]) ?>
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
