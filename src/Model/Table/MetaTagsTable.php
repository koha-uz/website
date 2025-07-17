<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MetaTags Model
 *
 * @method \App\Model\Entity\MetaTag newEmptyEntity()
 * @method \App\Model\Entity\MetaTag newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaTag> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MetaTag get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MetaTag findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MetaTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MetaTag> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MetaTag|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MetaTag saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MetaTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaTag>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaTag> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaTag>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MetaTag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MetaTag> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MetaTagsTable extends Table
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

        $this->setTable('meta_tags');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Translate', [
            'strategyClass' => \Cake\ORM\Behavior\Translate\EavStrategy::class,
            'fields' => ['title', 'description', 'og_title', 'og_description', 'og_image_url'],
        ]);
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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('og_title')
            ->maxLength('og_title', 255)
            ->requirePresence('og_title', 'create')
            ->notEmptyString('og_title');

        $validator
            ->scalar('og_description')
            ->maxLength('og_description', 255)
            ->requirePresence('og_description', 'create')
            ->notEmptyString('og_description');

        return $validator;
    }
}
