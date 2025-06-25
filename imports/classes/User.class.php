<?php

class User
{
    public string $table = 'user';

    public int $user_id;
    public string|null $token;

    public string $_name;
    public string $_surname;
    public string $patronymic;
    public string $_login;
    public string $_email;
    public string $_password;
    public string $_password_repeat;

    public string $name_validate = '';
    public string $surname_validate = '';
    public string $patronymic_validate = '';
    public string $login_validate = '';
    public string $email_validate = '';
    public string $password_validate = '';
    public string $password_repeat_validate = '';

    public bool $isGuest = true;
    public bool $isAdmin = false;

    public object $request;
    public object $mysql;

    public function __construct(object $request, object $mysql) {

        $this->request = $request;
        $this->mysql = $mysql;

        if ($this->request->get_token()) {
            $this->identity();
        }
    }

    public function load(array $user_data) {
        Data::loadData($this, $user_data);

        if (!$this->isGuest) {
            $this->isAdmin = $this->isAdmin();
        }
    }

    public function validateRegister() {

        $res = Data::validateData($this);

        if (empty($this->login_validate) && $this->mysql->unique('user', '_login', $this->_login) !== '0') {
            $this->login_validate = 'this login already exists';
            $res = false;
        }

        if (empty($this->email_validate) && $this->mysql->unique('user', '_email', $this->_email) !== '0') {
            $this->email_validate = 'this email is already registered';
            $res = false;
        }

        if (empty($this->password_validate) && empty($this->password_repeat_validate)) {

            if (strlen($this->_password) < 6) {
                $this->password_validate = 'password length less than 6 characters';
                $res = false;
            }
            
            elseif ($this->_password !== $this->_password_repeat) {
                $this->password_repeat_validate = 'passwords dont match';
                $res = false;
            } 
        }

        return $res;
    }

    public function save() {

        $password_hash = password_hash($this->_password, PASSWORD_DEFAULT);

        $query_code = "INSERT INTO `user` (_name, _surname, patronymic, _login, _email, _password) VALUES ('$this->_name', '$this->_surname', '$this->patronymic', '$this->_login', '$this->_email', '$password_hash')";

        $res = $this->mysql->db_query($query_code);

        return $res;
    }

    public function validateLogin() {
        return Data::validateData($this);
    }

    public function login() {
        $query_res = $this->mysql->db_query("SELECT * FROM `user` WHERE `_login` = '$this->_login'");

        if (empty($query_res)) {
            $this->login_validate = 'login does not exist';
            return false;
        }

        if (password_verify($this->_password, $query_res[0]['_password'])) {

            if ($this->block_status($query_res[0]['user_id'])) {
                $this->login_validate = 'this user is blocked';
                return false;
            }

            $this->load($query_res[0]);

            $this->isGuest = false;
            $this->isAdmin = $this->isAdmin();

            $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $this->token = substr(str_shuffle($chars), 0, 12);

            return $this->mysql->db_query("UPDATE `user` SET `token` = '$this->token' WHERE `user`.`user_id` = $this->user_id");
        } 
        else {
            $this->password_validate = 'incorrect password';
            return false;
        }
    }

    public function identity() {
        $query_res = $this->mysql->db_query("SELECT * FROM `user` WHERE `token` = '{$this->request->get_token()}'");
        if ($query_res) {
            $this->isGuest = false;
            $this->load($query_res[0]);
        }
        
    }

    public function findOne($user_id) {
        $query_res = $this->mysql->db_query("SELECT * FROM `user` WHERE `user`.`user_id` = '$user_id'");
        return $query_res ? $query_res[0] : false;
    }

    public function isAdmin() {
        $query_res = $this->mysql->db_query("SELECT is_admin FROM `user` WHERE `user_id` = $this->user_id");
        return $query_res[0]['is_admin'];
    }

    public function logout() {
        $query_res = $this->mysql->db_query("UPDATE `user` SET `token` = NULL WHERE `user`.`token` = '$this->token';");
        if ($query_res) {
            header('Location: ' . 'index.php');
            die();
        }
    }

    public function all_users() {
        $query_res = $this->mysql->db_query("SELECT * FROM `user`");

        if (!empty($query_res)) {
            $output = [];

            foreach($query_res as $user) {
                $obj = new static($this->request, $this->mysql);
                $obj->load($user);
                $output[] = $obj;
            }

            return $output;
        }

        return false;
    }

    public function block($user_id, $block_end_date = null) {
        
        $this->mysql->db_query("UPDATE `user` SET `token` = NULL WHERE `user`.`user_id` = $user_id");

        if (isset($block_end_date)) {
            $this->mysql->db_query("INSERT INTO `blocking` (`user_id`, `end_date`) VALUES ('$user_id', '$block_end_date');");
        }
        else {
            $this->mysql->db_query("INSERT INTO `blocking` (`user_id`, `end_date`) VALUES ('$user_id', NULL);");
        }
    }

    public function block_status($user_id = null) {

        $id = isset($user_id) ? $user_id : $this->user_id;
        $res = $this->mysql->db_query("SELECT * FROM `blocking` WHERE `user_id` = $id ORDER BY `block_date` DESC LIMIT 1;");

        if ($res) {
            if ($res[0]['end_date'] == null) {
                return 'permanently';
            }
            
            $end_date = new DateTime($res[0]['end_date']);
            $now = new DateTime('now');

            if ($end_date > $now) {
                return 'temporary';
            }
        }
        
        return false;

    }
}
