<?php
namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\I18n\DateTime;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\Behavior;
use Cake\ORM\Table;

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
    protected array $_defaultConfig = [
        'implementedMethods' => [
            'changePublished' => 'changePublished',
            'incrementViewCount' => 'incrementViewCount'
        ],
        'implementedFinders' => [
            'published' => 'findPublished',
            'byDatePublished' => 'findByDatePublished'
        ]
    ];


    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        if ($entity->isDirty('is_published')) {
            $entity->published = $entity->is_published ? new DateTime() : null;
        }
    }

    public function findPublished(SelectQuery $query, $options)
    {
        return $query->where([
            $this->_table->aliasField('is_published') => true
        ]);
    }

    public function findByDatePublished(SelectQuery $query, $options)
    {
        return $query->where([
            'DATE(' . $this->_table->aliasField('published') . ')' => $options['date']
        ]);
    }

    public function changePublished($entity)
    {
        $entity->is_published = $entity->is_published ? false : true;

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