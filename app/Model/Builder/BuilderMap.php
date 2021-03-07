<?php

namespace App\Munch\Api\V1\Model\Builder;

class BuilderMap
{ 
    /**
     * Order_cancel Builder Instance
     * 
     * @return Order_cancelBuilder
     */
    public function order_cancel()
    {
        return new Order_cancelBuilder();
    }
             
    /**
     * User Builder Instance
     * 
     * @return UserBuilder
     */
    public function user()
    {
        return new UserBuilder();
    }
             
    /**
     * Tableevent Builder Instance
     * 
     * @return TableeventBuilder
     */
    public function tableevent()
    {
        return new TableeventBuilder();
    }
             
    /**
     * Role Builder Instance
     * 
     * @return RoleBuilder
     */
    public function role()
    {
        return new RoleBuilder();
    }
             
    /**
     * Permission Builder Instance
     * 
     * @return PermissionBuilder
     */
    public function permission()
    {
        return new PermissionBuilder();
    }
             
    /**
     * Permission_name Builder Instance
     * 
     * @return Permission_nameBuilder
     */
    public function permission_name()
    {
        return new Permission_nameBuilder();
    }
             
    /**
     * Language Builder Instance
     * 
     * @return LanguageBuilder
     */
    public function language()
    {
        return new LanguageBuilder();
    }
             
    /**
     * Device_token Builder Instance
     * 
     * @return Device_tokenBuilder
     */
    public function device_token()
    {
        return new Device_tokenBuilder();
    }
             
    /**
     * Order Builder Instance
     * 
     * @return OrderBuilder
     */
    public function order()
    {
        return new OrderBuilder();
    }
             
    /**
     * Migration Builder Instance
     * 
     * @return MigrationBuilder
     */
    public function migration()
    {
        return new MigrationBuilder();
    }
            

}