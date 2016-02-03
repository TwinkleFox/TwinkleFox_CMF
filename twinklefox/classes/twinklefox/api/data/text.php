<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

namespace twinklefox\api\data;

class text
{
    function safe()
    {
        $orig = array( "\r", "/", '\\', '`', '?', '%', '[', ']', '&', );
        $repl = array( '', '&#47;', '&#092;', '&#096;', '&#063;', '&#037;', '&#091;', '&#093;', ':amp:', );
        $str = htmlentities(trim($str), ENT_QUOTES, 'UTF-8');
        return str_replace($orig,  $repl, $str);
        
    }
    
    public function html($str)
    {
        $orig = array( ':amp:', '&', );
        $repl = array( '&#039;', '\'', );
        return html_entity_decode(str_replace($orig, $repl, $str), ENT_QUOTES, 'UTF-8');
    }
    
    public function str($str)
    {
        $orig = array( ':amp:', '<', '>', );
        $repl = array( '&', '&lt;', '&gt;', );
        return str_replace($orig,  $repl, $str);
    }
    
    // Строку в читаемый вид
    public function strbr($str)
    {
        return str_replace("\n", '<br />', $this->str($str));
    }

    // Bool
    public function bool($str)
    {
        if (empty($str))
        {
            return '×';
        }
        else
        {
            return '✔';
        }
    }


    // Генератор соли
    public function salt()
    {
        $symbols = array(
            'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'u', 'o', 'p', 'a', 's',
            'd', 'f', 'g', 'h', 'j', 'k', 'l', ':', 'z', 'x', 'c', 'v', 'v',
            'b', 'n', 'm', ',', 'Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O',
            'P', 'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', ';', 'Z', 'X',
            'C', 'V', 'B', 'N', 'M', ',', '.', '1', '2', '3', '4', '5', '6',
            '7', '8', '9', '0', '-', '=', '!', '#', '$', '^', '*', '(', ')',
            '_', '+', '~',
        );
        $salt = '';
        $i = 0;
        while(++$i <= 32)
        {
            $rand = rand(0, 80);
            $salt .= $symbols[$rand];
        }
        return $salt;
    }

    public function md5_salt_hash($pass, $salt)
    {
        return md5(md5($salt) . $pass . md5($pass) . $salt);
    }

    // Числовые значения
    public function num($int, $infolist = 'единица|единицы|единиц')
    {
        $infolist = explode('|', $infolist);
        $return = NULL;
        if ($int < 0)
        {
            $return = 'минус ';
            $int = abs ($int);
        }
        $lastdint = $int % 100;
        if ( ($lastdint >= 5) && ($lastdint <= 20) )
        {
            $return .= ($this->fnum($int) . ' ' . $infolist[2]);
        }
        else
        {
            $lastint = $int % 10;
            if ($lastint == 1) $return .= ($this->fnum($int) . ' ' . $infolist[0]);
              elseif ( ($lastint >= 2) && ($lastint <= 4) ) $return .= ($this->fnum($int) . ' ' . $infolist[1]);
              else $return .= ($this->fnum($int) . ' ' . $infolist[2]);
        }
        return ($return);
    }

    public function fnum($int)
    {
        $int_r = explode('.', $int);
        $int_r[0] = (int)$int_r[0];
        $return = number_format($int_r[0], 0, '.', ' ');
        if ( (isset($int_r[1])) && (substr($int_r[1], 0, 3) > 0) ) $return = $return . '.' . substr($int_r[1], 0, 3);
        return $return;
    }

    public function pnum($int, $int_light = 2)
    {
        return(str_pad($int, $int_light, '0', STR_PAD_LEFT));
    }

    public function size($size)
    {
        if ($size < 1024)
        {
            return $this->num($size, 'байт|байта|байт');
        }
        elseif ($size < (1024 * 1024))
        {
            return $this->num(round($size / 1024, 1), 'КБайт|КБайта|КБайт');
        }
        elseif ($size < (1024 * 1024 * 1024))
        {
            return $this->num(round($size / 1024 / 1024, 2), 'МБайт|МБайта|МБайт');
        }
        else
        {
            return $this->num(round($size / 1024 / 1024 / 1024, 2), 'ГБайт|ГБайта|ГБайт');
        }
    }
}
    
    