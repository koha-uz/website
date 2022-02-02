<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FaqCategories Model
 *
 * @property \App\Model\Table\FaqsTable&\Cake\ORM\Association\HasMany $Faqs
 *
 * @method \App\Model\Entity\FaqCategory newEmptyEntity()
 * @method \App\Model\Entity\FaqCategory newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\FaqCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FaqCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\FaqCategory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\FaqCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FaqCategory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FaqCategory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FaqCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FaqCategory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FaqCategory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\FaqCategory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FaqCategory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FaqCategoriesTable extends Table
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

        $this->setTable('faq_categories');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('Faqs', [
            'foreignKey' => 'faq_category_id',
        ]);

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'date_created' => 'new',
                    'date_modified' => 'always'
                ]
            ]
        ]);

        $this->addBehavior('Translate', ['fields' => ['title']]);
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

        return $validator;
    }

    public function findWithFaqs(Query $query, Array $options): Query
    {
        return $query
            ->innerJoinWith('Faqs', function($q) {
                return $q->find('published');
            })
            ->group($this->aliasField('id'))
            ->contain('Faqs');
    }
}
