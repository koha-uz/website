<?php
declare(strict_types=1);

namespace Meta\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Meta\GenerateImage\Image;

/**
 * Image behavior
 */
class ImageBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        if ($entity->generate_image_type == 2 && !empty($entity->image_bg->file['tmp_name'])) {
            $entity->image_bg->set('model', 'OpenGraphImageBg');
        }

        /**
         * При выборе базового типа изображения или удаления сущности meta_tag,
         * действия по формированию изображения Open Graph игнорируются.
         */
        if (!$entity->has('image_type') || $entity->image_type == 1) {
            return;
        }

        if ($entity->isNew()) {
            $this->_createImage($entity);
        } else {
            // Обновление сущности meta_tag, в которой выбран тип генерируемого изображения на цветном фоне
            if ($entity->generate_image_type == 1) {
                /**
                 * Проверка (null === $entity->image) - Переход от базового изображения к изображению на цветном фоне
                 * Проверка (null !== $entity->image_bg) - Переход от изображения на фоне картинки к изображению на цветном фоне
                 * Проверка ($entity->extractOriginalChanged(['og_title'])) - Изменение свойства og_title
                */
                if ((null === $entity->image) || (null !== $entity->image_bg) || $entity->extractOriginalChanged(['og_title'])) {
                    $this->_createImage($entity);
                }
                return;
            }

            // Обновление сущности meta_tag, в которой выбран тип генерируемого изображения на фоне картинки
            if ($entity->generate_image_type == 2) {
                /**
                 * Проверка (null === $entity->image) - Переход от базового изображения к изображению на фоне картинки
                 * Проверка (null === $entity->image_bg->id) - Переход от изображения на цветном фоне к изображению на фоне картинки
                */
                if ((null === $entity->image) || (null === $entity->image_bg->id)) {
                    $this->_createImage($entity);
                    return;
                }

                // Смена фонового изображения
                if (!empty($entity->image_bg->file['tmp_name'])) {
                    $this->_changeImageBgProperty($entity);
                    $this->_createImage($entity);
                    return;
                }

                // Обновление свойства og_title
                if ($entity->extractOriginalChanged(['og_title'])) {
                    $this->_createImage($entity);
                }

                return;
            }
        }
    }

    public function afterSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        // Удаление изображения из временной директории /tmp/og_images
        if (isset($entity->image->file) && !empty($entity->image->file['tmp_name'])) {
            $this->_deleteTmpFile($entity->image->file['tmp_name']);
        }

        if (!$entity->isNew()) {
            /**
             * Если выбран базовый тип изображения, необходимо удалить (если существуют)
             * OpenGrpah изображение и фоновое изображение
             */
            if ($entity->image_type == 1) {
                if (null !== $entity->image) {
                    $this->_table->Image->delete($entity->image);
                }
                if (null !== $entity->image_bg) {
                    $this->_table->ImageBg->delete($entity->image_bg);
                }
                return;
            }

            /**
             * Если выбран тип генерируемого изображения на цветном фоне, необходимо
             * удалить (если существует) фоновое изображение
             */
            if ($entity->generate_image_type == 1) {
                if (null !== $entity->image_bg) {
                    $this->_table->ImageBg->delete($entity->image_bg);
                }
                return;
            }
        }
    }

    private function _createImage($entity)
    {
        $bgPath = null;
        if (($entity->generate_image_type == 2)) {
            if (!empty($entity->image_bg->file['tmp_name'])) {
                $bgPath = $entity->image_bg->file['tmp_name'];
            } elseif ((null !== $entity->image_bg->id)) {
                $bgPath = FILE_STORAGE . $entity->image_bg->path;
            }
        }
        $image = new Image($entity->og_title, $bgPath);

        $imagePath = TMP_OG_IMAGES . md5($entity->model . $entity->foreign_key) . '.png';
        if ($image->save($imagePath)) {
            $this->_addImageProperty($entity, $imagePath);
        }
    }

    private function _addImageProperty($entity, $imagePath)
    {
        $file = new File($imagePath);

        $data = [
            'file' => [
                'tmp_name' => $imagePath,
                'error' => 0,
                'name' => $file->name,
                'type' => $file->mime(),
                'size' => $file->size()
            ],
            'model' => 'OpenGraphImage'
        ];

        if (isset($entity->image->old_file_id) && !empty($entity->image->old_file_id)) {
            $data['old_file_id'] = $entity->image->old_file_id;
        }

        $imageEntity = $this->_table->Image->newEmptyEntity();
        $imageEntity = $this->_table->Image->patchEntity($imageEntity, $data);

        $entity->set('image', $imageEntity);

        return $this;
    }

    private function _changeImageBgProperty($entity)
    {
        $data = [
            'file' => $entity->image_bg->file,
            'old_file_id' => $entity->image_bg->old_file_id
        ];

        $imageBgEntity = $this->_table->ImageBg->newEmptyEntity();
        $imageBgEntity = $this->_table->ImageBg->patchEntity($imageBgEntity, $data);

        $entity->set('image_bg', $imageBgEntity);

        return $this;
    }

    private function _deleteTmpFile($file)
    {
        return (new File($file))->delete();
    }
}
