<?php

namespace App\Events;

class BaseWorkFlowEvent {
    public function getClassName()
    {
        return static::class;
    }
}