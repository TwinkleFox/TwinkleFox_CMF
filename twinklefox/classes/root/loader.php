<?php

/*
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

/*
 * Загрузчик
 */

class loader extends data {
    function __construct($path) {
        // Регистрируем автозагрузчик
        spl_autoload_register(array('loader', 'autoloader'), true, true);
        
        // Регистрируем пространства имен
        $this->add_namespace('twinklefox', 'api', $path);
        $this->add_namespace('twinklefox', 'core', $path);
        $this->add_namespace('twinklefox', 'output', $path);
    }
    
    /**
     * Автозагрузчик классов
     * 
     * @param string $class_name Абсолютное имя класса
     * @return string Путь до класса
     */
    public function autoloader($class_name) {
        $class_path = $this->class_path($class_name);
        $this->log('Load class: ' . $class_name);

        if ($class_path === false) {
            $this->error('Попытка запуска класса ' . $class_name . ' из незарегистрированного простанства имён.');
        } elseif(!file_exists($class_path)) {
            $this->error('Не удалось загрузить класс ' . $class_name . ' по пути ' . $class_path);
        } else {
            require_once $class_path;
            if (!class_exists($class_name)) {
                $this->error('Не удалось найти класс ' . $class_name . ' в файле ' . $class_path);
            }
            
        }
    }

    /**
     * Возвращает путь до класса
     * в соотвествиии со списком зарегистрированных пространств имен
     * 
     * @param string $class_name Абсолютное имя класса
     * @return string Путь до класса
     */
    public function class_path($class_name) {
        $namespace_arr = explode("\\", $class_name);
        if (count($namespace_arr) > 2) {
            list($vendor, $name) = $namespace_arr;
            if (isset(store::$namespaces[$vendor][$name])) {
                return store::$namespaces[$vendor][$name] . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $namespace_arr) . '.php';
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
