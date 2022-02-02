<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * I18nMessages Model
 *
 * @method \App\Model\Entity\I18nMessage newEmptyEntity()
 * @method \App\Model\Entity\I18nMessage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\I18nMessage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\I18nMessage get($primaryKey, $options = [])
 * @method \App\Model\Entity\I18nMessage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\I18nMessage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\I18nMessage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\I18nMessage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\I18nMessage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\I18nMessage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\I18nMessage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\I18nMessage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\I18nMessage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class I18nMessagesTable extends Table
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

        $this->setTable('i18n_messages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Nullable');
    }

    public function findDomains(Query $query, Array $options): Query
    {
        return $query
            ->select([$this->aliasField('domain')])
            ->group([$this->aliasField('domain')]);
    }
}
