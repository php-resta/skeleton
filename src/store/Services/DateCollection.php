<?php

namespace Store\Services;

use Resta\ApplicationProvider;
use Carbon\Carbon;

class DateCollection extends ApplicationProvider {

    /**
     * @var null
     */
    protected $locale=null;

    /**
     * @param null $locale
     * @return object
     */
    public function setLocale($locale=null){

        $clientLocale=$this->request()->getDefaultLocale();

        //date_default_timezone_set('Europe/London');

        $locale=($locale===null) ? Carbon::setLocale($clientLocale) : $locale;

        $this->locale=Carbon::setLocale($locale);

        return $this;
    }

    /**
     * @param $int integer
     * @return string
     */
    public function diff($int){

        if($this->locale===null){
            $this->setLocale();
        }

        return Carbon::createFromTimestamp($int)->timezone(date_default_timezone_get())->diffForHumans();
    }

}