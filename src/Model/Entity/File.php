<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Core\Configure;
use Cake\Log\Log;
use FileStorage\Model\Entity\FileStorage;

/**
 * File Entity
 *
 */
class File extends FileStorage
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected array $_accessible = [
        '*' => true
    ];

    protected array $_virtual = ['url'];

    protected function _getUrl()
    {
        switch ($this->adapter) {
            case 'AwsS3':
                return $this->getAwsS3Url($this->path);
            case 'Local':
                return $this->getLocalUrl($this->path);
            default:
                return null;
        }
    }

    /**
     * @param string $variant Variant
     *
     * @return string|null
     */
    public function getVariantUrl(string $variant): ?string
    {
        $variants = (array)$this->get('variants');
        if (!isset($variants[$variant]['path'])) {
            return null;
        } 

        switch ($this->adapter) {
            case 'AwsS3':
                return $this->getAwsS3Url($variants[$variant]['path']);
            case 'Local':
                return $this->getLocalUrl($variants[$variant]['path']);
            default:
                return null;
        }
    }

    private function getAwsS3Url($path): ?string
    {
        if ($this->adapter !== 'AwsS3') {
            return null;
        }

        return Configure::read('FileStorage.AwsS3.url') . '/' . ltrim($path);
    }

    private function getLocalUrl($path): ?string
    {
        if ($this->adapter !== 'Local') {
            return null;
        }

        return Configure::read('FileStorage.Local.assets') . ltrim($path);
    }
}
