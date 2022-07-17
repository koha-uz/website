<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Services cell
 */
class ServicesCell extends Cell
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
        $this->loadModel('Services');
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
    }

    public function navList()
    {
        $services = $this->Services->find()
            ->toArray();

        $this->set('services', $services);
    }
}
