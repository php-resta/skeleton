<?php

namespace Store\Services\Device;

use Illuminate\Support\Str;

class OperatingSystem
{
    /**
     * Determine if the operating system is Windows or Windows Subsystem for Linux.
     *
     * @return bool
     */
    public function isWindows()
    {
        return PHP_OS === 'WINNT' || Str::contains(php_uname(), 'Microsoft');
    }

    /**
     * Determine if the operating system is macOS.
     *
     * @return bool
     */
    public function isMac()
    {
        return PHP_OS === 'Darwin';
    }

    /**
     * Determine if the operating system is linux.
     *
     * @return bool
     */
    public function isLinux()
    {
        return PHP_OS === 'Linux';
    }
}