<?php
use Migrations\AbstractMigration;

class UpdateContent1 extends AbstractMigration
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
    	$table->addColumn('sub_folder', 'boolean',[
    			'default' => false,
    	]);
    	 
    	$table->addColumn('folder_id', 'integer', [
    			'default' => null,
    			'limit' => 11,
    			'null' => true,
    	]);
    	 
    	$table->update();
    }
}
