<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

namespace twinklefox\output\redirect;
use twinklefox\api\input\url;

class view extends \view {
    function __construct($location = true)
    {
        if ($location === true)
        {
            $url = new url;
            $location = $url->root;
        }
        
        $this->pagename('Переадресация');

        $this->tag_set('content', '<p>Вы были перенаправлены на другую страницу, но автоматически перенаправить вас не получилось.</p>');
        $this->tag_add('content', '<p><a href="' . $location . '">Продолжить</a></p>');
        
    }
}