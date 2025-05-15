<?php

class Menu {

    public array $menu = [];

    public function __construct(array $menu_arr) {
        $this->menu = $menu_arr;
    }

    public function menu_html() {
        $menu_items = '';

        foreach ($this->menu as $item) {

            $dir_arr = explode('/', $_SERVER['SCRIPT_FILENAME']);
            
            if ($dir_arr[count($dir_arr) - 1] == $item['file']) {
                $menu_items .= "<li class=\"colorlib-active\" ><a href=\"" . $item['file'] . "\">" . $item['title'] . "</a></li>";
            }
            else {
                $menu_items .= "<li><a href=\"" . $item['file'] . "\">" . $item['title'] . "</a></li>";
            }
        }
        
        $menu_items = "<ul>" . $menu_items . "</ul>";

        return $menu_items;
    }
}

?>