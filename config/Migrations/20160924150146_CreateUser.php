<?php
use Migrations\AbstractMigration;

class CreateUser extends AbstractMigration
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
        
        $table->addColumn('nom', 'string', [
        		'limit' => 30,
        		     			'null' => false,
        ]);
        $table->addColumn('prenom', 'string', [
        		'limit' => 30,
        		'null' => false,
        ]);
        $table->addColumn('email', 'string', [
        		'limit' => 100,
        		'null' => false,
        ]);
        $table->addColumn('password', 'string', [
        		'limit' => 100,
        		'null' => false,
        ]);
        $table->addColumn('droits', 'integer', [
        		'default' => 0,
        		'limit' => 11,
        		'null' => false,
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
