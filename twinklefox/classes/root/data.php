<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

/*
 * Класс работы с данными
 */

class data
{
    /*
     * GET
     */
    
    /**
     * Запрашивает данные из хранилища
     * @param string $section
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($section, $key = false, $default = false) {
        if ($key === false) {
            return $this->get_value($section, $default);
        } else {
            return $this->get_value_arr($section, $key, $default);
        }
    }
    
    /**
     * Запрашивает данные без ключа
     * @param string $section
     * @param mixed $default
     * @return mixed
     */
    public function get_value($section, $default) {
        if (isset(store::$vars[$section])) {
            return store::$vars[$section];
        } elseif ($default !== false) {
            return $default;
        } else {
            return false;
        }
    }
    
    /**
     * Запрашивает данные с ключем
     * @param string $section
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    private function get_value_arr($section, $key, $default) {
        if (isset(store::$vars[$section][$key])) {
            return store::$vars[$section][$key];
        } elseif ($default !== false) {
            return $default;
        } else {
            return false;
        }
    }
    
    /*
     * SET
     */
    
    /**
     * Помещает данные в хранилище
     * @param mixed $value
     * @param string $section
     * @param string $key
     */
    public function set($value, $section, $key = false) {
        if ($key === false) {
            store::$vars[$section] = $value;
        } elseif ($key === true) {
            store::$vars[$section][] = $value;
        } else {
            store::$vars[$section][$key] = $value;
        }
    }
    
    /*
     * DELETE
     */
    public function delete($section, $key = false) {
        if ($key === false) {
            unset(store::$vars[$section]);
        } else {
            unset(store::$vars[$section][$key]);
        }
    }
    
    /*
     * LOG
     */
    /**
     * Пишет событие в лог
     * @param string $info
     */
    public function log($info) {
        store::$log[] = $info;
    }
    
    /*
     * Error
     */
    public function error($info) {
        $this->log('Error: ' . $info);
        echo '<h1>Error: ' . $info . '</h1>';
        die;
    }
    
    /*
     * NAMESPASES
     */
    public function add_namespace($vendor, $section, $path)
    {
        if (!isset(store::$namespaces[$vendor][$section])) {
            store::$namespaces[$vendor][$section] = $path;
        } else {
            $this->error('Переназначение пространства имен.');
        }
    }
}