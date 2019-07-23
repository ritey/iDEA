<?php

namespace Idea\Traits;

trait ScopeEnabled {

    function scopeEnabled($query,$value = true) {
        return $query->where('enabled',$value);
    }
}