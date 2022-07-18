<?php if (isset($breadcrumbs) && !empty($breadcrumbs)): ?>
<nav class="d-inline-block" aria-label="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
    <ol class="breadcrumb mb-1 fs-sm">
        <?php
        foreach($breadcrumbs as $key => $breadcrumb) {
            if (empty($breadcrumb['url'])) {
                echo $this->Html->tag('li', $breadcrumb['title'], [
                    'class' => 'breadcrumb-item active text-muted',
                    'aria-current' => 'page'
                ]);
            } else {
                echo $this->Html->tag('li',
                    $this->Html->link(
                        $this->Html->tag('span', $breadcrumb['title'],
                            ['itemprop' => 'name']
                        ),
                        $breadcrumb['url'],
                        [
                            'title' => $breadcrumb['title'],
                            'itemtype' => 'https://schema.org/Thing',
                            'itemprop' => 'item',
                            'escape' => false
                        ]
                    ) .
                    $this->Html->meta(['itemprop' => 'position', 'content' => $key + 1]),
                    [
                        'class' => 'breadcrumb-item',
                        'itemprop' => 'itemListElement',
                        'itemscope',
                        'itemtype' => 'https://schema.org/ListItem'
                    ]
                );
            }
        }
        ?>
    </ol>
</nav>
<?php endif; ?>