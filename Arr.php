<?php defined('SYSPATH') or die('No direct script access.');

class Arr extends Kohana_Arr
{

    public static function get($array, $key, $default = null)
    {
        if (strpos($key, '=>') !== false) {
            return Arr::get_multidimensional($array, $key, $default);
        }
        return parent::get($array, $key, $default);
    }

    /**
     * Get data by case-insensitive key
     * @param $array
     * @param $key
     * @param null $default
     * @return mixed
     */
    public static function geti($array, $key, $default = null)
    {
        if (strpos($key, '=>') !== false) {
            return Arr::geti_multidimensional($array, $key, $default);
        }
        foreach ($array as $k => $v) {
            if (strtolower($k) == strtolower($key)) {
                return $v;
            }
        }
        return $default;
    }

    /**
     * Get data from multi-dimension array
     * @param $array - Source array
     * @param $keys - Multi-dimension key. String like: "parent=>child1=>child2"
     * @param $default - Default value
     * @return mixed
     */
    protected static function get_multidimensional($array, $keys, $default = null)
    {
        $keys_arr = explode('=>', $keys);
        $value = $array;
        foreach ($keys_arr as $key) {
            $value = parent::get($value, $key, $default);
        }
        return $value;
    }

    /**
     * Get data from multi-dimension array by case-insensitive key
     * @param $array - Source array
     * @param $keys - Multi-dimension key. String like: "parent=>child1=>child2"
     * @param $default - Default value
     * @return mixed
     */
    protected static function geti_multidimensional($array, $keys, $default = null)
    {
        $keys_arr = explode('=>', $keys);
        $value = $array;
        foreach ($keys_arr as $key) {
            $value = Arr::geti($value, $key, $default);
        }
        return $value;
    }
}