<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

namespace twinklefox\output\redirect;
use twinklefox\api\input\url;

class model extends \model {
    function get_location() {
        $location = \store::$output['redirect'];
        if ($location === true)
        {
            $url = new url;
            $this->to = $url->root;
            $this->to .= ($location === false) ? $url->link : $location;
        }
        return $location;
    }
}