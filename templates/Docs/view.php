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
            <?= $this->Html->link(__('Edit Doc'), ['action' => 'edit', $doc->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Doc'), ['action' => 'delete', $doc->id], ['confirm' => __('Are you sure you want to delete # {0}?', $doc->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Docs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Doc'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="docs view content">
            <h3><?= h($doc->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($doc->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Slug') ?></th>
                    <td><?= h($doc->slug) ?></td>
                </tr>
                <tr>
                    <th><?= __('Meta Tag') ?></th>
                    <td><?= $doc->has('meta_tag') ? $this->Html->link($doc->meta_tag->title, ['controller' => 'MetaTags', 'action' => 'view', $doc->meta_tag->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Docs Title Translation') ?></th>
                    <td><?= $doc->has('title_translation') ? $this->Html->link($doc->title_translation->id, ['controller' => 'Docs_title_translation', 'action' => 'view', $doc->title_translation->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Docs Body Translation') ?></th>
                    <td><?= $doc->has('body_translation') ? $this->Html->link($doc->body_translation->id, ['controller' => 'Docs_body_translation', 'action' => 'view', $doc->body_translation->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($doc->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Created') ?></th>
                    <td><?= h($doc->date_created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Modified') ?></th>
                    <td><?= h($doc->date_modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Body') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($doc->body)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Doc Versions') ?></h4>
                <?php if (!empty($doc->doc_versions)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Doc Id') ?></th>
                            <th><?= __('Version') ?></th>
                            <th><?= __('Body') ?></th>
                            <th><?= __('Is Current') ?></th>
                            <th><?= __('Url') ?></th>
                            <th><?= __('Date Approved') ?></th>
                            <th><?= __('Date Created') ?></th>
                            <th><?= __('Date Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($doc->doc_versions as $docVersions) : ?>
                        <tr>
                            <td><?= h($docVersions->id) ?></td>
                            <td><?= h($docVersions->doc_id) ?></td>
                            <td><?= h($docVersions->version) ?></td>
                            <td><?= h($docVersions->body) ?></td>
                            <td><?= h($docVersions->is_current) ?></td>
                            <td><?= h($docVersions->url) ?></td>
                            <td><?= h($docVersions->date_approved) ?></td>
                            <td><?= h($docVersions->date_created) ?></td>
                            <td><?= h($docVersions->date_modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'DocVersions', 'action' => 'view', $docVersions->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'DocVersions', 'action' => 'edit', $docVersions->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'DocVersions', 'action' => 'delete', $docVersions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $docVersions->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related I18n') ?></h4>
                <?php if (!empty($doc->_i18n)) : ?>
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
                        <?php foreach ($doc->_i18n as $i18n) : ?>
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
