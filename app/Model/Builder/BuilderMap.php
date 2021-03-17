<?php

namespace App\Model\Builder;

class BuilderMap
{ 
    /**
     * User Builder Instance
     * 
     * @return UserBuilder
     */
    public function user(): UserBuilder
    {
        return new UserBuilder();
    }
             
    /**
     * Migration Builder Instance
     * 
     * @return MigrationBuilder
     */
    public function migration(): MigrationBuilder
    {
        return new MigrationBuilder();
    }
            

}