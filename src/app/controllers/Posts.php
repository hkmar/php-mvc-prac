<?php

class Posts extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            redirect('/page/index');
        }
        $this->postModel = $this->model('PostModel');
    }

    public function index() {
        $data = [
          'posts' => $this->postModel->getPosts()
        ];
        $this->view('posts/index', $data);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
              'title' => $_POST['title'],
              'user_id' => $_SESSION['user_id'],
              'body' => $_POST['body'],
              'title_error' => '',
              'body_error' => '',
            ];

            // Validate Title
            if (empty($data['title'])) {
                $data['title_error'] = 'Please enter a title';
            }

            // Validate Body
            if (empty($data['body'])) {
                $data['body_error'] = 'Empty. Please enter post text';
            }

            // Submit post
            if (empty($data['title_error']) && empty($data['body_error'])) {
                if ($this->postModel->createPost($data)) {
                    flash_msg('post_message', 'Post added successfully');
                    redirect('/posts/index');
                }
            } else {
                $this->view('posts/add', $data);
            }
        }
        $data = [];

        $this->view('posts/add', $data);
    }

    public function edit($id = "") {
        // Post author allowed edit else redirected
        if (empty($id)) {
            flash_msg('post_message', 'Too few arguments');
            redirect('/page/index');
        } else if ($_SESSION['user_id'] != $this->postModel->getUserFromPostId($id)) {
            flash_msg('post_message', 'You cannot edit this post');
            redirect('/page/index');
        }
        
        $post = $this->postModel->getPost($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
              'title' => $_POST['title'],
              'post_id' => $id,
              'body' => $_POST['body'],
              'title_error' => '',
              'body_error' => '',
            ];

            // Validate Title
            if (empty($data['title'])) {
                $data['title_error'] = 'Please enter a title';
            }

            // Validate Body
            if (empty($data['body'])) {
                $data['body_error'] = 'Empty. Please enter post text';
            }

            // Submit post
            if (empty($data['title_error']) && empty($data['body_error'])) {
                if ($this->postModel->editPost($data)) {
                    flash_msg('post_message', 'Post edited successfully');
                    redirect('/posts/index');
                }
            } else {
                $this->view('posts/edit', $data);
            }
        }

        $data = [
          'title' => $post->title,
          'body' => $post->body,
          'post_id' => $id
        ];

        $this->view('posts/edit', $data);
    }

    public function post($id) {
        if (empty($id)) {
            flash_msg('post_message', 'Too few arguments');
            redirect('/page/index');
        }

        $res = $this->postModel->getPost($id);

        $data = [
          'title' => $res->title,
          'author' => $res->name,
          'body' => $res->body,
          'post_id' => $id,
        ];
        $this->view('posts/post', $data);
    }

    public function delete($id = '') {
        // Post author allowed to delete else redirected
        if (empty($id)) {
            flash_msg('post_message', 'Too few arguments');
            redirect('/page/index');
        } else if ($_SESSION['user_id'] != $this->postModel->getUserFromPostId($id)) {
            flash_msg('post_message', 'You cannot delete this post');
            redirect('/page/index');
        } else if ($this->postModel->deletePost($id)) {
            flash_msg('post_message', 'Post deleted successfully');
            redirect('/page/index');
        } else {
            die('Something went wrong');
        }
    }
}
