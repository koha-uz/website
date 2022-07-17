<?php
$this->assign('title', __d('panel', 'Images'));

$this->start('breadcrumbs');
$breadcrumbs = [
    ['title' => __d('panel', 'Files'), 'url' => ['action' => 'index']],
    ['title' => __d('panel', 'Images')]
];
echo $this->element('breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
$this->end();

$this->start('navigation');
$menu['files']['types'][1] = true;
echo $this->element('navigation', ['menu' => $menu]);
$this->end();

echo $this->Html->script(
    ['/vendor/clipboard.min', '/vendor/filesize.min'],
    ['block' => true]
);
?>

<?php $this->start('script-code'); ?>
<script>
$(document).ready(function() {
    let modal = $('#detailImage');
    let deleteLink = modal.find('#deleteLink').prop('outerHTML');
    const size = filesize.partial({standard: "iec"});
    $('.detail-image').on('click', function(event) {
        event.preventDefault();
        let $this = $(this);
        let id = $this.attr('data-id');
        let path = $this.attr('data-path');
        let filename = $this.attr('data-filename');
        let filesize = $this.attr('data-filesize');
        let mimeType = $this.attr('data-mimeType');
        let created = $this.attr('data-created');

        $('#deleteLink').replaceWith(deleteLink.replace('FILE_ID', id));
        modal.find('#imgFull').attr('src', path);
        modal.find('#filename').text(filename);
        modal.find('#mimeType').text(mimeType);
        modal.find('#created').text(created);
        modal.find('#filesize').text(size(filesize));
        modal.modal('toggle');

        $('#copy').on('click', function(event) {
            event.preventDefault();

            new ClipboardJS('#copy', {
                container: modal[0],
                'text': function() {
                    return path
                }
            });
        });
    });
});
</script>
<?php $this->end(); ?>

<style>
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(8rem, 1fr));
    grid-auto-rows: 1fr;
}

.grid::before {
    content: '';
    width: 0;
    padding-bottom: 100%;
    grid-row: 1 / 1;
    grid-column: 1 / 1;
}

.grid > *:first-child {
    grid-row: 1 / 1;
    grid-column: 1 / 1;
}

/* Just to make the grid visible */

.grid > * {
    background: rgba(0,0,0,0.1);
    border: 1px white solid;
}
</style>



<div class="row">
    <div class="col-12">
        <div class="grid">
            <?php
            foreach($files as $file) {
                echo $this->Html->link(
                    $this->Image->display($file, 'crop160', ['class' => 'img-fluid']),
                    '#',
                    [
                        'escape' => false,
                        'class' => 'detail-image',
                        'data-id' => h($file->id),
                        'data-path' => $this->Image->imageUrl($file),
                        'data-filename' => h($file->filename),
                        'data-filesize' => h($file->filesize),
                        'data-mimeType' => h($file->mime_type),
                        'data-created' => h($file->created)
                    ]
                );
            }
            ?>
        </div>
    </div>
</div>

<div class="modal fade modal-fullscreen" id="detailImage" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content h-100 border-0 shadow-0">
            <div class="modal-header">
                <h5 class="modal-title h2"><?= __d('panel', 'Detail Image') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-8 pr-5">
                        <img src="" id="imgFull" class="img-fluid border border-secondary" />
                    </div>
                    <div class="col-12 col-md-4">
                        <dl class="row border-bottom pb-4">
                            <dt class="col-md-4"><?= __d('panel', 'Filename') ?></dt>
                            <dd class="col-md-8 text-truncate" id="filename"></dd>
                            <dt class="col-md-4"><?= __d('panel', 'Mime Type') ?></dt>
                            <dd class="col-md-8 text-truncate" id="mimeType"></dd>
                            <dt class="col-md-4 text-truncate"><?= __d('panel', 'Date Created') ?></dt>
                            <dd class="col-md-8 text-truncate" id="created"></dd>
                            <dt class="col-md-4"><?= __d('panel', 'Filesize') ?></dt>
                            <dd class="col-md-8 text-truncate" id="filesize"></dd>
                        </dl>

                        <ul class="list-inline">
                            <li class="list-inline-item mr-4">
                                <?php
                                echo $this->Html->link(
                                    $this->Html->tag('i', '', ['class' => 'fal fa-copy mr-1']) . __d('panel', 'Copy URL'),
                                    '#',
                                    [
                                        'escape' => false,
                                        'id' => 'copy',
                                        'class' => 'text-info'
                                    ]
                                );
                                ?>
                            </li>
                            <li class="list-inline-item mr-4" id="delete">
                                <?php
                                echo $this->Form->postLink(
                                    $this->Html->tag('i', '', ['class' => 'fal fa-trash mr-1']) . __d('panel', 'Delete'),
                                    $this->Url->build(['action' => 'delete', 'FILE_ID']),
                                    [
                                        'id' => 'deleteLink',
                                        'class' => 'color-danger-900 mt-2 pr-2 mr-auto',
                                        'data-title' => __d('panel', 'Are you sure you want to delete the image?'),
                                        'data-message' => __d('panel', 'Deletion eliminates the possibility of data recovery.')
                                    ]
                                );
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
