<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Posts cell
 */
class PostsCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected array $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {

    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
    }

    public function popular($post = null)
    {
        $posts = $this->fetchTable('Posts')->find('public')
            ->orderBy(['Posts.viewed' => 'desc'])
            ->contain(['Cover'])
            ->limit(3);

        if (null !== $post) {
            $posts->where([
                'Posts.id !=' => $post->id
            ]);
        }

        $this->set('posts', $posts->toArray());
    }

    public function samePostCategory($post)
    {
        $posts = $this->fetchTable('Posts')->find('public')
            ->where([
                'Posts.id !=' => $post->id,
                'Posts.post_category_id' => $post->post_category_id
            ])
            ->contain(['Cover'])
            ->limit(4)
            ->toArray();

        $this->set('posts', $posts);
    }

    public function last()
    {
        $posts = $this->fetchTable('Posts')->find('public')
            ->contain(['Cover', 'PostCategories'])
            ->orderBy(['Posts.date_published' => 'desc'])
            ->limit(4)
            ->toArray();

        $this->set('posts', $posts);
    }

    public function tags()
    {
        $taggeds = $this->fetchTable('Posts')->Tagged->find('cloud')
            ->toArray();

        $this->set('taggeds', $taggeds);
    }
}
