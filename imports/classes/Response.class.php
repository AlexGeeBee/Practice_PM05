<?

class Response {

    public object $user;

    public function __construct(object $user) {
        $this->user = $user;
        
        if ($this->user->request->get_token() && empty($this->user->token)) {
            $this->redirect('/index.php', []);
            die();
        }
    }

    public function getLink(string $url, array $params) {

        if (!empty($this->user->token)) {
            if (!array_key_exists('token', $params)) {
                $params['token'] = $this->user->token;
            }
        }

        if (!str_contains($url, '?') && !empty($params)) {
            $url .= '?';
        }

        foreach ($params as $prop => $value) {
            $url .= "$prop=$value&";
        }

        return str_ends_with($url, "&") ? substr($url, 0, -1) : $url;
        
    }

    public function redirect(string $url, array $params) {
        $final_url = $this->getLink($url, $params);
        header('Location: https://' . Request::req_host() . $final_url);
    }
}

?>