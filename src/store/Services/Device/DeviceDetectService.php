<?php

namespace Store\Services\Device;

use Mobile_Detect;

class DeviceDetectService
{
    /**
     * @var $mobile mixed
     */
    protected $mobile;

    /**
     * MobileDetectService constructor.
     */
    public function __construct()
    {
        require_once(root . '/vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php');
        $this->mobile = new Mobile_Detect();
    }

    /**
     * get device detect class methods
     *
     * @return Mobile_Detect
     */
    public function mobile()
    {
        return $this->mobile;
    }

    /**
     * get operation system class methods
     *
     * @return OperatingSystem
     */
    public function os()
    {
        return app()->resolve(OperatingSystem::class);
    }
}