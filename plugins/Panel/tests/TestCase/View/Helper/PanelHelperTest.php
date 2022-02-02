<?php
declare(strict_types=1);

namespace Panel\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Panel\View\Helper\PanelHelper;

/**
 * Panel\View\Helper\PanelHelper Test Case
 */
class PanelHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Panel\View\Helper\PanelHelper
     */
    protected $Panel;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Panel = new PanelHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Panel);

        parent::tearDown();
    }
}
