<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

namespace twinklefox\core\route\model;

class model_error extends \model {
    function __construct() {
        $this->redirect();
    }
}