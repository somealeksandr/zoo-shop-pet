<?php


if (!function_exists('current_locale')) {
    function current_locale(): string
    {
        return app()->getLocale();
    }
}
