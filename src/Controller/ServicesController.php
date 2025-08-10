<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Services Controller
 *
 * @property \App\Model\Table\ServicesTable $Services
 * @method \App\Model\Entity\Service[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ServicesController extends AppController
{
    public function view($slug)
    {
        $service = $this->Services->find('slugged', ['slug' => $slug])
            ->contain(['MetaTags'])
            ->firstOrFail();

        $this->set(compact('service'));
    }
}
