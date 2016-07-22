<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FilmTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FilmTable Test Case
 */
class FilmTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FilmTable
     */
    public $Film;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.film'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Film') ? [] : ['className' => 'App\Model\Table\FilmTable'];
        $this->Film = TableRegistry::get('Film', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Film);

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
