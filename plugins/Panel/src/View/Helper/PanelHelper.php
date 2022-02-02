<?php
declare(strict_types=1);

namespace Panel\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Panel helper
 */
class PanelHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public $helpers = ['Html'];

    public function boolIcon($status)
    {
        $class = 'fal fa-ban text-danger';
        if ($status) {
            $class = 'fal fa-check text-success';
        }

        return $this->Html->tag('i', '', ['class' => $class]);
    }

    public function notSet($value)
    {
        if ((null === $value) || (gettype($value) == 'string' && $value == '')) {
            return $this->Html->tag('span', __d('panel', 'Not set'), ['class' => 'text-warning']);
        }
        return $value;
    }
}
