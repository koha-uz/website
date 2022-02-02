<?php
declare(strict_types=1);

namespace Meta\Model\Table;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Validation\Validation;

/**
 * MetaTags Model
 *
 * @method \Meta\Model\Entity\MetaTag get($primaryKey, $options = [])
 * @method \Meta\Model\Entity\MetaTag newEntity($data = null, array $options = [])
 * @method \Meta\Model\Entity\MetaTag[] newEntities(array $data, array $options = [])
 * @method \Meta\Model\Entity\MetaTag|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Meta\Model\Entity\MetaTag saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Meta\Model\Entity\MetaTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Meta\Model\Entity\MetaTag[] patchEntities($entities, array $data, array $options = [])
 * @method \Meta\Model\Entity\MetaTag findOrCreate($search, callable $callback = null, $options = [])
 */
class MetaTagsTable extends Table
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

        $this->setTable('meta_tags');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasOne('ImageBg', [
            'className' => 'Burzum/FileStorage.FileStorage',
            'foreignKey' => 'foreign_key',
            'conditions' => ['ImageBg.model' => 'OpenGraphImageBg'],
            'cascadeCallbacks' => true,
            'dependent' => true
        ]);

        $this->hasOne('Image', [
            'className' => 'Burzum/FileStorage.FileStorage',
            'foreignKey' => 'foreign_key',
            'conditions' => ['Image.model' => 'OpenGraphImage'],
            'cascadeCallbacks' => true,
            'dependent' => true
        ]);


        $this->addBehavior('Meta.Image');
        $this->addBehavior('Translate', ['fields' => ['title', 'description', 'og_title', 'og_description']]);
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
            ->uuid('id')
            ->allowEmptyString('id', null, 'create');

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

        $validator
            ->requirePresence('image_type', true)
            ->add('image_type', 'list', [
                'rule' => ['inList', [1, 2]],
                'message' => __d('meta', 'Incorrect image type selection')
            ]);

        $validator
            ->add('generate_image_type', 'require', [
                'rule' => function ($value, $context) {
                    if ($context['data']['image_type'] == 2) {
                        return true;
                    }
                    return false;
                },
                'message' => __d('meta', 'No generated image type selected')
            ])
            ->add('generate_image_type', 'list', [
                'rule' => ['inList', [1, 2]],
                'message' => __d('meta', 'Incorrect selection of the type of generated image')
            ]);

        /*$validator
            ->allowEmptyFile('image_bg.file')
            ->add('image_bg.file', 'mimeType', [
                'rule' => ['mimeType', ['image/jpeg', 'image/png']],
                'message' => __d('meta', 'Image mime type must be PNG or JPG'),
                'last' => true,
            ])
            ->add('image_bg.file', 'width', [
                'rule' => ['imageWidth', Validation::COMPARE_SAME, 1200],
                'message' => __d('meta', 'Image must be 1200 pixels wide')
            ])
            ->add('image_bg.file', 'height', [
                'rule' => ['imageHeight', Validation::COMPARE_SAME, 630],
                'message' => __d('meta', 'Image must be 630 pixels high')
            ]);*/

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
        $rules->add(function ($entity, $options) {
            if (
                ($entity->generate_image_type == 2)
                && empty($entity->image_bg->file['tmp_name'])
                && null === $entity->image
            ) {
                return false;
            }
            return true;
        }, [
            'errorField' => 'app_image_bg',
            'message' => __d('meta', 'Background image required')
        ]);

        return $rules;
    }
}
