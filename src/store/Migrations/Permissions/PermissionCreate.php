<?php

use Migratio\Contract\MigrationContract;
use Migratio\Contract\WizardContract as Wizard;
use Migratio\Contract\SchemaCapsuleContract as Schema;

class PermissionCreate implements MigrationContract
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
            $wizard->name('name_code')->int()->index();
            $wizard->name('route_name')->varchar(255)->index();
            $wizard->name('role_id')->int()->index();

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
