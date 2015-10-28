<?php

namespace PhpSoft\Base\Contracts;

interface Validation
{
    /**
     * Custom validator rule
     *
     * @return boolean
     */
    public static function boot($request);

    /**
     * Declare rules
     *
     * @return array
     */
    public static function rules();
}
