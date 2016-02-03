<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

/*
 * Класс конфигурации
 */

class config {
    private $config = array(
        'debug' => true,
        'install' => false,
        'load_config' => false,
        'root_username' => 'Admin',
        'root_email' => 'admin@[domain]',
    );
    
    private $info = array(
        'name' => 'TwinkleFox CMF',
        'version' => '3.0.0a',
        'developer' => 'TwinkleFox',
        'email' => 'sergey@tfox.ru',
        'www' => 'http://www.tfox.ru/twinklefox/',
        'info' => 'TwinkleFox CMF v. 1.0 alpha',
        'sitename' => 'TwinkleFox',
        'copyright' => '&copy; 2016 TwinkleFox CMF',
    );

    private $database = array(
        'host' => '',
        'name' => '',
        'username' => '',
        'password' => '',
        'prefix' => '',
        'connect' => false,
    );
    
    private $url = array(
        'furl' => false,
        'separator' => '//',
    );
    
    private $output = array(
        'filename' => 'index.html',
        'content' => '',
        'filedata' => '',
        'template' => 'default',
        'app_tags' => array(),
        'global_tags' => array(),
        'redirect' => false,
    );
    
    function __construct() {
        store::$config = $this->config;
        store::$info = $this->info;
        store::$database = $this->database;
        store::$output = $this->output;
    }
}
