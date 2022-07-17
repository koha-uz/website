<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * PostCategories Controller
 *
 * @property \App\Model\Table\PostCategoriesTable $PostCategories
 * @method \App\Model\Entity\AdCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostCategoriesController extends AppController
{
    /**
     * View method
     *
     * @param string|null $slug Post Category slug.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $postCategory = $this->PostCategories
            ->find('published')
            ->find('slugged', compact('slug'))
            ->contain('MetaTags.Image')
            ->contain('Posts', function ($q) {
                return $q->find('published')
                    ->contain(['PostCategories', 'Cover']);
            });

        $this->set(compact('postCategory'));
    }
}
