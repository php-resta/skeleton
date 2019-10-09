<?php

namespace Boot;

use Store\Traits\Annotations;
use Resta\Contracts\BootContracts;
use Resta\Foundation\ApplicationProvider;

class ClientResponseIdentifier extends ApplicationProvider implements BootContracts
{
    use Annotations;

    /**
     * @var array
     */
    protected $contentTypes = ['json','xml'];

    /**
     * @return void
     */
    public function boot()
    {
        // this command should only be executed in the http request.
        // Otherwise, it may have unintended consequences.
        if($this->app->runningInConsole()===false){

            //We receive the content-type data sent by request.
            $contentType = headers('accept');

            // the content-type header value must start with
            // the application/ string value and specify the next data response type.
            if(preg_match('#application\/(.*)#is',$contentType,$application)){

                // the client response type data can be any of
                // the values ​​in the contentTypes array, which are the values ​​the system expects.
                // if the requested response type is correct, then we register the clientResponseType to container.
                if(isset($application[1]) && in_array($application[1],$this->contentTypes)){
                    $this->app->register('clientResponseType',$application[1]);
                }
            }
        }
    }

}