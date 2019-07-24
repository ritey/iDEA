<?php

if (!function_exists('idea_build_date_time')) {
    /**
     * Returns a datetime string concatinating date from hours and minutes
     *
     * @return string a string in Y-m-d H:i:s format
     *
     * */
    function idea_build_date_time($data = [], $source_date = '', $source_hour = '', $source_minute = '00')
    {
        $str = '';
        if (isset($data[$source_date])) {
            $str = date('Y-m-d H:i:s', strtotime(str_replace('/','-',$data[$source_date])));
        }
        if (isset($data[$source_date]) && isset($data[$source_hour]) && isset($data[$source_minute])) {
            $str = date('Y-m-d H:i:s', strtotime(str_replace('/','-',$data[$source_date]) . ' ' . (int)$data[$source_hour] . ':' . (int)$data[$source_minute]));
        }
        if (isset($data[$source_hour]) && (!isset($data[$source_minute]) || empty($data[$source_minute]))) {
            $str = date('Y-m-d H:i:s', strtotime(str_replace('/','-',$data[$source_date]) . ' ' . (int)$data[$source_hour] . ':00'));
        }
        return $str;
    }
}