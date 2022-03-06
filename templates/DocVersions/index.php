<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocVersion[]|\Cake\Collection\CollectionInterface $docVersions
 */
?>
<div class="docVersions index content">
    <?= $this->Html->link(__('New Doc Version'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Doc Versions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('doc_id') ?></th>
                    <th><?= $this->Paginator->sort('version') ?></th>
                    <th><?= $this->Paginator->sort('is_current') ?></th>
                    <th><?= $this->Paginator->sort('url') ?></th>
                    <th><?= $this->Paginator->sort('date_approved') ?></th>
                    <th><?= $this->Paginator->sort('date_created') ?></th>
                    <th><?= $this->Paginator->sort('date_modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($docVersions as $docVersion): ?>
                <tr>
                    <td><?= $this->Number->format($docVersion->id) ?></td>
                    <td><?= $docVersion->has('doc') ? $this->Html->link($docVersion->doc->title, ['controller' => 'Docs', 'action' => 'view', $docVersion->doc->id]) : '' ?></td>
                    <td><?= $this->Number->format($docVersion->version) ?></td>
                    <td><?= h($docVersion->is_current) ?></td>
                    <td><?= h($docVersion->url) ?></td>
                    <td><?= h($docVersion->date_approved) ?></td>
                    <td><?= h($docVersion->date_created) ?></td>
                    <td><?= h($docVersion->date_modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $docVersion->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $docVersion->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $docVersion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docVersion->id)]) ?>
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
