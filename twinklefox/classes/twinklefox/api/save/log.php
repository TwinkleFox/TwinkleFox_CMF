<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

namespace twinklefox\api\save;
use twinklefox\api\input\paths;

class log extends \model
{
    private $error_log_path;
    
    function __construct()
    {
        $paths = new paths;
        $this->error_log_path = $paths->files . DIRECTORY_SEPARATOR . 'error.log';
        $this->save_log();
    }
    
    private function save_log()
    {
        $log = $this->get_log();
        
        if (
                (is_writable($this->error_log_path)) &&
                ($logfile = fopen($this->error_log_path, 'a+'))
        )
        {
            fwrite($logfile, $log);
            fclose($logfile);
        }
        else
        {
            $this->error(0);
        }
    }
}
