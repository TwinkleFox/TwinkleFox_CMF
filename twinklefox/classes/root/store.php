<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

/**
 * Класс хранения данных
 */

class store {
    // Массив для хранения данные
    static $vars = array();
        
    // Массив для хранения объектов
    static $objects = array();
    
    // Массив для хранения выходных данных
    static $output = array();
    
    // Журнал событий
    static $log = array();
    
    // Журнал ошибок
    static $error = array();
    
    // Массив пространств имён
    static $namespaces = array();
    
    // Конфигурация
    static $config = array();
    static $database = array();
    static $info = array();
}
