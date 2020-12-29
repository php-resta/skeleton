<?php

use Migratio\Contract\MigrationContract;
use Migratio\Contract\WizardContract as Wizard;
use Migratio\Contract\SchemaCapsuleContract as Schema;

class TableEvent implements MigrationContract
{
    /**
     * Run the migrations.
     *
     * @param Schema $schema
     * @return mixed
     */
    public function up(Schema $schema)
    {
        return $schema->create(function(Wizard $wizard){

            $wizard->name('id')->int(14)->auto_increment();
            $wizard->name('table_name')->varchar(255)->index();
            $wizard->name('table_field')->varchar(255)->index();
            $wizard->name('old_value')->longtext();
            $wizard->name('new_value')->longtext();
            $wizard->name('event_name')->varchar(255)->index();
            $wizard->name('client_ip')->bigint(20)->index();
            $wizard->name('auth_id')->int(11)->index();
            $wizard->name('created_at')->timestamp();
            $wizard->table()->collation('utf8');
        

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
