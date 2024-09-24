<?php

class Config {
    private static $instance = null;
    private $config = [];

    private function __construct() {
        $this->loadEnv();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    private function loadEnv() {
        $envFile = __DIR__ . '/../.env'; // Adjust path if needed
        if (file_exists($envFile)) {
            $lines = file($envFile);
            foreach ($lines as $line) {
                $line = trim($line);
                // Ignore comments and empty lines
                if ($line === '' || strpos($line, '#') === 0) {
                    continue;
                }
                list($key, $value) = explode('=', $line, 2);
                $this->config[trim($key)] = trim($value);
            }
        }
    }

    public function get($key) {
        return isset($this->config[$key]) ? $this->config[$key] : null;
    }
}