<?php
declare(strict_types=1);

namespace Panel\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Panel\View\Helper\PhoneNumbersHelper;

/**
 * Panel\View\Helper\PhoneNumbersHelper Test Case
 */
class PhoneNumbersHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Panel\View\Helper\PhoneNumbersHelper
     */
    protected $PhoneNumbers;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->PhoneNumbers = new PhoneNumbersHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PhoneNumbers);

        parent::tearDown();
    }
}
