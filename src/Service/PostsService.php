<?php
declare(strict_types=1);

namespace App\Service;

use Cake\ORM\Locator\LocatorAwareTrait;

class PostsService
{
    use LocatorAwareTrait;

    public function viewed($slug)
    {
        $post = $this->getTableLocator()->get('Posts')
            ->find('slugged', compact('slug'))
            ->find('public')
            ->contain(['PostCategories', 'Cover', 'MetaTags.Image', 'Tags'])
            ->firstOrFail();

        $post->set('viewed', $post->viewed + 1);
        $this->getTableLocator()->get('Posts')->save($post);

        return $post;
    }
}