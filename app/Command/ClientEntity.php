<?php

namespace App\Command;

use Store\Services\DB;
use App\Munch\Api\V1\Client\Client;
use Resta\Console\ConsoleOutputter;
use Resta\Support\Generator\Generator;
use Resta\Console\ConsoleListAccessor;
use Resta\Exception\FileNotFoundException;
use App\Munch\Api\V1\ServiceAnnotationsManager;

class ClientEntity extends ConsoleOutputter
{
    use ConsoleListAccessor,ServiceAnnotationsManager,Client;

    /**
     * @var $type
     */
    protected $type = 'ClientEntity';

    /**
     * @var null|string
     */
    protected $entityPath;

    /**
     * @var array
     */
    protected $runnableMethods = [
        'handle' => 'ClientEntity  handle'
    ];

    /**
     * @var array
     */
    protected $nonFields = ['id','created_at','updated_at'];

    /**
     * @var $commandRule array
     */
    protected $commandRule = [];

    /**
     * @method handle
     *
     * @throws FileNotFoundException
     */
    public function handle()
    {
        if(isset($this->argument['table'])){
            $table = strtolower($this->argument['table']);

            $tableFields = DB::fieldTypes($table);

            $entityPath = path()->version().''.DIRECTORY_SEPARATOR.'Client'.DIRECTORY_SEPARATOR.'Entities';

            if(!file_exists($entityPath)){
                files()->makeDirectory($entityPath);
            }

            $this->entityPath = $entityPath.''.DIRECTORY_SEPARATOR.''.ucfirst($table).'.php';

            $fieldList = [];

            if(file_exists($this->entityPath)){
                foreach ($tableFields as $field=>$type){
                    $fieldList[$field]['methodContent'] = ltrim($this->entityMethodContent($field));
                    $fieldList[$field]['methodRule'] = ltrim($this->entityRuleContent($field));
                }
            }

            $generator = new Generator($entityPath,$table);
            $generator->createClass();

            foreach ($tableFields as $field=>$type){

                if(!method_exists($this,$field) and !in_array($field,$this->nonFields)){

                    $generator->createMethod([$field]);
                    $generator->createMethodAccessibleProperty([$field=>'protected']);
                    $generator->createClassProperty([
                        'protected $'.$field.';'
                    ]);

                    if(isset($fieldList[$field]['methodContent'])
                        &&
                        $fieldList[$field]['methodContent']!==''
                    ){
                        $generator->createMethodBody([
                            $field => $fieldList[$field]['methodContent']
                        ]);
                    }
                    else{
                        $generator->createMethodBody([
                            $field => 'return $this->'.$field.';'
                        ]);
                    }

                    $rule = ($type=='string') ? 'dontStartSpace' : $type;

                    if($type=='datetime'){
                        $rule = 'dontStartSpace:datetime';
                    }

                    if(isset($fieldList[$field]['methodRule']) && $fieldList[$field]['methodRule']!==''){
                        $rule = $fieldList[$field]['methodRule'];
                    }

                    $generator->createMethodDocument([
                        $field => [
                            ''.$field.' for request input',
                            '',
                            '@rule('.$rule.')',
                            '@return '.$type
                        ]
                    ]);
                }

            }

            files()->change($entityPath.''.DIRECTORY_SEPARATOR.''.$this->argument['table'].'.php',[
                'class '.$this->argument['table'].'' => 'trait '.$this->argument['table'].''
            ]);
        }
    }

    /**
     * get entity file content
     *
     * @param null|string $path
     * @return null|string
     *
     * @throws FileNotFoundException
     */
    public function entityContent($path=null)
    {
        $path = $this->getEntityPath($path);

        if(file_exists($path)){
            return files()->get($path,true);
        }

        return null;
    }

    /**
     * get entity method content
     *
     * @param null|string $find
     * @param null|string $path
     * @return string
     *
     * @throws FileNotFoundException
     */
    public function entityMethodContent($find=null,$path=null)
    {
        $path = $this->getEntityPath($path);

        $content = $this->entityContent($path);

        if(preg_match('@protected function '.$find.'\(\)\n\s+{\n(.*?)}\n@is',$content,$findData)){
            if(isset($findData[1])){
                return $findData[1];
            }
        }

        return null;
    }

    /**
     * get entity rule content
     *
     * @param string $method
     * @param null|string $path
     * @return null|string
     *
     * @throws FileNotFoundException
     */
    public function entityRuleContent($method,$path=null)
    {
        $path = $this->getEntityPath($path);

        $content = $this->entityContent($path);

        if(preg_match('@protected \$'.$method.';\n(.*?)protected function '.$method.'@is',$content,$ruleData)){
            if(isset($ruleData[1])){
                if(preg_match('/@rule\((.*?)\)/is',$ruleData[1],$ruleComment)){
                    if(isset($ruleComment[1])){
                        return $ruleComment[1];
                    }
                }
            }
        }

        return null;
    }

    /**
     * get entity path
     *
     * @param null|string $path
     * @return string|null
     */
    public function getEntityPath($path=null)
    {
        return (is_null($path)) ? $this->entityPath : $path;
    }


}