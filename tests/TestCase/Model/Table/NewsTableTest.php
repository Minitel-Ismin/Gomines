<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NewsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NewsTable Test Case
 */
class NewsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NewsTable
     */
    public $News;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.news',
        'app.users',
        'app.vpn_comptes',
        'app.vpn_historique'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('News') ? [] : ['className' => 'App\Model\Table\NewsTable'];
        $this->News = TableRegistry::get('News', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->News);

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
