<?php

namespace App\Model\Builder;

use Exception;
use App\Model\User;
use Resta\Contracts\ClientContract;
use App\Model\Contract\UserContract;
use App\Model\Builder\Assistant\Builder;

class UserBuilder implements UserContract
{
    use Builder;

    /**
     * get model name property
     *
     * @var User
     */
    protected static $model = User::class;

    /**
     * get all data for Migration model
     *
     * @return mixed
     */
    public function all()
    {
        //model all data
        return static::$model::all();
    }

    /**
     * create Migration model
     *
     * @param ClientContract $client
     * @return void|mixed
     */
    public function create(ClientContract $client)
    {
        //create User
        try{
            return static::$model::create($client->all());

        }
        catch (Exception $exception){
            exception('database_'.$exception->getCode(),['key'=>'migration_code:'.$client->input('migration_code')])
                ->invalidArgument(mysqlErrorColumn($exception->getPrevious()));
        }
    }


    /**
     * check if entity is available for model
     *
     * @param null $value
     * @param string $field
     * @return bool
     */
    public function exist($value=null,$field='id') : bool
    {
        $query = $this->find($value,$field);

        return is_array($query) && count($query);
    }

    /**
     * get Migration find method for model
     *
     * @param null|string $value
     * @param string $field
     * @param array $select
     * @return mixed
     */
    public function find($value=null,$field='id',$select=['*'])
    {
        //model find data
        return static::$model::select($select)->where($field,$value)->get()->toArray();
    }

    /**
     * get Migration model
     *
     * @return mixed
     */
    public function get()
    {
        //model all data
        return static::$model::pagination();
    }

    /**
     * update Migration model
     *
     * @param ClientContract $client
     * @param bool $createIfNotExist
     * @return mixed|void
     */
    public function update(ClientContract $client,$createIfNotExist=false)
    {
        //
    }
}

