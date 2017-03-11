<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DlcategoryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DlcategoryTable Test Case
 */
class DlcategoryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DlcategoryTable
     */
    public $Dlcategory;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dlcategory'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Dlcategory') ? [] : ['className' => 'App\Model\Table\DlcategoryTable'];
        $this->Dlcategory = TableRegistry::get('Dlcategory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dlcategory);

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
