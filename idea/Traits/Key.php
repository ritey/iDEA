<?php

namespace Idea\Traits;

use Auth;

trait Key {

    public function key($str = '')
    {
        $user = '';
        if (Auth::user()) {
            $user = '_'.Auth::user()->id.'_';
        }
        return md5(snake_case(str_replace('\\','',debug_backtrace()[1]['class']) . class_basename(debug_backtrace()[1]['class']) . '_' .  debug_backtrace()[1]['function']) . '_' . $str . $user);
    }
}