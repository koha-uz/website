<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true"><i class="fal fa-times"></i></span>
    </button>
    <strong><?= __d('panel', 'Error!') ?></strong> <?= $message ?>
</div>
