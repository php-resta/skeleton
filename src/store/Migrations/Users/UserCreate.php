<?php

use Migratio\Contract\MigrationContract;
use Migratio\Contract\WizardContract as Wizard;
use Migratio\Contract\SchemaCapsuleContract as Schema;

class UserCreate implements MigrationContract
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
            $wizard->name('username')->varchar(255)->unique();
            $wizard->name('password')->varchar(255)->index();
            $wizard->name('email')->varchar(255)->unique();
            $wizard->name('status')->int()->index();
            $wizard->name('token')->varchar(255)->index();
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
