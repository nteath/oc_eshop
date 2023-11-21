<?php


if (!function_exists('is_local')) {

    /**
     * Environment is local.
     *
     * @return bool|string
     */
    function is_local(): bool|string
    {
        return app()->environment('local');
    }
}



if (!function_exists('is_production')) {

    /**
     * Environment is production.
     *
     * @return bool|string
     */
    function is_production(): bool|string
    {
        return app()->environment('production');
    }
}
