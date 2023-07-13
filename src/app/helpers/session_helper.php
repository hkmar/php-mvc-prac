<?php

session_start();

function flash_msg($name = '', $message = '', $class = 'alert alert-success') {
    if (!empty($name) && !empty($message)) {
        // Unset if previously set
        if (!empty($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
        if (!empty($_SESSION[$name . '_class'])) {
            unset($_SESSION[$name . '_class']);
        }
        // Init session with key $name and val $message
        $_SESSION[$name] = $message;
        $_SESSION[$name . '_class'] = $class;
    } elseif (!empty($_SESSION[$name])) {
        // JIC if class is empty
        $class = (!empty($_SESSION[$name . '_class'])) ? $_SESSION[$name . '_class'] : '';
        // An alert for the message
        echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
        // Unset after placing element
        unset($_SESSION[$name]);
        unset($_SESSION[$name . '_class']);
    }
}
