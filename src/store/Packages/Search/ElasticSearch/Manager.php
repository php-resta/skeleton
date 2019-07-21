<?php

namespace Store\Packages\Search\ElasticSearch;

use Elasticsearch\ClientBuilder as Search;

class Manager
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
     * @param array $connections
     */
    public function __construct($connections=array())
    {
        $this->client = Search::create()->setHosts($connections)->build();

    }

    /**
     * @param null $index
     * @return array
     */
    public function allDatabases()
    {
        return $this->client->indices()->get(['index'=>'*']);
    }

    /**
     * @param null $index
     * @return array
     */
    public function createDatabase($index=null)
    {
        return $this->client->indices()->create(['index'=>$index]);
    }

    /**
     * @param null $index
     * @return array
     */
    public function deleteDatabase($index=null)
    {
        return $this->client->indices()->delete(['index'=>$index]);
    }

    /**
     * @param null $index
     * @return bool
     */
    public function existDatabase($index=null)
    {
        return $this->client->indices()->exists(['index'=>$index]);
    }

    /**
     * @param array $params
     * @return bool
     */
    public function ping($params=array())
    {
        return $this->client->ping($params);
    }

    /**
     * @param array $params
     * @return array
     */
    public function health($params=array())
    {
        return $this->client->cat()->health($params);
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
     * @param array $params
     * @return mixed
     */
    public function createFields(...$params)
    {
        [$index,$fields] = current($params);

        if(!array_key_exists("settings",$fields)){
            $settings=[
                'number_of_shards' => 1,
                'number_of_replicas' =>0
            ];
        }
        else{
            $settings = $fields['settings'];
        }

        $params = [
            'index' => $index,
            'body' => [
                'settings' => $settings,
                'mappings' => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => $fields
                ]
            ]
        ];


        // Create the index with mappings and settings now
        return $this->client->indices()->create($params);
    }


    /**
     * @param array $params
     * @return mixed
     */
    public function insert(...$params)
    {
        [$index,$data] = current($params);

        $params = [
            'index' => $index,
            //'type' =>$this->type,
            'id' => $data['id'],
            'body' => $data
        ];
        // Document will be indexed to my_index/my_type/my_id
        return $this->client->create($params);
    }

    /**
     * @param array $params
     * @return $this
     */
    public function search(...$params)
    {
        [$index,$fields,$match] = current($params);

        $params = [
            'index' => $index,
            //'type' => $this->type,
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $match,
                        'fields'=>$fields,
                        'fuzziness' => "AUTO",
                    ]
                ]
            ]
        ];

        $this->search = $this->client->search($params);
        return $this->get();
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

