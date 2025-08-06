<?php
declare(strict_types=1);

namespace App\Service\Admin;

use Cake\ORM\Locator\LocatorAwareTrait;

class PostsService
{
    use LocatorAwareTrait;

    public function create($post, $data)
    {
        $this->getTableLocator()->get('Posts')->patchEntity($post, $data,
            ['associated' => ['Cover', 'MetaTags', 'Tags']]
        );

        if ($post->getErrors()) {
            return false;
        }

        if ($this->getTableLocator()->get('Posts')->save($post)) {
            return true;
        }

        return false;
    }
}