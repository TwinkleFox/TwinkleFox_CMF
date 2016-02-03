<?php

/*
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

namespace twinklefox\core\route\view;

class view_webpage extends \view {
    function __construct() {
        $this->tag_set('title', 'TwinkleFox');
        
        
        
        $this->pagename('Веб-страница');
        $this->tag_set('content', 'Hello, world!');
    }
}
