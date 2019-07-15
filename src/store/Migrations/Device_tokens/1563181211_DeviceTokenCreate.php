<?php

use Migratio\Contract\MigrationContract;
use Migratio\Contract\WizardContract as Wizard;
use Migratio\Contract\SchemaCapsuleContract as Schema;

class DeviceTokenCreate implements MigrationContract
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
            $wizard->name('token')->varchar(255)->index();
            $wizard->name('token_integer')->int(14)->index();
            $wizard->name('device_hash')->longtext();
            $wizard->name('expire')->int()->index();

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
