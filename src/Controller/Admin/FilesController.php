<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 *
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Ajax.Ajax', [
            'actions' => ['add', 'addOpenGraph', 'addPostCover']
        ]);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $files = $this->Files->find();
        $this->set('files', $files);
    }

    public function images()
    {
        $files = $this->Files
            ->find('fileModel')
            ->find('byType', ['type' => 'image']);

        $this->set('files', $files);
    }

    public function documents()
    {
        $files = $this->Files
            ->find('fileModel')
            ->find('byType', ['type' => 'application']);

        $this->set('files', $files);
    }

    public function videos()
    {
        $files = $this->Files
            ->find('fileModel')
            ->find('byType', ['type' => 'video']);

        $this->set('files', $files);
    }

    public function openGraph()
    {
        $files = $this->Files->find('openGraphModel');

        $this->set('files', $files);
    }

    public function postCover()
    {
        $files = $this->Files->find('postCoverModel');

        $this->set('files', $files);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $file = $this->Files->newEmptyEntity();
        if ($this->request->is('post')) {
            $file = $this->Files->patchEntity($file, $this->request->getData());

            $file->set('model', FILE_FILE_MODEL);
            $file->set('collection', FILE_FILE_MODEL);
            if ($this->Files->save($file)) {
                $this->Flash->success(__d('panel', 'The file has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__d('panel', 'The file could not be saved. Please, try again.'));
        }
        $this->set(compact('file'));
    }

    /**
     * AddOpenGraph method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addOpenGraph()
    {
        $file = $this->Files->newEmptyEntity();
        if ($this->request->is('post')) {
            $file = $this->Files->patchEntity($file, $this->request->getData());

            $file->set('model', FILE_OPENGRAPH_MODEL);
            $file->set('collection', FILE_OPENGRAPH_MODEL);
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The OpenGraph image has been saved.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The OpenGraph image could not be saved. Please, try again.'));
        }
        $this->set(compact('file'));
    }

    /**
     * AddPostCover method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addPostCover()
    {
        $file = $this->Files->newEmptyEntity();
        if ($this->request->is('post')) {
            $file = $this->Files->patchEntity($file, $this->request->getData());

            $file->set('model', FILE_POST_COVER_MODEL);
            $file->set('collection', FILE_POST_COVER_MODEL);
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The post cover has been saved.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The post cover could not be saved. Please, try again.'));
        }
        $this->set(compact('file'));
    }

    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);
        if ($this->Files->delete($file)) {
            $this->Flash->success(__d('panel', 'The file has been deleted.'));
        } else {
            $this->Flash->error(__d('panel', 'The file could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
}
