<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Faqs Model
 *
 * @property \App\Model\Table\ServicesTable&\Cake\ORM\Association\BelongsTo $Services
 *
 * @method \App\Model\Entity\Faq newEmptyEntity()
 * @method \App\Model\Entity\Faq newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Faq> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Faq get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Faq findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Faq patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Faq> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Faq|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Faq saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Faq>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Faq>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Faq>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Faq> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Faq>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Faq>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Faq>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Faq> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FaqsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('faqs');
        $this->setDisplayField('question');
        $this->setPrimaryKey('id');

        $this->belongsTo('Services', [
            'foreignKey' => 'service_id',
            'joinType' => 'INNER',
        ]);

        $this->addBehavior('Meta');
        $this->addBehavior('Muffin/Slug.Slug');
        $this->addBehavior('Published');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Translate');
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
            ->nonNegativeInteger('service_id')
            ->notEmptyString('service_id');

        $validator
            ->scalar('question')
            ->maxLength('question', 255)
            ->requirePresence('question', 'create')
            ->notEmptyString('question');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 180)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('answer')
            ->maxLength('answer', 4294967295)
            ->requirePresence('answer', 'create')
            ->notEmptyString('answer');

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
        $rules->add($rules->existsIn(['service_id'], 'Services'), ['errorField' => 'service_id']);

        return $rules;
    }

    public function findPublic(SelectQuery $query, Array $options)
    {
        return $query->find('published')
            ->innerJoinWith('Services', function ($q) {
                return $q->find('published');
            });
    }
}
