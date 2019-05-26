<?php

namespace Store\Packages\Search\ElasticSearch;

use Elasticsearch\ClientBuilder as Search;

class ElasticSearch
{
    /**
     * @var string
     */
    protected $client;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $search;

    /**
     * ElasticSearch constructor.
     */
    public function __construct()
    {
        $config = config('elasticsearch.hosts');
        $this->client = Search::create()->setHosts($config)->build();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function ping($data=array())
    {
        return $this->client->ping($data);
    }

    /**
     * @param array $data
     * @return array
     */
    public function health($data=array())
    {
        return $this->client->cat()->health($data);
    }

    /**
     * @return array
     */
    public function getNodeStats()
    {
        return $this->client->nodes()->stats();
    }

    /**
     * @return array
     */
    public function getIndexStats()
    {
        return $this->client->indices()->stats();
    }

    /**
     * @return array
     */
    public function getClusterStats()
    {
        return $this->client->cluster()->stats();
    }

    /**
     * @param array $params
     * @return array
     */
    public function getAll($params=array())
    {
        return $this->client->indices()->getMapping($params);
    }

    /**
     * @param array $params
     * @return array
     */
    public function getSource($params=array())
    {
        return $this->client->getSource($params);
    }

    /**
     * @param null $index
     * @return array
     */
    public function deleteIndex($index=null)
    {
        return $this->client->indices()->delete(['index'=>$index]);
    }

    /**
     * @param null $index
     * @return bool
     */
    public function indexExists($index=null)
    {
        return $this->client->indices()->exists(['index'=>$index]);
    }

    /**
     * @param null $index
     * @return array
     */
    public function indexCreate($index=null)
    {
        return $this->client->indices()->create(['index'=>$index]);
    }

    /**
     * @param null $index
     * @param null $type
     * @return bool
     */
    public function existsType($index=null,$type=null)
    {
        return $this->client->indices()->existsType(['index'=>$index,'type'=>$type]);
    }

    /**
     * @param array $data
     * @return array
     */
    public function setMap($data=array())
    {
        if(!array_key_exists("settings",$data)){
            $settings=[
                'number_of_shards' => 1,
                'number_of_replicas' =>0
            ];
        }
        else{
            $settings=$data['settings'];
        }
        $params = [
            'index' => $data['index'],
            'body' => [
                'settings' => $settings,
                'mappings' => [
                    $data['type'] => [
                        '_source' => [
                            'enabled' => true
                        ],
                        'properties' => $data['properties']
                    ]
                ]
            ]
        ];
        // Create the index with mappings and settings now
        return $this->client->indices()->create($params);
    }


    /**
     * @param array $data
     * @return array
     */
    public function create($data=array())
    {
        $params = [
            'index' => config('elasticsearch.index'),
            'type' =>$this->type,
            'id' =>$data['id'],
            'body' =>$data
        ];
        // Document will be indexed to my_index/my_type/my_id
        return $this->client->create($params);
    }

    /**
     * @param $match
     * @param array $fields
     * @return $this
     */
    public function search($match,$fields=array())
    {

        $matchFields = config('elasticsearch.'.$this->type.'.fields');

        if(count($fields)){
            $matchFields = $fields;
        }

        $params = [
            'index' => config('elasticsearch.index'),
            'type' => $this->type,
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $match,
                        'type'=>'best_fields',
                        'fields'=>$matchFields,
                        'tie_breaker'=>'0.2',
                        'minimum_should_match'=>'10%',
                        'slop'=>'10'
                    ]
                ]
            ]
        ];

        $this->search=$this->client->search($params);
        return $this;
    }

    /**
     * @return mixed
     */
    public function count()
    {
        return $this->search['hits']['total'];
    }

    /**
     * @return mixed
     */
    public function score()
    {
        return $this->search['hits']['max_score'];
    }

    /**
     * @return mixed
     */
    public function get()
    {
        $sources = $this->search['hits']['hits'];
        
        $list=[];

        foreach ($sources as $key=>$source) {

            $list[$key]['id'] = $source['_id'];
            $list[$key]['score'] = $source['_score'];
            foreach ($source['_source'] as $resourceKey=>$resource){
                $list[$key][$resourceKey] = $resource;
            }
        }

        return $list;
    }

    /**
     * @param $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;
        return $this;

    }

}

