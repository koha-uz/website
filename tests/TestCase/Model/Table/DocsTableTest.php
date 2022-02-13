<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocsTable Test Case
 */
class DocsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocsTable
     */
    protected $Docs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Docs',
        'app.DocVersions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Docs') ? [] : ['className' => DocsTable::class];
        $this->Docs = $this->getTableLocator()->get('Docs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Docs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DocsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
