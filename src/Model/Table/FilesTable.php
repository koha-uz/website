<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\EventInterface;
use Cake\ORM\Query\SelectQuery;
use FileStorage\Model\Table\FileStorageTable;
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

    public function beforeFind(EventInterface $event, SelectQuery $query, ArrayObject $options, $primary): void
    {
        $order = $query->clause('order');
        if ($order === null || !count($order)) {
            $query->orderBy([
                $this->aliasField('created') => 'DESC'
            ]);
        }
    }

    public function findFileModel(SelectQuery $query)
    {
        return $query->where([
            'Files.foreign_key IS' => null,
            'Files.model' => $this->getAlias()
        ]);
    }

    public function findOpenGraphModel(SelectQuery $query, $options)
    {
        return $query->where([
            'Files.foreign_key IS' => null,
            'Files.model' => FILE_OPENGRAPH_MODEL,
            'Files.mime_type LIKE' => 'image/%'
        ]);
    }

    public function findByType(SelectQuery $query, $type)
    {
        return $query
            ->where(['Files.mime_type LIKE' => $type . '/%']);
    }
}
