<?php

namespace Store\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DateCollection
{
    /**
     * @var null
     */
    protected $locale=null;

    /**
     * @param $int integer
     * @return string
     */
    public function diff($int)
    {
        if($this->locale===null){
            $this->setLocale(config('app.locale','en'));
        }

        return Carbon::createFromTimestamp($int)->timezone(date_default_timezone_get())->diffForHumans();
    }

    /**
     * @return mixed
     */
    public function now()
    {
        return Carbon::now();
    }

    /**
     * @param $date
     * @param $period
     * @return CarbonPeriod
     */
    public function period($date,$period)
    {
        return CarbonPeriod::create($date, $period);
    }

    /**
     * @param null $locale
     * @return $this
     */
    public function setLocale($locale=null)
    {
        $clientLocale = request()->getDefaultLocale();

        $locale=($locale===null) ? Carbon::setLocale($clientLocale) : $locale;

        $this->locale = Carbon::setLocale($locale);

        return $this;
    }

}