<?php
declare(strict_types=1);

namespace App\Service;

use Cake\ORM\Locator\LocatorAwareTrait;

class PostsService
{
    use LocatorAwareTrait;

    public function viewed($slug, $checkAuth = null)
    {
        $post = $this->getTableLocator()->get('Posts')
            ->find('slugged', compact('slug'))
            ->contain(['PostCategories', 'Cover', 'MetaTags.Image', 'Tags']);

        if ($checkAuth === null) {
            $post->find('public');
        }

        $post = $post->firstOrFail();

        if ($checkAuth === null) {
            $post->set('viewed', $post->viewed + 1);
            $this->getTableLocator()->get('Posts')->save($post);
        }

        return $post;
    }
}