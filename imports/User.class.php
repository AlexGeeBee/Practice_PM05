<?php

class User {
    public string $table = 'User';

    public string $name;
    public string $surname;
    public string $patronymic;
    public string $login;
    public string $email;
    public string $password;

    // public int $user_id;
    public string $token;

    public bool $isGuest;
    public bool $isAdmin;

    public object $request;
    public object $mysql;

    // public function __construct(object $request, object $mysql) {
    //     $this->request = $request;
    //     $this->mysql = $mysql;
    // }

    public function load(array $user_data) {
        foreach ($user_data as $key => $val) {
            if (property_exists('User', $key)) {
                $this->$key = $val;
            }
        }
    }
}

$user = new User();
$user->load([
    'name' => 'vasya',
    'surname' => 'vasya_s',
    'patronymic' => 'vasya_p',
    'login' => 'vas_login',
    'email' => 'vas_email',
    'password' => 'vasya4123',
    'asdasd' => 'dsfsdf',
]);
var_dump($user);