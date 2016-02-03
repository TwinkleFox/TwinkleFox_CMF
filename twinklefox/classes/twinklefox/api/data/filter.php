<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

namespace twinklefox\api\data;

class filter
{
    /**
     * Фильтрует переменную $_SERVER
     * 
     * @param string $key
     * @return string
     */
    public function server($key)
    {
        return filter_input(INPUT_SERVER, $key, FILTER_SANITIZE_STRING);
    }

    /**
     * Фильтрует переменную $_GET
     * 
     * @param string $key
     * @return string
     */
    public function get($key)
    {
        return filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
    }
    
    /**
     * Фильтрует переменную $_POST
     * 
     * @param string $key
     * @return string
     */
    public function post($key)
    {
        return filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
    }
    
    /**
     * Фильтрует переменную $_COOKIE
     * 
     * @param string $key
     * @return string
     */
    public function cookie($key)
    {
        return filter_input(INPUT_COOKIE, $key, FILTER_SANITIZE_STRING);
    }
    
    public function amp($value)
    {
        return str_replace('&', '&amp;', $value);
    }
    
    
    /**
     * Проверяет значение параметров системы
     * 
     * @param string $value значение параметра
     * @param string $default
     * @return mixed/boolean
     */
    public function option($value, $default = false)
    {
        if (preg_match("/^([a-z0-9._-]+)$/", $value))
        {
            return $value;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Фильтрует числовые значения
     * 
     * @param int $value Фильтруемое значение
     * @param int $min Минимальное значение
     * @param int $max Максимальное значение
     * @param int $default Вернуть если не подходит
     * @return int
     */
    public function int($value, $default = false, $min = false, $max = false)
    {
        $opt = array('options' => array());
        if ($default !== false)
        {
            $opt['options']['default'] = $default;
        }
        if ($min !== false)
        {
            $opt['options']['min_range'] = $min;
        }
        if ($max !== false)
        {
            $opt['options']['max_range'] = $max;
        }
        return filter_var($value, FILTER_VALIDATE_INT, $opt);
    }
    
    /**
     * Фильтрует значения с плавающей точкой
     * 
     * @param int $value Фильтруемое значение
     * @param int $min Минимальное значение
     * @param int $max Максимальное значение
     * @param int $default Вернуть если не подходит
     * @return int
     */
    public function float($value, $default = false)
    {
        $opt = array('options' => array());
        if ($default !== false)
        {
            $opt['options']['default'] = $default;
        }
        return filter_var($value, FILTER_VALIDATE_INT, $opt);
    }
    
    /**
     * Фильтрует адреса электронной почты
     * 
     * @param string $value Фильтруемое значение
     * @param string $default Вернуть если не подходит
     * @return string
     */
    public function email($value, $default = false)
    {
        $opt = array('options' => array());
        if ($default !== false)
        {
            $opt['options']['default'] = $default;
        }
        return filter_var($value, FILTER_VALIDATE_EMAIL, $opt);
    }
    
    /**
     * Фильтрует значения IP адресов.
     * 
     * @param string $value Фильтруемое значение
     * @param string $default Вернуть если не подходит
     * @return string
     */
    public function ip($value, $default = false)
    {
        $opt = array('options' => array());
        if ($default !== false)
        {
            $opt['options']['default'] = $default;
        }
        return filter_var($value, FILTER_VALIDATE_IP);
    }
    
    /**
     * Фильтрует значения IPv4 адресов .
     * 
     * @param string $value Фильтруемое значение
     * @param string $default Вернуть если не подходит
     * @return string
     */
    public function ipv4($value, $default = false)
    {
        $opt = array('options' => array());
        if ($default !== false)
        {
            $opt['options']['default'] = $default;
        }
        return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }
    
    /**
     * Фильтрует значения IPv6 адресов.
     * 
     * @param string $value Фильтруемое значение
     * @param string $default Вернуть если не подходит
     * @return string
     */
    public function ipv6($value, $default = false)
    {
        $opt = array('options' => array());
        if ($default !== false)
        {
            $opt['options']['default'] = $default;
        }
        return filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
    }
    
    /**
     * Фильтрует значеения URL
     * 
     * @param string $value Фильтруемое значение
     * @param string $default Вернуть если не подходит
     * @return string
     */
    public function url($value)
    {
        return filter_var($value, FILTER_VALIDATE_URL);
    }

    /**
     * Фильтрует ключи
     * 
     * @param string $value Фильтруемое значение
     * @return string
     */
    public function key($value)
    {
        if (preg_match("/^([A-Z0-9]{5})-([A-Z0-9]{5})-([A-Z0-9]{5})-([A-Z0-9]{5})-([A-Z0-9]{5})$/", $value))
        {
            return $value;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Фильтрует значение datetime
     * 
     * @param string $date
     * @param string $default
     * @return boolean
     */
    public function datetime($value, $default = false)
    {
        if (preg_match("/^([1-9]{1})([0-9]{3})-([0-9]{2})-([0-9]{2})\ ([0-9]{2}):([0-9]{2}):([0-9]{1,2})$/", $value))
        {
            return $value;
        }
        elseif ($default !== false)
        {
            return $default;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Фильтрует значение date
     * 
     * @param string $value
     * @param string $default
     * @return boolean
     */
    public function date($value, $default = false)
    {
        if (preg_match("/^([1-9]{1})([0-9]{3})-([0-9]{2})-([0-9]{2})$/", $value))
        {
            return $value;
        }
        elseif ($default !== false)
        {
            return $default;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Фильтрует значение time
     * 
     * @param string $value
     * @param string $default
     * @return boolean
     */
    public function time($value, $default = false)
    {
        if (preg_match("/^([0-9]{2}):([0-9]{2}):([0-9]{1,2})$/", $value))
        {
            return $value;
        }
        elseif ($default !== false)
        {
            return $default;
        }
        else
        {
            return false;
        }
    }
}