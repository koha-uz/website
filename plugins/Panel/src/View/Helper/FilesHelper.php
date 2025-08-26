<?php
namespace Panel\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Files helper
 */
class FilesHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected array $_defaultConfig = [];

    public function fileSizeConvert($bytes)
    {
        $bytes = floatval($bytes);
        $items = [
            ['unit' => __d('admin', 'Tb'), 'value' => pow(1024, 4)],
            ['unit' => __d('admin', 'Gb'), 'value' => pow(1024, 3)],
            ['unit' => __d('admin', 'Mb'), 'value' => pow(1024, 2)],
            ['unit' => __d('admin', 'Kb'), 'value' => 1024],
            ['unit' => __d('admin', 'b'), 'value' => 1]
        ];

        foreach($items as $item) {
            if($bytes >= $item['value']) {
                $result = $bytes / $item['value'];
                $result = str_replace('.', ',' , strval(round($result, 2))) . ' ' . $item['unit'];
                break;
            }
        }

        return $result;
    }
}
