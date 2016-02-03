<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

/**
 * Файл для crontab
 */

include_once(__DIR__ . DIRECTORY_SEPARATOR .
        'twinklefox' . DIRECTORY_SEPARATOR .
        'classes' . DIRECTORY_SEPARATOR . 
        'twinklefox.php');

$twinklefox = new twinklefox('crontab');
