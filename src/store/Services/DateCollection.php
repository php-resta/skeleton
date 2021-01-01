<?php

namespace Store\Services;

use Exception;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterface;

class DateCollection
{
    /**
     * @var null
     */
    protected $locale = null;

    /**
     * @var string
     */
    protected $timezone = 'Europe/Istanbul';

    /**
     * DateCollection constructor.
     */
    public function __construct()
    {
        $timezoneContainer = app()->get('restaurant_timezone');

        $this->timezone = $timezoneContainer ?? 'Europe/Istanbul';
    }

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
     * @param $format
     * @param $data
     * @param null $tz
     * @return CarbonInterface|void
     */
    public function createFormat($format,$data,$tz = null)
    {
        $tz     = is_null($tz) ? $this->timezone : $tz;

        try{
            return Carbon::createFromFormat($format,$data,$tz);
        }
        catch (Exception $exception){
            exception()->invalidArgument($exception->getMessage());
        }

    }

    /**
     * get now value for date
     *
     * @return CarbonInterface
     */
    public function now()
    {
        return Carbon::now($this->timezone);
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
     * @return mixed
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
     * carbon parse date
     *
     * @param $date
     * @return string
     */
    public function parse($date)
    {
        return Carbon::createFromFormat('Y-m-d',$date)->format('Y-m-d');
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