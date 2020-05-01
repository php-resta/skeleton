<?php

namespace Store\Services;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;

class DateCollection
{
    /**
     * @var null
     */
    protected $locale = null;

    /**
     * get diff value for date
     *
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
     * get now value for date
     *
     * @return CarbonInterface
     */
    public function now()
    {
        return Carbon::now('America/New_York');
    }

    /**
     * get today value for date
     *
     * @return CarbonInterface
     */
    public function today()
    {
        return Carbon::today();
    }

    /**
     * get today value for date
     *
     * @return CarbonInterface
     */
    public function hour()
    {
        return $this->now()->format('H:i');
    }

    /**
     * get tomorrow value for date
     *
     * @return CarbonInterface
     */
    public function tomorrow()
    {
        return Carbon::tomorrow();
    }

    /**
     * get tomorrow value for date
     *
     * @return CarbonInterface
     */
    public function yesterday()
    {
        return Carbon::yesterday();
    }

    /**
     * get period value for date
     *
     * @param $date
     * @param $period
     * @return CarbonPeriod
     */
    public function period($date,$period)
    {
        return CarbonPeriod::create($date, $period);
    }

    /**
     * set locale value for date
     *
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