<?php

class Request {
    public bool $isPost = false;
    public bool $isGet = false;

    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->isPost = true;
        }
        elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->isGet = true;
        }
    }

    public static function clear_parameter($param) {
        return strip_tags(trim($param));
    }

    public function clear_array(array $arr) {

        foreach ($arr as &$value) {
            if (is_array($value) && !empty($value)) {
                $value = $this->clear_array($value);
            } else {
                $value = $this->clear_parameter($value);
            }
        }

        return $arr;
    }

    public function post($param = '') {

            if ($param == '') {
                return $this->clear_array($_POST);
            }
            else {
                if (isset($_POST[$param])) {
                    return $this->clear_parameter($_POST[$param]);
                }
                else {
                    return null;
                }
            } 
    }

    public function get($param = '') {

            if ($param == '') {
                return $this->clear_array($_GET);
            }

            else {
                if (isset($_GET[$param])) {
                    return $this->clear_parameter($_GET[$param]);
                }

                else {
                    return null;
                }
            }
    }

    public static function req_host() {
        return $_SERVER['HTTP_HOST'];
    }

    public function get_token() {
        if (isset($_GET['token'])) {
            return $this->clear_parameter($_GET['token']);
        }
        else {
            return null;
        } 
    }

}
?>