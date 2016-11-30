<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContentsTable Test Case
 */
class ContentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContentsTable
     */
    public $Contents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contents',
        'app.dlcategories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Contents') ? [] : ['className' => 'App\Model\Table\ContentsTable'];
        $this->Contents = TableRegistry::get('Contents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Contents);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
