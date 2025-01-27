<?php

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Schema\Builder as Schema;

// Max database string rule

Validator::extend('max_db_string', function ($attribute, $value, $parameters, $validator) {
    return is_string($value) && strlen($value) <= Schema::$defaultStringLength;
});

Validator::replacer('max_db_string', function ($message, $attribute, $rule, $parameters) {
    return str_replace([':max'], [Schema::$defaultStringLength], $message);
});

// Max database tiny text rule

Validator::extend('max_db_text_tiny', function ($attribute, $value, $parameters, $validator) {
    return is_string($value) && strlen($value) <= 255;
});

Validator::replacer('max_db_text_tiny', function ($message, $attribute, $rule, $parameters) {
    return str_replace([':max'], [255], $message);
});

// Max database text rule

Validator::extend('max_db_text', function ($attribute, $value, $parameters, $validator) {
    return is_string($value) && strlen($value) <= 65535;
});

Validator::replacer('max_db_text', function ($message, $attribute, $rule, $parameters) {
    return str_replace([':max'], [65535], $message);
});

// Max database medium text rule

Validator::extend('max_db_text_medium', function ($attribute, $value, $parameters, $validator) {
    return is_string($value) && strlen($value) <= 16777215;
});

Validator::replacer('max_db_text_medium', function ($message, $attribute, $rule, $parameters) {
    return str_replace([':max'], [16777215], $message);
});

// Max database long text rule

Validator::extend('max_db_text_long', function ($attribute, $value, $parameters, $validator) {
    return is_string($value) && strlen($value) <= 4294967295;
});

Validator::replacer('max_db_text_long', function ($message, $attribute, $rule, $parameters) {
    return str_replace([':max'], [4294967295], $message);
});
