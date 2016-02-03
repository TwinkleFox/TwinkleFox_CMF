<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

/*
 * Модель
 */

class model extends data {
    protected function redirect($to = true)
    {
        store::$output['redirect'] = $to;
    }
}