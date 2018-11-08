<?php

namespace Elegant\Common\Models;

trait HasDependentAppends
{
    protected function getArrayableAppends()
    {
        $appends = parent::getArrayableAppends();

        $appends += $this->getArrayableDependentAppends();

        return $appends;
    }

    public function getDependentAppends()
    {
        if (property_exists($this, 'dependentAppends')) {
            return $this->dependentAppends;
        } else {
            return [];
        }
    }

    protected function getArrayableDependentAppends()
    {
        $appends = [];

        foreach ($this->getDependentAppends() as $column => $opts) {
            if ($this->isAppendable($column, $opts)) {
                $appends[] = $column;
            }
        }

        return $appends;
    }

    protected function isAppendable($column, $opts)
    {
        if (isset($opts['if']) and $opts['if'] === 'exists') {
            return array_has($this->attributes, $opts['column']);
        } else {
            return true;
        }
    }
}
