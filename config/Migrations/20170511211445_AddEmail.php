<?php
use Migrations\AbstractMigration;

class AddEmail extends AbstractMigration
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
    	$table->addColumn('email', "string", [
    			'default' => null,
    			'limit' => 255,
    			'null' => true,
    	]);
    	$table->update();
    }
}
