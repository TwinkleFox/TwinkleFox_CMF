<?php

/*
 * Sergey Senin aka TwinkleFox
 * On-web: www.tfox.ru
 * E-mail: sergey@tfox.ru
 */

/*
 * Представление
 */

class view extends data {
    protected function title($value) {
        \store::$output['app_tags']['title'] = $value . ' :: ' . $this->tag_get('title');
    }
    
    protected function pagename($value) {
        \store::$output['app_tags']['pagename'] = $value;
        $this->title($value);
    }
    
    protected function tag_set($name, $value) {
        \store::$output['app_tags'][$name] = $value;
    }
    
    protected function tag_add($name, $value) {
        if (isset(store::$output['app_tags'][$name])) {
            \store::$output['app_tags'][$name] .= $value;
        } else {
            $this->tag_set($name, $value);
        }
    }
    
    protected function tag_get($name) {
        if (isset(\store::$output['app_tags'][$name])) {
            return \store::$output['app_tags'][$name];
        } else {
            return '';
        } 
    }
    
    protected function tag_delete($name) {
        unset(\store::$output['app_tags'][$name]);
    }
    
    protected function tag_clear($name) {
        \store::$output['app_tags'][$name] = '';
    }
    
    protected function html($value) {
        echo ' HTML ' . $value;
    }
    
    protected function text($value) {
        echo ' HTML ' . $value;
    }
    
}
