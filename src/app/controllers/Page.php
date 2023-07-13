<?php

class Page extends Controller {
    public function __construct() {
    }

    public function index() {
        // Logged in user's homepage is posts
        if (isset($_SESSION['user_id'])) {
            redirect('/posts/index');
        }

        $data = [
          'title' => "PostZilla",
          'description' => "Just a simple post sharing site 😊"
        ];
        $this->view('pages/index', $data);
    }
    
    public function about() {
        $data = [
          'title' => "About",
          'description' => "Sharing posts since yesterday 🙃",
          'version' => VERSION
        ];
        $this->view('pages/about', $data);
    }
}
