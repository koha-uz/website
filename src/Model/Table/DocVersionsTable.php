<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DocVersions Model
 *
 * @property \App\Model\Table\DocsTable&\Cake\ORM\Association\BelongsTo $Docs
 *
 * @method \App\Model\Entity\DocVersion newEmptyEntity()
 * @method \App\Model\Entity\DocVersion newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DocVersion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DocVersion get($primaryKey, $options = [])
 * @method \App\Model\Entity\DocVersion findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DocVersion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DocVersion[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DocVersion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocVersion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DocVersion[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocVersion[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocVersion[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DocVersion[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DocVersionsTable extends Table
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

        $this->setTable('doc_versions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Docs', [
            'foreignKey' => 'doc_id',
            'joinType' => 'INNER',
        ]);

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'date_created' => 'new',
                    'date_modified' => 'always',
                ]
            ]
        ]);
        $this->addBehavior('Translate', ['fields' => ['body', 'url']]);
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
            ->nonNegativeInteger('version')
            ->requirePresence('version', 'create')
            ->notEmptyString('version');

        $validator
            ->scalar('body')
            ->allowEmptyString('body');

        $validator
            ->boolean('is_current')
            ->requirePresence('is_current', 'create')
            ->notEmptyString('is_current');

        $validator
            ->dateTime('date_approved')
            ->requirePresence('date_approved', 'create')
            ->notEmptyDateTime('date_approved');

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
        $rules->add($rules->existsIn('doc_id', 'Docs'), ['errorField' => 'doc_id']);

        return $rules;
    }
}
