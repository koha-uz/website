<?php
declare(strict_types=1);

namespace App\Controller\Founder;

use App\Controller\AppController;
use Cake\Http\Exception\InternalErrorException;

/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 * @method \App\Model\Entity\Question[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $questions = $this->paginate($this->Questions);

        $this->set(compact('questions'));
    }

    /**
     * View method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => [],
        ]);

        if ($question->is_new) {
            $question->set('is_new', false);
            if (!$this->Questions->save($question)) {
                throw new InternalErrorException(__d('panel', 'Internal system error. Please check back later.'));
            }
        }

        $this->set(compact('question'));
    }

    public function confirm($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);

        $question = $this->Questions->findById($id)
            ->find('isNotCompleted')
            ->firstOrfail();

        $question->set('is_completed', true);
        if ($this->Questions->save($question)) {
            $this->Flash->success(__('The question has been completed.'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('The question could not be completed. Please, try again.'));
            return $this->redirect(['action' => 'view', $id]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Questions->get($id);
        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
