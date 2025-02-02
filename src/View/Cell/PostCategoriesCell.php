<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * PostCategories cell
 */
class PostCategoriesCell extends Cell
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
        $this->loadModel('PostCategories');
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $postCategories = $this->PostCategories->find('published')
            ->contain('Posts', function ($q) {
                return $q->find('published');
            })
            ->toArray();

        $this->set('postCategories', $postCategories);
    }
}
