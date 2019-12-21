<?php

namespace Elegant\Common\Models;

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

    public function attributes()
    {
        return [];
    }

    public function filters()
    {
        return [];
    }

    public function getRules($key = null)
    {
        if (is_null($key)) {
            return $this->rules();
        } elseif (is_array($key)) {
            return array_only($this->rules(), $key);
        } else {
            return array_get($this->rules(), $key, []);
        }
    }

    public function getMessages($key = null)
    {
        if (is_null($key)) {
            return $this->messages();
        } elseif (is_array($key)) {
            return array_only($this->messages(), $key);
        } else {
            return array_get($this->messages(), $key, '');
        }
    }

    public function getAttributes($key = null)
    {
        if (is_null($key)) {
            return $this->attributes();
        } elseif (is_array($key)) {
            return array_only($this->attributes(), $key);
        } else {
            return array_get($this->attributes(), $key, '');
        }
    }

    public function getFilters($key = null)
    {
        if (is_null($key)) {
            return $this->filters();
        } elseif (is_array($key)) {
            return array_only($this->filters(), $key);
        } else {
            return array_get($this->filters(), $key, []);
        }
    }
}
