<?php
use Migrations\AbstractMigration;

class Ticket extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
    	$table = $this->table('ticket');
    	
    	$table->addColumn("asker","string", [
    			'default' => null,
    			'limit' => 255,
    			'null' => true,
    	]);
    	$table->addColumn("user_id", "integer", [
    			'default' => null,
    			'limit' => 11,
    			'null' => true,
    	]);
    	$table->addColumn("theme","string", [
    			'default' => null,
    			'limit' => 255,
    			'null' => true,
    	]);
    	$table->addColumn("question", "string", [
    			'default' => null,
    			'limit' => 255,
    			'null' => true,
    	]);
    	
    	$table->addColumn("theme_id", "string", [
    			'default' => null,
    			'limit' => 255,
    			'null' => true,
    	]);
    	
    	$table->addColumn('created', 'datetime', [
    			'default' => null,
    			'null' => false,
    	]);
    	$table->addColumn('modified', 'datetime', [
    			'default' => null,
    			'null' => false,
    	]);
    	$table->create();
    }
}
