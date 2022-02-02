<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Burzum\FileStorage\Model\Table\FileStorageTable;
/**
 * Files Model
 *
 * @method \App\Model\Entity\File get($primaryKey, $options = [])
 * @method \App\Model\Entity\File newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\File[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\File|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\File|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\File patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\File[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\File findOrCreate($search, callable $callback = null, $options = [])
 */
class FilesTable extends FileStorageTable
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
    }

    public function beforeFind($event, $query, $options, $primary)
    {
        $order = $query->clause('order');
        if ($order === null || !count($order)) {
            $query->order([
                $this->aliasField('created') => 'DESC'
            ]);
        }
    }

    public function findCommon(Query $query, array $options)
    {
        return $query->where([
            'Files.foreign_key IS' => null,
            'Files.model' => 'file_storage'
        ]);
    }

    public function findByType(Query $query, array $options)
    {
        return $query
            ->where(['Files.mime_type LIKE' => $options['type'] . '/%']);
    }
}
