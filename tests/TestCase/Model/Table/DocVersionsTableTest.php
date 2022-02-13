<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocVersionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocVersionsTable Test Case
 */
class DocVersionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocVersionsTable
     */
    protected $DocVersions;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocVersions',
        'app.Docs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DocVersions') ? [] : ['className' => DocVersionsTable::class];
        $this->DocVersions = $this->getTableLocator()->get('DocVersions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocVersions);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocVersionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DocVersionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
