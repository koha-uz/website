<?php
$this->assign('title', __d('admin', 'FAQs'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('admin', 'Services'), 'url' => ['controller' => 'Services', 'action' => 'index']],
    ['title' => __d('admin', 'FAQs')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['services']['faqs'] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->css('datagrid/datatables/datatables.bundle', ['block' => true]);
echo $this->Html->script('datagrid/datatables/datatables.bundle', ['block' => true]);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    $('.datatable').dataTable({
        pageLength: 25,
        responsive: {
            details: {
                type: 'column', target: 'tr'
            }
        },
        columnDefs: [{
            targets: [2, 3, 4, 7],
            orderable: false
        }],
        order: [[6, 'desc']]
    });
});
</script>
<?php $this->end(); ?>


<div class="subheader">
    <h1 class="subheader-title">
        <i class="subheader-icon fal fa-question"></i> <?= __d('admin', 'FAQs') ?>
    </h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel" data-panel-close data-panel-sortable data-panel-fullscreen data-panel-refresh data-panel-locked data-panel-collapsed>
            <div class="panel-hdr">
                <h2><?= __d('admin', 'FAQs') ?></h2>
                <div class="panel-toolbar ml-auto mr-3">
                    <?= $this->AuthUser->link(__d('admin', 'Create new'), ['controller' => 'Faqs', 'action' => 'add'], ['class' => 'btn btn-xs btn-success']) ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-bordered table-hover table-striped w-100 datatable">
                        <thead>
                            <tr>
                                <th class="all align-middle" style="width: 40%"><?= __d('admin', 'Question') ?></th>
                                <th class="min-desktop align-middle"><?= __d('admin', 'Service') ?></th>
                                <th class="min-desktop text-center align-middle"><?= $this->Html->image('flag/ru.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop text-center align-middle"><?= $this->Html->image('flag/en.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop text-center align-middle"><?= $this->Html->image('flag/uz.png', ['style' => 'width: 20px']) ?></th>
                                <th class="min-desktop align-middle"><?= __d('admin', 'Date Created') ?></th>
                                <th class="min-desktop align-middle"><?= __d('admin', 'Date Published') ?></th>
                                <th class="min-tablet text-center align-middle"><?= __d('admin', 'Mode') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($faqs as $faq): ?>
                            <tr>
                                <td class="align-middle">
                                    <span class="h4 ml-2">
                                        <?= isset($faq->question) ? h($faq->question) : $this->Panel->notSet('') ?>
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <?php
                                    if ($this->AuthUser->hasAccess(['controller' => 'Services', 'action' => 'edit', $faq->service->id])) {
                                        echo $this->Html->link(
                                            h($faq->service->title),
                                            ['controller' => 'Services', 'action' => 'edit', $faq->service->id]
                                        );
                                        echo ' ' . $this->Panel->boolIcon($faq->service->is_published);
                                    }
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    echo $this->AuthUser->link(
                                        $this->Html->tag('i', '', ['class' => 'fal fa-pencil']),
                                        ['controller' => 'Faqs', 'action' => 'edit', h($faq->id)],
                                        ['escape' => false]
                                    );
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    $color = 'success';
                                    $title = $this->Html->tag('i', '', ['class' => 'fal fa-plus']);
                                    if (array_key_exists('en', $faq->_translations)) {
                                        $color = 'info';
                                        $title = $this->Html->tag('i', '', ['class' => 'fal fa-pencil']);
                                    }
                                    echo $this->AuthUser->link($title,
                                        ['controller' => 'Faqs', 'action' => 'translate', h($faq->id), 'en'],
                                        ['escape' => false, 'class' => 'text-' . $color]
                                    );
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    $color = 'success';
                                    $title = $this->Html->tag('i', '', ['class' => 'fal fa-plus']);
                                    if (array_key_exists('uz', $faq->_translations)) {
                                        $color = 'info';
                                        $title = $this->Html->tag('i', '', ['class' => 'fal fa-pencil']);
                                    }
                                    echo $this->AuthUser->link($title,
                                        ['controller' => 'Faqs', 'action' => 'translate', h($faq->id), 'uz'],
                                        ['escape' => false, 'class' => 'text-' . $color]
                                    );
                                    ?>
                                </td>
                                <td class="align-middle" data-order="<?= !isset($faq->created) ? : $faq->created->getTimestamp() ?>">
                                    <?= isset($faq->created) ? $faq->created->format('d.m.Y H:i:s') : $this->Panel->notSet('') ?>
                                </td>
                                <td class="align-middle" data-order="<?= !isset($faq->published) ? : $faq->published->getTimestamp() ?>">
                                    <?= isset($faq->published) ? $faq->published->format('d.m.Y H:i') : $this->Panel->notSet('') ?>
                                </td>
                                <td class="text-center align-middle">
                                    <?php
                                    if ($this->AuthUser->hasAccess(['controller' => $faq->getSource(), 'action' => 'setPublished', h($faq->id)])) {
                                        echo $this->Published->publishLink($faq);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
