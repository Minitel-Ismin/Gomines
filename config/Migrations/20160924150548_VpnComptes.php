<?php
use Migrations\AbstractMigration;

class VpnComptes extends AbstractMigration
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
    	$table = $this->table('vpn_comptes');
    	$table->addColumn('user_id', 'integer');
    	$table->addColumn('common_name', 'string', [
    			'limit' => 50,
    			'null' => false,
    	]);
    	$table->addColumn('bp_used', 'integer', [
    			'default'=>0,
    			'limit' => 20,
    			'null' => false,
    	]);
    	$table->addColumn('bp_used_day', 'integer', [
    			'limit' => 20,
    			'null' => false,
    	]);
    	$table->addColumn('actif', 'integer', [
    			'default' => 0,
    			'limit' => 1,
    			'null' => false,
    	]);
    	$table->addColumn('cert', 'string', [
    			'default'=>null,
    			'limit' => 4000,
    			'null' => true,
    	]);
    	$table->addColumn('pkey', 'string', [
    			'default'=>null,
    			'limit' => 4000,
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
