<?php

namespace App\Munch\Api\V1\Model\Builder;

use Throwable;
use Exception;
use Store\Services\DB;
use App\Munch\Api\V1\Model\Role;
use Resta\Contracts\ClientContract;
use App\Munch\Api\V1\Model\Contract\RoleContract;
use App\Munch\Api\V1\Model\Builder\Assistant\Builder;
use Illuminate\Database\ConnectionInterface;

class RoleBuilder implements RoleContract
{
    use Builder;

    /**
     * get model name property
     *
     * @var Role
     */
    protected static $model = Role::class;

    /**
     * get all data for Role model
     *
     * @return mixed
     */
    public function all()
    {
        //model all data
        return Role::all();
    }

    /**
     * create Role model
     *
     * @param ClientContract $client
     * @return void|mixed
     */
    public function create(ClientContract $client)
    {
        //create User
        try{
            return $this->UniqueEntityForIsDeleted($client,function() use($client){
                return static::$model::create($client->all());
            });

            }
            catch (Exception $exception){
                exception('database_'.$exception->getCode(),['key'=>'role_code:'.$client->input('role_code')])
                    ->invalidArgument(mysqlErrorColumn($exception->getPrevious()));
            }
        }

    /**
     * createIfNotExist method for update method
     *
     * @param $data
     * @return Role|void
     */
    public function createIfNotExist($data)
    {
        //create Role
        try{
            $data = static::$model::where('role_code',$data)->first();

            if(is_null($data)){
                return static::$model::create(['role_code'=>$data]);
            }

            return $data;
        }
        catch (Exception $exception){
            exception('database_'.$exception->getCode())
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
    public function exist($value=null,$field='id')
    {
        $query = $this->find($value,$field);

        return (is_array($query) && count($query)) ? true :false;
    }

    /**
     * get Role find method for model
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
     * get Role model
     *
     * @return mixed
     */
    public function get()
    {
        //model all data
        return static::$model::pagination();
    }

     /**
      * update Role model
      *
      * @param ClientContract $client
      * @param bool $createIfNotExist
      * @return mixed|void
      */
     public function update(ClientContract $client,$createIfNotExist=false)
     {
        if($createIfNotExist){
            $data = $this->createIfNotExist($client->input('field'));
        }

        if(!isset($data)){
            $data = static::$model::where('role_code',$client->input('role_code'))->first();
        }

        nullExceptionPointer($data,'role_code:'.$client->input('role_code'));

        foreach ($client->all() as $input=>$item){
            if(in_array($input,$data->getFillable())){
                $data->{$input} = (is_array($item)) ? json_encode($item) : $item;
            }
        }

        try{
            $data->save();
            return static::$model::where('role_code',$client->input('role_code'))->first();
        }catch (Exception $e){
                 exception('database_'.$e->getCode(),['key'=>$client->input('role_code')])
                     ->invalidArgument($e->getMessage());
        }
     }

     /**
      * update array for Role model
      *
      * @param ClientContract $client
      * @param ConnectionInterface $connection
      * @return mixed
      *
      * @throws Throwable
      */
     public function updateArray(ClientContract $client,ConnectionInterface $connection)
     {
        $clientArray = clientArray($client,'role_code');

        if(count($clientArray)){
            return $connection->transaction(function() use($client,$clientArray){

                $result = [];
                foreach ($clientArray as $data){
                    $counter = 0;
                    foreach ($data as $input=>$value){
                        $counter++;
                        $client->set($input,$value);

                        if(count($data)==$counter){
                            $result[] = $this->update($client);
                        }
                    }
                }

                return $result;
            });
        }

        return null;
     }


     /**
      *
      * @param ClientContract $client
      * @param callable $callable
      * @return mixed|void
      */
     private function UniqueEntityForIsDeleted(ClientContract $client,callable $callable)
     {
        $uniques = (array)DB::uniques(app()->resolve(static::$model)->getTable());

        foreach ($uniques as $unique){

            $uniqueEntityForIsDeleted = static::$model::where(function($query) use($client,$unique){

                foreach ($unique as $uniqueValue){
                    $query->where($uniqueValue,$client->input($uniqueValue));
                }

            })->get()->toArray();

            if(is_array($uniqueEntityForIsDeleted) && count($uniqueEntityForIsDeleted)){

                $data = $uniqueEntityForIsDeleted[0];
                if($data['is_deleted']=='1'){
                    foreach ($data as $dataKey=>$dataValue){
                        $client->set($dataKey,$dataValue);
                    }
                    $client->set('is_deleted','0');
                    return $this->update($client);
                }
            }
        }

        return call_user_func($callable);
     }
}

