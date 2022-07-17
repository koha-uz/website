<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Cell\Founder;

use App\View\Cell\Founder\SettingsCell;
use Cake\TestSuite\TestCase;

/**
 * App\View\Cell\Founder\SettingsCell Test Case
 */
class SettingsCellTest extends TestCase
{
    /**
     * Request mock
     *
     * @var \Cake\Http\ServerRequest|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $request;

    /**
     * Response mock
     *
     * @var \Cake\Http\Response|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $response;

    /**
     * Test subject
     *
     * @var \App\View\Cell\Founder\SettingsCell
     */
    protected $Settings;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->request = $this->getMockBuilder('Cake\Http\ServerRequest')->getMock();
        $this->response = $this->getMockBuilder('Cake\Http\Response')->getMock();
        $this->Settings = new SettingsCell($this->request, $this->response);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Settings);

        parent::tearDown();
    }

    /**
     * Test display method
     *
     * @return void
     * @uses \App\View\Cell\Founder\SettingsCell::display()
     */
    public function testDisplay(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
