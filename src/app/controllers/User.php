<?php

class User extends Controller {
    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize Input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Set data
            $data = [
              'name' => $_POST['name'],
              'email' => $_POST['email'],
              'password' => $_POST['password'],
              'confirm_password' => $_POST['confirm_password'],
              'name_error' => '',
              'email_error' => '',
              'password_error' => '',
              'confirm_password_error' => ''
            ];

            // Name Validation
            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter a name';
            }

            // Email Validation
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter a valid email';
            } elseif ($this->userModel->findUserByEmail($data['email'])) {
                $data['email_error'] = 'Email already registered';
            }

            // Password Validation
            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter a password';
            } elseif (strlen($data['password']) < 8) {
                $data['password_error'] = 'Password must be atleast 8 characters';
            }

            // Confirm Password Validation
            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Please confirm your password';
            } elseif ($data['password'] !== $data['confirm_password']) {
                $data['confirm_password_error'] = 'Passwords do not match';
            }

            // On successful validation
            if (
                empty($data['name_error']) && empty($data['email_error'])
                && empty($data['password_error']) && empty($data['confirm_password_error'])
            ) {
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                // Set data to Database
                if ($this->userModel->register($data)) {
                    //Redirect to login
                    flash_msg('register_success', 'Hi! ' . $data['name'] . '. You are registered successfully. Please login now.');
                    redirect('/user/login');
                } else {
                    die("SOMETHING WRONG");
                }
            } else {
                $this->view('user/register', $data);
            }
        } else {
            // Init data
            $data = [
              'name' => '',
              'email' => '',
              'password' => '',
              'confirm_password' => '',
              'name_error' => '',
              'email_error' => '',
              'password_error' => '',
              'confirm_password_error' => '',

            ];

            // Load view
            $this->view('user/register', $data);
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
              'email' => $_POST['email'],
              'password' => $_POST['password'],
              'email_error' => '',
              'password_error' => '',
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter a email';
            } elseif (!$this->userModel->findUserByEmail($data['email'])) {
                $data['email_error'] = 'The entered email does not exist in the system.';
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter a password';
            }

            if (empty($data['email_error']) && empty($data['password_error'])) {
                $res = $this->userModel->login($data);
                if ($res) {
                    $this->createSession($res);
                    redirect('/page/index');
                } else {
                    $data['password_error'] = 'Wrong password';
                    $this->view('user/login', $data);
                }
            } else {
                // Load view
                $this->view('user/login', $data);
            }
        } else {
            // Init data
            $data = [
              'email' => '',
              'password' => '',
              'email_error' => '',
              'password_error' => '',
            ];

            // Load view
            $this->view('user/login', $data);
        }
    }

    public function createSession($data) {
        $_SESSION['user_id'] = $data->id;
        $_SESSION['user_email'] = $data->email;
        $_SESSION['user_name'] = $data->name;
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('/user/login');
    }
    
    public function isLoggedIn() {
        return (isset($_SESSION['user_id'])) ? true : false;
    }
}
