<?php
declare(strict_types=1);

namespace Panel\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Panel\View\Helper\EmailAddressesHelper;

/**
 * Panel\View\Helper\EmailAddressesHelper Test Case
 */
class EmailAddressesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Panel\View\Helper\EmailAddressesHelper
     */
    protected $EmailAddresses;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->EmailAddresses = new EmailAddressesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->EmailAddresses);

        parent::tearDown();
    }
}
