<?php if ($this->Paginator->total() > 1): ?>
    <?php $this->append('meta', $this->Paginator->meta()); ?>
    <nav class="d-flex" aria-label="pagination">
        <ul class="pagination">
            <?= $this->Paginator->prev(__d('frontend', 'Previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__d('frontend', 'Next')) ?>
        </ul>
        <!-- /.pagination -->
    </nav>
    <!-- /nav -->
<?php endif; ?>