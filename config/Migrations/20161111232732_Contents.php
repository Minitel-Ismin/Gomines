<?php
use Migrations\AbstractMigration;

class Contents extends AbstractMigration
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
    	$table = $this->table('contents');
    	$table->addColumn('name', 'string', [
    			'default' => null,
    			'limit' => 255,
    			'null' => true,
    	]);
    	 
    	$table->addColumn('path', 'string', [
    			'default' => null,
    			'limit' => 255,
    			'null' => true,
    	]);
    	 
    	$table->addColumn('to_verify', 'boolean',[
    			'default' => true,
    	]);
    	$table->addColumn('sub_folder', 'boolean',[
    			'default' => false,
    	]);
    	$table->addColumn('folder_id', 'integer', [
    			'default' => null,
    			'limit' => 11,
    			'null' => true,
    	]);
    	$table->addColumn('dlcategory_id', 'integer', [
    			'default' => null,
    			'limit' => 11,
    			'null' => true,
    	]);
    	$table->addColumn('size', 'integer', [
    			'default' => null,
    			'limit' => 11,
    			'null' => true,
    	]);
    	 
    	 
    	$table->addColumn('created', 'datetime', [
    			'default' => null,
    			'null' => false,
    			'null' => true,
    	]);
    	$table->addColumn('modified', 'datetime', [
    			'default' => null,
    			'null' => false,
    			'null' => true,
    	]);
    	$table->create();
    }
}
