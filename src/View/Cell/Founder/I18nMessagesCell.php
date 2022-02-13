<?php
declare(strict_types=1);

namespace App\View\Cell\Founder;

use Cake\View\Cell;

/**
 * I18nMessages cell
 */
class I18nMessagesCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->loadModel('I18nMessages');
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display(): void
    {
    }

    /**
     * Domain list method.
     *
     * @return void
     */
    public function domainListMenu($menu): void
    {
        $domains = $this->I18nMessages
            ->find('domains')
            ->toList();

        $this->set(compact('domains', 'menu'));
    }
}
