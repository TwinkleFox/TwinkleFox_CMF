<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

namespace twinklefox\output;
use twinklefox\output\redirect\controller as redirect;
use twinklefox\output\page\controller as page;

class controller extends \controller {
    private $redirect;
    private $page;
    
    function __construct() {
        if (\store::$output['redirect'] !== false) {
            $this->redirect = new redirect();
        }
        
        $this->page = new page();
    }
}