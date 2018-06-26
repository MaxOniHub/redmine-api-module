<?php

namespace redmineModule\utils;

trait ArraySortTrait
{

    function array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }

    function array_groupby($array, $grouped_by, $summary_by)
    {
        foreach ($array as $key => &$top_lvl_item) {
                $duplicated = &$array;

                foreach ($duplicated as $sub_key => $sub_item) {
                    if ($sub_key != $key && $top_lvl_item[$grouped_by] == $sub_item[$grouped_by]) {
                        $top_lvl_item[$summary_by] += $sub_item[$summary_by];
                        unset($duplicated[$sub_key]);
                    }
                }
        }
        return array_values($array);
    }
}