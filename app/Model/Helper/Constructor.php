<?php

namespace App\Model\Helper;

/**
 * Trait Constructor
 * @property $this array() fillable
 * @package namespace App\Munch\Api\V1\Model\Helper;
 */
trait Constructor
{
    /**
     * @var array
     */
    protected $entities = [];

    /**
     * @var array
     */
    protected $filterQueries = [];

    /**
     * @var array
     */
    protected $withQueries = [];

    /**
     * @var array
     */
    protected $selectQueries = [];

    /**
     * @var array
     */
    protected $baseQueries = [];

    /**
     * @var array
     */
    protected $sumQueries = [];

    /**
     * User_addon constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        if(app()->has('entities')){
            $entities = app()->get('entities');

            if(property_exists($this,'forbidden') && is_array($this->forbidden)){
                $this->fillable = array_diff($entities($this->table),$this->forbidden);
            }
            else{
                $this->fillable = $entities($this->table);
            }

            if(in_array('created_at',$this->fillable) || in_array('updated_at',$this->fillable)){
                $this->fillable = array_diff($this->fillable,['created_at','updated_at']);
            }

            $this->entities = $this->fillable;
        }

        if(property_exists($this,'relationWith') && is_array($this->relationWith) && count($this->relationWith) && httpMethod()=='get'){
            if(in_array('user_id',$this->fillable)){
                $this->relationWith['user'] = 'Include user data related with folder data.';
            }

            app()->register('illuminator','relations',$this->relationWith);

        }

        parent::__construct($attributes);

        $this->propertyHandle();
    }

    /**
     * property handle for model
     *
     * @return void
     */
    protected function propertyHandle()
    {
        $this->baseQueries();
        $this->withQueries();
        $this->selectQueries();
        $this->sumQueries();
        $this->filterQueries();
    }

    /**
     * with queries (eager loading) for model
     *
     * @return void
     */
    private function withQueries()
    {
        $with = (is_array($with = get('with'))) ? $with : [];

        $relations = app()->get('illuminator.relations');

        foreach ($with as $item){
            if(isset($relations[$item]) && method_exists($this,$item)){
                $this->withQueries[] = $item;
            }
        }
    }

    /**
     * select queries for model
     *
     * @return void
     */
    private function selectQueries()
    {
        $select = is_array($select = get('select')) ? $select : [];

        if(is_array($select) && count($select)){
            foreach ($select as $selectValue){
                if(in_array($selectValue,$this->fillable)){
                    $this->selectQueries[] = $selectValue;
                }
            }
        }
    }

    /**
     * filter queries for model
     *
     * @return void
     */
    private function filterQueries()
    {
        $this->filterQueries = (is_array($filter = get('filter'))) ? $filter : [];
    }

    /**
     * filter queries for model
     *
     * @return void
     */
    private function baseQueries()
    {
        $this->baseQueries = (is_array($query = get('query'))) ? $query : [];
    }

    /**
     * filter queries for model
     *
     * @return void
     */
    private function sumQueries()
    {
        $this->sumQueries = (is_array($query = get('sum'))) ? $query : [];
    }
}