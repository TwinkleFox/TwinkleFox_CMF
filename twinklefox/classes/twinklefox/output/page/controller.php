<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

namespace twinklefox\output\page;

class controller extends \controller {
    public $template;
    
    function __construct() {
        $this->model = new model();
        $this->template = $this->model->load_template();
        
        $this->view = new view($this->template);
    }
}