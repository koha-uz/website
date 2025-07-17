<?php
declare(strict_types=1);

namespace Frontend\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Frontend\View\Helper\TemplateHelper;

/**
 * Frontend\View\Helper\TemplateHelper Test Case
 */
class TemplateHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Frontend\View\Helper\TemplateHelper
     */
    protected $Template;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Template = new TemplateHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Template);

        parent::tearDown();
    }
}
