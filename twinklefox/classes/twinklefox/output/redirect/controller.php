<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

namespace twinklefox\output\redirect;
use twinklefox\api\input\url;

class controller extends \controller {
    function __construct() {
        $this->model = new model();
        $this->view = new view($this->model->get_location());
    }
}