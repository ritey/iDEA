<?php

namespace Idea\Traits;

trait MagicMethod {
    public function __call($method, $args)
	{
		return call_user_func_array([$this->model, $method], $args);
    }
}