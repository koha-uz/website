<?php
declare(strict_types=1);

namespace Panel\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use App\Model\Entity\PhoneNumber;

/**
 * PhoneNumbers helper
 */
class PhoneNumbersHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public $helpers = ['Url', 'Html', 'Form'];

    public function createFields($key, PhoneNumber $entity = null)
    {
        $id = '';
        if (null !== $entity) {
            $id = $this->Form->control('phone_numbers.' . $key . '.id', [
                'type' => 'hidden'
            ]);
        }

        return '<div class="row">' . $id .
            '<div class="col-md-12 col-lg-10">' .
                '<div class="row">' .
                    '<div class="col-7">' .
                        $this->Form->control("phone_numbers.{$key}.phone", [
                            'label' => ['class' => 'sr-only'],
                            'type' => 'text',
                            'data-inputmask' => "'mask': '+|9|9 (999) 999-99-99', 'escapeChar': '|'",
                            'class' => 'form-control form-control-sm',
                            'placeholder' => __d('panel', 'Phone number')
                        ]) .
                    '</div>' .
                    '<div class="col-5">' .
                        $this->Form->control("phone_numbers.{$key}.prefix", [
                            'label' => ['class' => 'sr-only'],
                            'data-inputmask' => "'mask': '999999'",
                            'class' => 'form-control form-control-sm',
                            'placeholder' => __d('panel', 'Prefix')
                        ]) .
                    '</div>' .
                    '<div class="col-12 mt-1">' .
                        $this->Form->control("phone_numbers.{$key}.target", [
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

    public function default(PhoneNumber $phoneNumber = null)
    {
        if (null === $phoneNumber) {
            return;
        }

        $str = '+' . mb_substr($phoneNumber->phone, 0, 3) . ' (' .
            mb_substr($phoneNumber->phone, 3, 2) . ') ' .
            mb_substr($phoneNumber->phone, 5, 3) . '-' .
            mb_substr($phoneNumber->phone, 8, 2) . '-' .
            mb_substr($phoneNumber->phone, 10, 2);

        if (!empty($phoneNumber->prefix)) {
            $str = $str . ' (' . __d('panel', 'ext.') . ' ' . h($phoneNumber->prefix) . ')';
        }

        return $str;
    }

    public function link(PhoneNumber $phoneNumber)
    {
        return $this->Html->link(
            $this->Html->tag('i', '', ['class' => 'fal fa-phone-rotary mr-2']) .
            $this->default($phoneNumber),
            'tel:' . $this->default($phoneNumber),
            ['escape' => false, 'class' => 'mt-1 d-block fs-sm fw-400 text-dark']
        );
    }

    public function defaultList(Array $phoneNumbers = [])
    {
        if (empty($phoneNumbers)) {
            return;
        }

        $items = [];
        foreach($phoneNumbers as $phoneNumber) {
            $items[] = $this->default($phoneNumber);
        }

        return $this->Html->nestedList($items, ['class' => 'list-unstyled mb-0']);
    }
}
