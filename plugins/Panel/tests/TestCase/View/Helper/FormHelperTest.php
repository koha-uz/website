<?php
declare(strict_types=1);

namespace Panel\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Panel\View\Helper\FormHelper;

/**
 * Panel\View\Helper\FormHelper Test Case
 */
class FormHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Panel\View\Helper\FormHelper
     */
    protected $Form;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Form = new FormHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Form);

        parent::tearDown();
    }
}
