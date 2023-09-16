<?php

defined('ABSPATH') || exit;

class Cookie
{
    private $value = false;
    private $key;

    function __construct($key = false)
    {
        if ($key) {
            $this->key = $key;
            if (isset($_COOKIE["$this->key"])) {
                $this->value = $_COOKIE["$this->key"];
            }
        }
    }
    public function set($key, $data, $time, $path)
    {
        setcookie($key, base64_encode(serialize($data)), $time, $path);
    }
    public function get()
    {
        return unserialize(base64_decode($this->value));
    }
}
