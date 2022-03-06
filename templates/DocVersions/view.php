<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocVersion $docVersion
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Doc Version'), ['action' => 'edit', $docVersion->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Doc Version'), ['action' => 'delete', $docVersion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docVersion->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Doc Versions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Doc Version'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docVersions view content">
            <h3><?= h($docVersion->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Doc') ?></th>
                    <td><?= $docVersion->has('doc') ? $this->Html->link($docVersion->doc->title, ['controller' => 'Docs', 'action' => 'view', $docVersion->doc->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Url') ?></th>
                    <td><?= h($docVersion->url) ?></td>
                </tr>
                <tr>
                    <th><?= __('Doc Versions Body Translation') ?></th>
                    <td><?= $docVersion->has('body_translation') ? $this->Html->link($docVersion->body_translation->id, ['controller' => 'DocVersions_body_translation', 'action' => 'view', $docVersion->body_translation->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Doc Versions Url Translation') ?></th>
                    <td><?= $docVersion->has('url_translation') ? $this->Html->link($docVersion->url_translation->id, ['controller' => 'DocVersions_url_translation', 'action' => 'view', $docVersion->url_translation->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($docVersion->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Version') ?></th>
                    <td><?= $this->Number->format($docVersion->version) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Approved') ?></th>
                    <td><?= h($docVersion->date_approved) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Created') ?></th>
                    <td><?= h($docVersion->date_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Modified') ?></th>
                    <td><?= h($docVersion->date_modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Current') ?></th>
                    <td><?= $docVersion->is_current ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Body') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($docVersion->body)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related I18n') ?></h4>
                <?php if (!empty($docVersion->_i18n)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Locale') ?></th>
                            <th><?= __('Foreign Key') ?></th>
                            <th><?= __('Model') ?></th>
                            <th><?= __('Field') ?></th>
                            <th><?= __('Content') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($docVersion->_i18n as $i18n) : ?>
                        <tr>
                            <td><?= h($i18n->id) ?></td>
                            <td><?= h($i18n->locale) ?></td>
                            <td><?= h($i18n->foreign_key) ?></td>
                            <td><?= h($i18n->model) ?></td>
                            <td><?= h($i18n->field) ?></td>
                            <td><?= h($i18n->content) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'I18n', 'action' => 'view', $i18n->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'I18n', 'action' => 'edit', $i18n->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'I18n', 'action' => 'delete', $i18n->id], ['confirm' => __('Are you sure you want to delete # {0}?', $i18n->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
