<?php

namespace Elegant\Common\Models;

trait HasDependentDates
{
    public static function bootHasDependentDates()
    {
        static::saving(function ($model) {
            foreach ($model->getDependentDates() as $column => $opts) {
                if ($model->isDirty($opts['column'])) {
                    $model->updateDependentDate($column, $opts);
                }
            }
        });
    }

    public function getDependentDates()
    {
        if (property_exists($this, 'dependentDates')) {
            return $this->dependentDates;
        } else {
            return [];
        }
    }

    protected function updateDependentDate($column, array $opts)
    {
        if (isset($opts['if_value']) and $this->{$opts['column']} !== $opts['if_value']) {
            $this->{$column} = null;
        } elseif (isset($opts['unless_value']) and $this->{$opts['column']} === $opts['unless_value']) {
            $this->{$column} = null;
        } else {
            $this->{$column} = now();
        }
    }
}
