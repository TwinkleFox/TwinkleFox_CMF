<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

namespace twinklefox\api\input;
use twinklefox\api\data\filter;

class url extends \data
{
    public $flag = 'default';
    public $separator = '/';
    public $dir = '/';
    public $root = '/';
    public $options = array();
    public $link = '';
    public $links = array();
    public $reserved_flags = array(
        // Основные
        'error' => true,
        'crontab' => true,
        'code' => true,
        'print' => true,
        'files' => true,
        'search' => true,
        'crontab' => true,
        'api' => true,
        'json' => true,
        'favicon.ico' => true,
        'robots.txt' => true,
        'sitemap.xml' => true,
        // Дополнительные
        'new' => false,
        'add' => false,
        'edit' => false,
        'set' => false,
        'save' => false,
        'remove' => false,
        'tfox' => false,
    );
    
    function __construct()
    {
        // Проверяем, была ли инициализация
        
        if ($this->get('url') === false)
        {
            $this->init_paths();
            $this->init_options();
            $this->set_url();
        }
        else
        {
            $this->get_url();
        }
    }
    
    /**
     * Получаем параметры
     */
    private function get_url()
    {
        $this->flag = $this->get('url', 'flag');
        $this->link = $this->get('url', 'link');
        $this->dir = $this->get('url', 'dir');
        $this->root = $this->get('url', 'root');
        $this->options = $this->get('url', 'options');
        $this->links = $this->get('url', 'links');
        $this->separator = $this->get('url', 'separator');
    }
    
    /**
     * Парсит пути
     */
    private function init_paths()
    {
        $filter = new filter;
        $this->dir = substr($filter->server('PHP_SELF'), 0, 0 - strlen(basename($filter->server('PHP_SELF'))));
        $this->root = $this->dir;
        $this->link = substr($filter->server('REQUEST_URI'), strlen($this->dir));
    }
    
    /**
     * Парсит параметры
     */
    private function init_options()
    {
        $filter = new filter;
        
        if ($this->link!== false)
        {
            foreach(explode($this->separator, $this->link) as $link)
            {
                if ($filter->option($link) !== false)
                {
                    if ( (isset($this->reserved_flags[$link])) && (count($this->options) == 0) )
                    {
                        if ( ($this->flag === 'default') && ($this->reserved_flags[$link] === true) )
                        {
                            $this->flag = $link;
                        }
                        else
                        {
                            $this->flag = 'error';
                        }
                    }
                    else {
                        $this->options[] = $link;
                        $this->links[] = implode($this->separator, $this->options);
                    }
                }
                else
                {
                    $this->flag = 'error';
                }
            }
            $this->link = implode($this->separator, $this->options);
        }
    }
    
    /**
     * Запись полученных данных для доступа через API
     */
    private function set_url()
    {
        $this->set($this->flag, 'url', 'flag');
        $this->set($this->link, 'url', 'link');
        $this->set($this->dir, 'url', 'dir');
        $this->set($this->root, 'url', 'root');
        $this->set($this->options, 'url', 'options');
        $this->set($this->links, 'url', 'links');
        $this->set($this->separator, 'url', 'separator');
    }

    // *** PUBLIC ****
    
    /**
     * Возвращает параметр
     * @param int $key Идентификатор ссылки
     * @return string
     */
    public function option($key = false, $separator = false)
    {
        if ($key !== false)
        {
            $options = $this->options;
            if ($separator)
            {
                return isset($options[$key]) ? $options[$key] . $this->get('url', 'separator') : false;
            }
            else
            {
                return isset($options[$key]) ? $options[$key] : false;
            }
        }
        else
        {
            return $this->get('url', 'separator');
        }
    }

    /**
     * Возвращает ссылку
     * @param int $key Индентификатор ссылки / Минимальный идентификатор ссылки в паре с $key_max
     * @param int/true $key_max Максимальный идентификатор ссылки (true -- последний)
     * @return false/string
     */
    public function link($key = false, $key_max = false)
    {
        if ($key !== false)
        {
            if ($key_max === false)
            {
                $links = $this->get('url', 'links');
                return isset($links[$key]) ? $links[$key] : false;
            }
            else
            {
                $options = $this->get('url', 'options');
                $link = array();
                foreach ($options as $option_key => $options)
                {
                    if (
                            ($option_key >= $key) && ($option_key == true) ||
                            ($option_key >= $key) && ($option_key <= $key_max)
                    )
                    {
                        $link[] = $options;
                    }
                }
                return implode($this->get('url', 'separator'), $link);
            }
        }
        else
        {
            return $this->get('url', 'link');
        }
    }
}