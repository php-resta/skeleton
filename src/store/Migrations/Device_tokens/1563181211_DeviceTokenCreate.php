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
            $wizard->name('user_id')->int()->index();
            $wizard->name('token')->varchar(255)->unique();
            $wizard->name('token_integer')->bigint(20)->index();
            $wizard->name('device_agent')->longtext();
            $wizard->name('device_agent_integer')->bigint(20)->index();
            $wizard->name('expire')->int();

            $wizard->name('created_at')->timestamp();
            $wizard->name('updated_at')->timestamp();

            $wizard->table()->indexes('device_integers',['token_integer','device_agent_integer']);

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
