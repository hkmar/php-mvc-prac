<?php

class Controller {
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = []) {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once APPROOT . '/views/includes/header.php';
            require_once '../app/views/' . $view . '.php';
            require_once APPROOT . '/views/includes/footer.php';
        } else {
            die("view doesn't exist");
        }
    }
}
