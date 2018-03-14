<?php

namespace Store\Services;

class MobileDetectService {

    /**
     * @var $mobile mixed
     */
    protected $mobile;

    /**
     * MobileDetectService constructor.
     */
    public function __construct() {
        require_once(root . '/vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php');
        $this->mobile=new \Mobile_Detect();
    }

    /**
     * @return bool true|false
     */
    public function isMobile() {
        return $this->mobile->isMobile();
    }
}