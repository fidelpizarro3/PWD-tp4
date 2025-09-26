<?php
class Request {
    public static function post($key) {
        return isset($_POST[$key]) ? trim($_POST[$key]) : null;
    }

    public static function get($key) {
        return isset($_GET[$key]) ? trim($_GET[$key]) : null;
    }
}

