<?php
use Migrations\AbstractMigration;

class Update extends AbstractMigration
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
    	$table = $this->table('users');
//     	$table->addColumn('reset_password_token', 'string',[
//     			'default' => '',
//     			'null' => true,
//     	]);
    	$table->addColumn('token_created_at', 'datetime',[
    			 'default' => null,
            	'null' => false,
    	]);
    	$table->update();
    }
}
