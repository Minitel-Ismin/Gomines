<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FoldersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FoldersTable Test Case
 */
class FoldersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FoldersTable
     */
    public $Folders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.folders'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Folders') ? [] : ['className' => 'App\Model\Table\FoldersTable'];
        $this->Folders = TableRegistry::get('Folders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Folders);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
