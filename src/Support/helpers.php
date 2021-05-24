<?php

if (!function_exists('trans_date')) {
    function trans_date($format, $timestamp = null)
    {
        if (is_array($format)) {
            [$dateType, $timeType] = $format;
        } elseif (is_int($format)) {
            $dateType = $timeType = $format;
        } else {
            $dateType = $timeType = IntlDateFormatter::FULL;
        }

        if (is_string($format)) {
            $pattern = $format;
        } else {
            $pattern = null;
        }

        $fmt = datefmt_create(
            app()->getLocale(),
            $dateType,
            $timeType,
            NULL,
            IntlDateFormatter::TRADITIONAL,
            $pattern
        );

        return datefmt_format(
            $fmt, $timestamp ?? time()
        );
    }
}

if (!function_exists('trans_number')) {
    function trans_number($number, $style = NumberFormatter::DECIMAL, $pattern = null)
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
    function trans_currency($number, $currency = null)
    {
        $fmt = numfmt_create(
            app()->getLocale(),
            NumberFormatter::CURRENCY
        );

        if ($currency) {
            return numfmt_format_currency($fmt, $number, $currency);
        } else {
            return numfmt_format($fmt, $number);
        }
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
