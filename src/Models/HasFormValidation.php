<?php

namespace Elegant\Common\Models;

use Illuminate\Support\Arr;

trait HasFormValidation
{
    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }

    public function attrs()
    {
        return [];
    }

    public function getRules($key = null)
    {
        if (is_null($key)) {
            return $this->rules();
        } elseif (is_array($key)) {
            return Arr::only($this->rules(), $key);
        } else {
            return Arr::get($this->rules(), $key, []);
        }
    }

    public function getMessages($key = null)
    {
        if (is_null($key)) {
            return $this->messages();
        } elseif (is_array($key)) {
            return Arr::only($this->messages(), $key);
        } else {
            return Arr::get($this->messages(), $key, '');
        }
    }

    public function getAttrs($key = null)
    {
        if (is_null($key)) {
            return $this->attrs();
        } elseif (is_array($key)) {
            return Arr::only($this->attrs(), $key);
        } else {
            return Arr::get($this->attrs(), $key, '');
        }
    }
}
