<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

namespace twinklefox\output\page;
use twinklefox\api\input\paths;

class model extends \model {
    private $paths;
    private $default_template = 'default';
    private $template = '<html><head><title>[title]</title></head><body><h1>[pagename]</h1>[content]</body></html>';
    
    function __construct() {
        $this->paths = new paths;
    }
    
    /**
     * Возвращает шаблон
     * @return string
     */
    public function load_template()
    {
        $template_path = $this->paths->twinklefox . DIRECTORY_SEPARATOR .
            'static' . DIRECTORY_SEPARATOR .
            'templates' . DIRECTORY_SEPARATOR . 
            \store::$output['template'] . DIRECTORY_SEPARATOR .
            'main.html';
        
        if (file_exists($template_path))
        {
            $this->template = file_get_contents($template_path);
        }
        
        return $this->template;
    }
}
