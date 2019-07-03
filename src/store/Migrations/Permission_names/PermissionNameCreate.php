<?php

use Migratio\Contract\MigrationContract;
use Migratio\Contract\WizardContract as Wizard;
use Migratio\Contract\SchemaCapsuleContract as Schema;

class PermissionNameCreate implements MigrationContract
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
            $wizard->auto_increment();
            $wizard->name('code')->int()->index();
            $wizard->name('name')->longtext();
            $wizard->name('lang')->int()->index()->default(1);

            $wizard->name('created_at')->dateTime();
            $wizard->name('updated_at')->dateTime();

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
