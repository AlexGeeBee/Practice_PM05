<?php

class Menu {

    public array $menu = [];
    public object $response;

    public function __construct(array $menu_arr, object $response) {
        $this->menu = $menu_arr;
        $this->response = $response;
    }

    public function menu_html() {
        $menu_items = '';

        foreach ($this->menu as $item) {

            $dir_arr = explode('/', $_SERVER['SCRIPT_FILENAME']);
            $link = $this->response->getLink($item['file'], []);

            if (($this->response->user->isGuest && in_array('guest', $item['access'])) || 
            ($this->response->user->isAdmin && in_array('admin', $item['access'])) || 
            (!$this->response->user->isGuest && !$this->response->user->isAdmin && in_array('author', $item['access']))) {

                if ($dir_arr[count($dir_arr) - 1] == $item['file']) {
                    $menu_items .= "<li class=\"colorlib-active\" ><a href=\"" . $link . "\">" . $item['title'] . "</a></li>";
                }

                else {
                    $menu_items .= "<li><a href=\"" . $link . "\">" . $item['title'] . "</a></li>";
                }
            }
        }
        
        $menu_items = "<ul>" . $menu_items . "</ul>";

        return $menu_items;
    }
}

?>