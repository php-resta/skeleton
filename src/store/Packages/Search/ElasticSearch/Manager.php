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

    public function documents($index)
    {
        $params = [
            'index' => $index,
            //'type' => $this->type,
            'body' => [
                'query' => [
                    'match_all' => []
                ]
            ],
            'size' => 1000
        ];

        $this->search = $this->client->search($params);
        return $this->get();
    }

    /**
     * @param mixed ...$params
     * @return array
     */
    public function update(...$params)
    {
        $currentParams = current($params);

        [$index,$value,$data] = $currentParams;

        $params = [
            'index' => $index,
            'id' => $value,
            'body' => [
                'doc' => $data
            ]
        ];

       try{
           return $this->client->update($params);
       }
       catch (\Exception $exception){
           return null;
       }
    }

    /**
     * @param mixed ...$params
     * @return bool|void
     */
    public function exists(...$params)
    {
        [$index,$key,$value] = current($params);

        $params = [
            'index' => $index,
            'body'  => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'term' => [
                                    $key => $value
                                ]
                            ]
                        ]
                    ]
                ]
            ]
            ];

        try {
            $result = $this->client->search($params);

            if(isset($result['hits']['total']['value'])){
                $value = $result['hits']['total']['value'];
                if($value=='0'){
                    return false;
                }

                return true;
            }

        } catch (\Exception $e) {
            return false;
        }

    }

    /**
     * @param array $params
     * @return $this
     */
    public function search(...$params)
    {
        $currentParams = current($params);

        $points = 0;

        if(isset($currentParams[4])){
            $points = $currentParams[4];
        }

        if(isset($currentParams[3])){
            [$index,$fields,$match,$where] = current($params);

            $page = get('page',1);
            $from = $page-1;

            $params = [
                'from' => $from,
                'size' => config('app.pagination'),
                'index' => $index,
                //'type' => $this->type,
                'body' => [
                    'query' => [
                        'bool' => [
                            'filter' => [
                                'term' => $where
                            ],
                            'must' => [
                                'bool' => [
                                    'should' => [
                                        [
                                            'multi_match' => [
                                                'query' => $match,
                                                'fields'=>$fields,
                                                'fuzziness' => "AUTO:1,5",
                                            ]
                                        ],
                                        [
                                            'bool' => [
                                                'should' => [
                                                    'wildcard' => [
                                                        'category_name' => [
                                                            'value' => '*piz*',
                                                            'boost' => 1
                                                        ]

                                                    ]
                                                ]
                                            ]
                                        ],
                                        [
                                            'bool' => [
                                                'should' => [
                                                    'wildcard' => [
                                                        'menu_item_name' => [
                                                            'value' => '*piz*',
                                                            'boost' => 1
                                                        ]

                                                    ]
                                                ]
                                            ]
                                        ]

                                    ]
                                ]
                            ]
                        ],

                    ]
                ]
            ];
        }



        $this->search = $this->client->search($params);

        return $this->get($points);
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
    public function get($points)
    {
        $sources = $this->search['hits']['hits'];
        
        $list=[];

        foreach ($sources as $key=>$source) {

            if($source['_score']>$points){
                $list[$key]['id'] = $source['_id'];
                $list[$key]['score'] = $source['_score'];
                foreach ($source['_source'] as $resourceKey=>$resource){
                    $list[$key][$resourceKey] = $resource;
                }
            }

        }

        if(count($sources)=='0'){
            return [];
        }

        if(count($list)){
            return $list;
        }

        return $this->get(0);
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

