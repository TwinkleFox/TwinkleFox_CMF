<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

namespace twinklefox\core\route;
use twinklefox\api\input\url;

class controller extends \controller {
    private $app = 'webpage';
    private $url;
    
    function __construct($mode)
    {
        $this->url = new url();
        $this->app = $this->select_app();
        
        $model = __NAMESPACE__ . '\\model\\model_' . $this->app;
        $view = __NAMESPACE__ . '\\view\\view_' . $this->app;
        
        $this->model = new $model;
        $this->view = new $view;
    }
    
    private function select_app()
    {
        switch ($this->url->flag) {
            case 'error':
                return 'error';
                break;
            case 'crontab':
                return 'crontab';
                break;
            case 'files':
                return 'files';
                break;
            case 'api':
                return 'api';
                break;
            case 'json':
                return 'json';
                break;
            case 'favicon.ico':
                return 'favicon';
                break;
            case 'robots.txt':
                return 'robots';
                break;
            case 'sitemap.xml':
                return 'sitemap';
                break;
            default:
                return 'webpage';
        }
    }
    
    public function get_app()
    {
        return $this->app;
    }
}
