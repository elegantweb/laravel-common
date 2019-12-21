<?php

namespace Elegant\Common\Models;

use Illuminate\Support\Arr;

trait HasFormSanitization
{
    public function filters()
    {
        return [];
    }

    public function getFilters($key = null)
    {
        if (is_null($key)) {
            return $this->filters();
        } elseif (is_array($key)) {
            return Arr::only($this->filters(), $key);
        } else {
            return Arr::get($this->filters(), $key, []);
        }
    }
}
