<?php

// URL format /controller/method/param

class Core {
    protected $currentController = 'Page';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        // Require the homepage
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Get url array
        $url = $this->getUrl();

        // Check if controller exists
        if (isset($url) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);

            // Check if method exists in the controller
            if (isset($url[1])) {
                require_once '../app/controllers/' . $this->currentController . '.php';
                if (method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                } else {
                    // Set controller to Default again
                    $this->currentController = 'Page';
                }
            }
        }

        // Instantiate Controller
        $this->currentController = new $this->currentController();

        // Get Params
        $this->params = $url ? array_values($url) : [];

        // Callback to method with user params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
