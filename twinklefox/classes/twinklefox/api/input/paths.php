<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.twinklefox.ru
 * E-mail: sergey@twinklefox.ru
 */

namespace twinklefox\api\input;
use twinklefox\api\data\filter;

class paths extends \model
{
    public $root;
    public $twinklefox;
    public $files;
    public $modules;
    
    function __construct()
    {
        if ($this->get('paths') === false)
        {
            $this->init_paths();
            $this->set_paths();
        }
        else
        {
            $this->get_paths();
        }
    }
    
    /**
     * Получаем пути
     */
    private function get_paths()
    {
        $this->root = $this->get('paths', 'root');
        $this->twinklefox = $this->get('paths', 'twinklefox');
        $this->files = $this->get('paths', 'files');
        $this->modules = $this->get('paths', 'modules');
    }
    
    /**
     * Определяет папку, в которую установлена система
     * @return string
     */
    private function init_paths()
    {
        $filter = new filter;
        
        if (empty($filter->server('DOCUMENT_ROOT')))
        {
            $this->root = '.';
        }
        else
        {
            $step = 0 - strlen(basename($filter->server('SCRIPT_FILENAME')));
            $this->root = substr($filter->server('SCRIPT_FILENAME'), 0, $step - 1);
        }
        
        $this->twinklefox = $this->root . DIRECTORY_SEPARATOR . 'twinklefox';
        $this->files = $this->root . DIRECTORY_SEPARATOR . 'files';
        $this->modules = $this->root . DIRECTORY_SEPARATOR . 'modules';
    }
    
    /**
     * Запись полученных данных для доступа через API
     */
    private function set_paths()
    {
        $this->set($this->root, 'paths', 'root');
        $this->set($this->twinklefox, 'paths', 'twinklefox');
        $this->set($this->files, 'paths', 'files');
        $this->set($this->modules, 'paths', 'modules');
    }
    
    /**
     * Логирование
     */
    private function log_paths()
    {
        $this->log('root: ' . $this->root);
        $this->log('twinklefox: ' . $this->twinklefox);
        $this->log('files: ' . $this->files);
        $this->log('modules: ' . $this->modules);
    }
}