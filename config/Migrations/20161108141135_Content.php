<?php
use Migrations\AbstractMigration;

class Content extends AbstractMigration
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
    	$table = $this->table('content');
    	$table->addColumn('name', 'string', [
    			'default' => null,
    			'limit' => 255,
    			//     			'null' => false,
    	]);
    	
    	$table->addColumn('path', 'string', [
    			'default' => null,
    			'limit' => 255,
    			//     			'null' => false,
    	]);
    	$table->addColumn('poster', 'string', [
    			'default' => null,
    			'limit' => 1024,
    			//     			'null' => false,
    	]);
    	
    	$table->addColumn('to_verify', 'boolean',[
    			'default' => true,
    	]);
    	$table->addColumn('category_id', 'integer', [
    			'default' => null,
    			'limit' => 11,
    	]);
    	$table->addColumn('size', 'integer', [
    			'default' => null,
    			'limit' => 11,
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
