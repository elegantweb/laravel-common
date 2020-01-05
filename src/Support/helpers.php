<?php

if (!function_exists('trans_date')) {
    function trans_date($format, $timestamp = null)
    {
        $fmt = datefmt_create(
            app()->getLocale(),
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            NULL,
            IntlDateFormatter::TRADITIONAL,
            $format
        );

        return datefmt_format(
            $fmt, $timestamp ?? time()
        );
    }
}

if (!function_exists('trans_number')) {
    function trans_number($number, $style = NumberFormatter::PATTERN_DECIMAL, $pattern = null)
    {
        $fmt = numfmt_create(
            app()->getLocale(),
            $style,
            $pattern
        );

        return numfmt_format(
            $fmt, $number
        );
    }
}

if (!function_exists('trans_currency')) {
    function trans_currency($number)
    {
        return trans_number($number, NumberFormatter::CURRENCY);
    }
}

if (!function_exists('o')) {
    function o($value = null, callable $callback = null)
    {
        return optional($value, $callback);
    }
}

if (!function_exists('other')) {
    function other($to = null, $headers = [], $secure = null)
    {
        return redirect($to, 303, $headers, $secure);
    }
}
