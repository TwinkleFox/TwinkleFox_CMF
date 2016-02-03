<?php

/* 
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

namespace twinklefox\output\page;

class view extends \view {
    private $template;
    
    function __construct($template) {
        // TODO 
        // Убрать, пока необходимо
        $this->tag_add('log', 'LOG:<br />'. implode('<br />', \store::$log));
        
        
        
        
        // Шаблон
        $this->template = $template;
        
        $this->apps_tags_replace();
        $this->global_tags_replace();
        
        // Вывод
        echo $this->template;
    }
    
    /**
     * Заменяет теги приложений
     */
    private function apps_tags_replace() {
        foreach(\store::$output['app_tags'] as $tag => $value) {
            $this->template = str_replace('[' . $tag . ']', $value, $this->template);
        }
    }
    
    /**
     * Заменяет глобальные теги
     */
    private function global_tags_replace() {
        foreach(\store::$output['global_tags'] as $tag => $value) {
            $this->template = str_replace('[' . $tag . ']', $value, $this->template);
        }
    }
}
