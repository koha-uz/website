<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Http\ServerRequest;

/**
 * SystemicPages Model
 *
 * @property \App\Model\Table\MetaTagsTable&\Cake\ORM\Association\HasMany $MetaTags
 *
 * @method \App\Model\Entity\SystemicPage get($primaryKey, $options = [])
 * @method \App\Model\Entity\SystemicPage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SystemicPage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SystemicPage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SystemicPage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SystemicPage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SystemicPage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SystemicPage findOrCreate($search, callable $callback = null, $options = [])
 */
class SystemicPagesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('systemic_pages');
        $this->setDisplayField('short_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Meta.Meta');
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'date_created' => 'new',
                    'date_modified' => 'always'
                ]
            ]
        ]);
        $this->addBehavior('Translate', ['fields' => ['title', 'body']]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('short_name')
            ->maxLength('short_name', 45)
            ->requirePresence('short_name', 'create')
            ->notEmptyString('short_name');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('body')
            ->notEmptyString('body');

        return $validator;
    }

    public function beforeSave(Event $event, Entity $entity, ArrayObject $options)
    {

    }

    public function findWithoutAssociations(Query $query, Array $options)
    {
        return $query->where([
                'SystemicPages.foreign_key IS' => null,
                'SystemicPages.model IS' => null
            ]);
    }

    public function findByNotation(Query $query, Array $options)
    {
        return $query->where([
            $this->aliasField('notation') => $options['notation']
        ]);
    }
}
