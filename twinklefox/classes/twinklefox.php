<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

/**
 * Стартовый класс TwinkleFox CMF
 */

use twinklefox\core\route\controller as route;
use twinklefox\apps\controller as apps;
use twinklefox\output\controller as output;

class twinklefox {
    private $mode = 'default'; // Режим
    private $app_name = 'webpage'; // Имя модуля
    private $apps; // Объект приложений
    private $config; // Оббъект конфигурации
    private $loader; // Объект загрузчика
    private $routes; // Объект маршрутизатора
    
    function __construct($mode = 'default') {
        $this->mode = $mode;
        $this->include_root_classes();
        $this->twinklefox_init();
    }
    
    /**
     * Загружает системные классы
     */
    private function include_root_classes() {
        include_once __DIR__ . DIRECTORY_SEPARATOR . 'root' . DIRECTORY_SEPARATOR . 'store.php';
        include_once __DIR__ . DIRECTORY_SEPARATOR . 'root' . DIRECTORY_SEPARATOR . 'config.php';
        include_once __DIR__ . DIRECTORY_SEPARATOR . 'root' . DIRECTORY_SEPARATOR . 'data.php';
        include_once __DIR__ . DIRECTORY_SEPARATOR . 'root' . DIRECTORY_SEPARATOR . 'mvc' . DIRECTORY_SEPARATOR . 'controller.php';
        include_once __DIR__ . DIRECTORY_SEPARATOR . 'root' . DIRECTORY_SEPARATOR . 'mvc' . DIRECTORY_SEPARATOR . 'controller.php';
        include_once __DIR__ . DIRECTORY_SEPARATOR . 'root' . DIRECTORY_SEPARATOR . 'mvc' . DIRECTORY_SEPARATOR . 'model.php';
        include_once __DIR__ . DIRECTORY_SEPARATOR . 'root' . DIRECTORY_SEPARATOR . 'mvc' . DIRECTORY_SEPARATOR . 'view.php';
        include_once __DIR__ . DIRECTORY_SEPARATOR . 'root' . DIRECTORY_SEPARATOR . 'loader.php';
    }
    
    /**
     * Инициализация системы
     */
    private function twinklefox_init() {
        $this->config = new config();
        $this->loader = new loader(__DIR__);
        $this->route = new route($this->mode);
        $this->app = $this->route->get_app();
        // $this->apps = new apps($this->app_name);
        $this->output = new output();
    }
}
