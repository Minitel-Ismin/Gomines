<?php
use Migrations\AbstractMigration;

class DLCategory extends AbstractMigration
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
    	$table = $this->table('dlcategory');
    	
    	$table->addColumn("name","string");
    	$table->addColumn("color","string");
    	$table->addColumn("icon","string");
    	$table->create();
    }
}
