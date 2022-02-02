<?php
declare(strict_types=1);

namespace Meta\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Table;

/**
 * Meta behavior
 */
class MetaBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * Initialize method
     *
     * @param array $config Configuration options
     * @return void
     */
    public function initialize(array $config): void
    {
        $this->_table->hasOne('MetaTags', [
            'className' => 'Meta.MetaTags',
            'foreignKey' => 'foreign_key',
            'conditions' => [
                'MetaTags.model' => $this->_table->getAlias()
            ],
            'cascadeCallbacks' => true,
            'dependent' => true
        ]);
    }

    /**
     * Before Save Callback
     *
     * @param Cake/Event/EventInterface $event The afterSave event that was fired.
     * @param Cake/Datasource/EntityInterface $entity The entity
     * @param ArrayObject $options Options
     * @return void
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        if (isset($entity->meta_tag) && $entity->meta_tag->isNew()) {
            $entity->meta_tag->set('model', $this->_table->getAlias());
        }
    }
}
