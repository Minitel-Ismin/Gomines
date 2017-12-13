<?php
use Migrations\AbstractMigration;

class AddRateDwnlNbr extends AbstractMigration
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
        $table->addColumn('download_nbr', "integer", [
            'default' => 0,
            'limit' => 11,
        ]);

        $table->addColumn('rate', "decimal", [
            'default' => 0,
            'limit' => 11,
            'precision' => 2,
            'scale' => 1
        ]);

        $table->update();
    }
}
