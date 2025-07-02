<ol class="breadcrumb page-breadcrumb">
    <?php
    $dashboardValue = $this->Html->link(__d('panel', 'Dashboard'), ['controller' => 'SystemicPages', 'action' => 'dashboard']);
    if (($this->request->getParam('controller') == 'SystemicPages') && ($this->request->getParam('action') == 'dashboard')) {
        $dashboardValue = __d('panel', 'Dashboard');
    }

    echo $this->Html->tag('li', $dashboardValue, ['class' => 'breadcrumb-item']);

    if (isset($breadcrumbs) && !empty($breadcrumbs)) {
        foreach($breadcrumbs as $breadcrumb) {
            $breadcrumbValue = $breadcrumb['title'];
            if (!empty($breadcrumb['url'])) {
                $breadcrumbValue = $this->Html->link($breadcrumb['title'], $breadcrumb['url']);
            }

            echo $this->Html->tag('li', $breadcrumbValue, ['class' => 'breadcrumb-item']);
        }
    }

    echo $this->Html->tag(
        'li',
        $this->Html->tag('span', '', ['class' => 'js-get-date']),
        ['class' => 'position-absolute pos-top pos-right d-none d-sm-block']
    );
    ?>
</ol>
