<?php
declare(strict_types=1);

namespace Panel\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use App\Model\Entity\EmailAddress;

/**
 * EmailAddresses helper
 */
class EmailAddressesHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public $helpers = ['Url', 'Html', 'Form'];

    public function createFields($key, EmailAddress $entity = null)
    {
        $id = '';
        if (null !== $entity) {
            $id = $this->Form->control('email_addresses.' . $key . '.id', [
                'type' => 'hidden'
            ]);
        }

        return '<div class="row">' . $id .
            '<div class="col-md-12 col-lg-10">' .
                '<div class="row">' .
                    '<div class="col-12">' .
                        $this->Form->control("email_addresses.{$key}.email", [
                            'label' => ['class' => 'sr-only'],
                            'type' => 'text',
                            'data-inputmask' => "'alias': 'email'",
                            'class' => 'form-control form-control-sm',
                            'placeholder' => __d('panel', 'Email address')
                        ]) .
                    '</div>' .
                    '<div class="col-12 mt-1">' .
                        $this->Form->control("email_addresses.{$key}.target", [
                            'label' => ['class' => 'sr-only'],
                            'type' => 'textarea',
                            'rows' => 1,
                            'class' => 'form-control form-control-sm',
                            'placeholder' => __d('panel', 'Target')
                        ]) .
                    '</div>' .
                '</div>' .
            '</div>' .
            '<div class="col-md-12 col-lg-2 text-center">' .
                '<a href="javascript:void(0);" class="remove mt-2 mt-lg-0 btn btn-outline-danger btn-icon rounded-circle waves-effect waves-themed">' .
                    '<i class="fal fa-times"></i>' .
                '</a>' .
            '</div>' .
            '<div class="col-12"><hr/></div>' .
        '</div>';
    }

    public function link(EmailAddress $emailAddress)
    {
        return $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fal fa-envelope mr-2']) .
            h($emailAddress->email),
            'mailto:' . h($emailAddress->email),
            ['escape' => false, 'class' => 'mt-1 d-block fs-sm fw-400 text-dark']
        );
    }

    public function defaultList(Array $emailAddresses = [])
    {
        if (empty($emailAddresses)) {
            return;
        }

        $items = [];
        foreach($emailAddresses as $emailAddress) {
            $items[] = $emailAddress->email;
        }

        return $this->Html->nestedList($items, ['class' => 'list-unstyled']);
    }
}
