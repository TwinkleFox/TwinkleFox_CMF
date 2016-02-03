<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */


namespace twinklefox\api\out;


class headers extends \model
{
    public $mime_list = array(
        'ico'  => 'image/x-icon',
        'htm'  => 'text/html',
        'html' => 'text/html',
        'php'  => 'text/plain',
        'php4' => 'text/plain',
        'php5' => 'text/plain',
        'json' => 'application/json',
        'txt'  => 'text/plain',
        'ini'  => 'text/plain',
        'xml'  => 'text/xml',
        'css'  => 'text/css',
        'js'   => 'text/javascript',
        'mp3'  => 'audio/mpeg',
        'wav'  => 'audio/x-wav',
        'pdf'  => 'application/pdf',
        'ogg'  => 'audio/ogg',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif'  => 'image/gif',
        'png'  => 'image/png',
        'tiff' => 'image/tiff',
        'bmp'  => 'image/bmp',
        'zip'  => 'application/zip',
        'swf'  => 'application/x-shockwave-flash',
        'odf'  => 'application/vnd.oasis.opendocument.text', // OpenDocument
        'odt'  => 'application/vnd.oasis.opendocument.spreadsheet', // OpenDocument
        'odp'  => 'application/vnd.oasis.opendocument.presentation', // OpenDocument
        'odg'  => 'application/vnd.oasis.opendocument.graphics', // OpenDocument
        'xls'  => 'application/vnd.ms-excel', // Microsoft Excel файлы
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // Microsoft Excel 2007 файлы
        'ppt'  => 'application/vnd.ms-powerpoint', // Microsoft Powerpoint файлы
        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation', // Microsoft Powerpoint 2007 файлы
        'doc'  => 'application/msword', // Microsoft Word файлы
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // Microsoft Word 2007 файлы
        'rtf'  => 'text/rtf',
    );
    
    public $error_list = array(
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        419 => 'Authentication Timeout',
        420 => 'Method Failure',
        420 => 'Enhance Your Calm',
        421 => 'Misdirected Request',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        451 => 'Unavailable For Legal Reasons',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        509 => 'Bandwidth Limit Exceeded',
        510 => 'Not Extended',
        511 => 'Network Authentication Required',
    );
    
    /**
     * Устанавливает заголовок в зависимости от имени файла
     * 
     * @param type $file_name
     */
    public function mime($file_name)
    {
        $file_ext = strtolower(substr(strrchr($file_name, '.'), 1));

        if (isset ($this->mime_list[$file_ext]))
        {
            header('Content-Type: '. $this->mime_list[$file_ext]);
        }
        else
        {
            header('Content-Type: application/octet-stream');
        }
    }

    /**
     * Устанавливает заголовок с именем файла
     * 
     * @param type $file_name Имя файла
     * @param type $att Заставить браузер принудидельно сохранить файл
     */
    public function name($file_name, $att = false)
    {
        if ($att === true)
        {
            header('Content-Disposition: attachment; filename="'. addslashes(basename($file_name)) . '"');
        }
        else
        {
            header('Content-Disposition: inline; filename="'. addslashes(basename($file_name)) . '"');
        }
    }
    
    /**
     * Задать заголовок с размером контента
     * 
     * @param type $file_path
     */
    public function file_size($file_path)
    {
        if (file_exists($file_path))
        {
            $size = filesize($file_path);
            if ($size > 0)
            {
                header('Content-Length: '. (int)$size);
            }
        }
    }
    
    public function code($code)
    {
        if (!isset($this->error_list[$code]))
        {
            $code = 500;
        }
        
        $filter = new filter;
        header($filter->server('SERVER_PROTOCOL') . ' ' . $code  . ' ' . $this->error_list[$code]);
        header('Status: ' . $code  . ' ' . $this->error_list[$code]);
        return $code . ' ' . $this->error_list[$code];
    }
}