<?php

namespace PhpSoft\Base\Validation;

interface Contract
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
