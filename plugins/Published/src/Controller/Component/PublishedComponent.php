<?php
namespace Published\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * Published component
 */
class PublishedComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    protected $table;
    protected $controller;

    public $components = ['Flash'];

    public function initialize(array $config): void
    {
    }

    /**
     * setPublished method
     *
     * @param int|null $id Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function setPublished($id = null)
    {
        $this->getController()->getRequest()->allowMethod(['post']);

        $table = $this->getController()->loadModel();
        $item = $table->get($id);

        if ($table->changePublished($item)) {
            $this->Flash->success(__d('published', 'Publish mode replaced successfully'));
        } else {
            $this->Flash->error(__d('published', 'Failed to change publish mode. Please try again.'));
        }

        return $this->getController()->redirect(
            $this->getController()->referer(['controller' => 'SystemicPages', 'action' => 'dashboard'], true)
        );
    }
}
