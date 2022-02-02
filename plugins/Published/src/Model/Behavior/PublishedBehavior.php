<?php
namespace Published\Model\Behavior;

use Cake\ORM\Query;
use Cake\ORM\Behavior;
use Cake\ORM\Table;
use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\I18n\Time;

/**
 * Published behavior
 */
class PublishedBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'implementedMethods' => [
            'changePublished' => 'changePublished',
            'incrementViewCount' => 'incrementViewCount'
        ],
        'implementedFinders' => [
            'published' => 'findPublished',
            'byDatePublished' => 'findByDatePublished'
        ]
    ];

    /**
     * Before Save Callback
     *
     * @param Cake/Event/Event $event The afterSave event that was fired.
     * @param Cake/ORM/Entity $entity The entity
     * @param ArrayObject $options Options
     * @return void
     */
    public function beforeSave(Event $event, Entity $entity, ArrayObject $options)
    {
        if ($entity->isDirty('published')) {
            $entity->date_published = $entity->published ? new Time() : null;
        }
    }

    public function findPublished(Query $query, Array $options)
    {
        return $query->where([
            $this->_table->aliasField('published') => true
        ]);
    }

    public function findByDatePublished(Query $query, Array $options)
    {
        return $query->where([
            'DATE(' . $this->_table->aliasField('date_published') . ')' => $options['date']
        ]);
    }

    public function changePublished($entity)
    {
        $entity->published = $entity->published ? false : true;

        return $this->_table->save($entity);
    }

    public function incrementViewCount($entity)
    {
        $view_count = is_int($entity->view_count) ? $entity->view_count : 0;
        $view_count++;

        $entity->set('view_count', $view_count);
        return $this->_table->save($entity);
    }
}
