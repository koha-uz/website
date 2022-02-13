<?php
use Cake\Core\Configure;
use Cake\Utility\Inflector;
?>

<?php if (!empty($domains)): ?>
<li class="<?php if (isset($menu['i18n_messages'])) echo 'active open'; ?>">
    <?php
    echo $this->Html->link(
        $this->Html->tag('i', '', ['class' => 'fal fa-lg fa-fw fa-flag']) .
        $this->Html->tag('span', __d('panel', 'I18n messages'), ['class' => 'nav-link-text']),
        '#',
        ['escape' => false, 'title' => __d('panel', 'I18n messages'), 'data-filter-tags' => __d('panel', 'i18n messages')]
    );
    ?>
    <ul>
        <?php foreach($domains as $domain): ?>
        <li <?php if (isset($menu['i18n_messages'][$domain->domain])) echo 'class="active"'; ?>>
            <?php
            echo $this->Html->link(
                $this->Html->tag('span', Inflector::camelize($domain->domain), ['class' => 'nav-link-text']),
                '#',
                ['escape' => false, 'title' => Inflector::camelize($domain->domain), 'data-filter-tags' => $domain->domain]
            );
            ?>
            <?php $locales = Configure::read('I18n.languages'); ?>

            <?php if (!empty($locales)): ?>
            <ul>
                <?php foreach($locales as $locale): ?>
                <li <?php if (isset($menu['i18n_messages'][$domain->domain][$locale])) echo 'class="active"'; ?>>
                    <?php
                    echo $this->Html->link(
                        $this->Html->tag('span', Inflector::humanize($locale), ['class' => 'nav-link-text']),
                        ['controller' => 'I18nMessages', 'action' => 'edit', 'domain' => $domain->domain, 'locale' => $locale],
                        ['escape' => false, 'title' => __d('panel', 'Documents'), 'data-filter-tags' => __d('panel', 'documents')]
                    );
                    ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
</li>
<?php endif; ?>
