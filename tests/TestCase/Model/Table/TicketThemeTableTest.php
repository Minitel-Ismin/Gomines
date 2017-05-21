<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TicketThemeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TicketThemeTable Test Case
 */
class TicketThemeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TicketThemeTable
     */
    public $TicketTheme;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ticket_theme',
        'app.ticket',
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
        $config = TableRegistry::exists('TicketTheme') ? [] : ['className' => 'App\Model\Table\TicketThemeTable'];
        $this->TicketTheme = TableRegistry::get('TicketTheme', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TicketTheme);

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
