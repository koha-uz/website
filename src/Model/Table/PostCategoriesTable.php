<?php
declare(strict_types=1);

namespace App\Model\Table;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostCategories Model
 *
 * @property \App\Model\Table\PostsTable&\Cake\ORM\Association\HasMany $Posts
 * 
 * @method \App\Model\Entity\PostCategory newEmptyEntity()
 * @method \App\Model\Entity\PostCategory newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PostCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\PostCategory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PostCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PostCategory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostCategory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostCategory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PostCategory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PostCategory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PostCategory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PostCategoriesTable extends Table
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

        $this->setTable('post_categories');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('Posts', [
            'foreignKey' => 'post_category_id',
        ]);

        $this->addBehavior('Meta.Meta');
        $this->addBehavior('Muffin/Slug.Slug');
        $this->addBehavior('Published.Published');

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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 180)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('body')
            ->allowEmptyString('body');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['slug']), ['errorField' => 'slug']);

        return $rules;
    }

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {

    }
}
