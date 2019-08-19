<?php

use Migratio\Contract\MigrationContract;
use Migratio\Contract\WizardContract as Wizard;
use Migratio\Contract\SchemaCapsuleContract as Schema;

class MigrationCreate implements MigrationContract
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

            $wizard->auto_increment();
            $wizard->name('table_name')->text()->index();
            $wizard->name('name')->text()->index();

            $wizard->name('created_at')->timestamp();
            $wizard->name('updated_at')->timestamp();

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
