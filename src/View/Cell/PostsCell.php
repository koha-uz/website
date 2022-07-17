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
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->loadModel('Posts');
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
        $posts = $this->Posts->find('public')
            ->order(['Posts.viewed' => 'desc'])
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
        $posts = $this->Posts->find('public')
            ->where([
                'Posts.id !=' => $post->id,
                'Posts.post_category_id' => $post->post_category_id
            ])
            ->contain(['Cover'])
            ->limit(4)
            ->toArray();

        $this->set('posts', $posts);
    }

    public function tags()
    {
        $taggeds = $this->Posts->Tagged->find('cloud')
            ->toArray();

        $this->set('taggeds', $taggeds);
    }
}
