<?php
require_once 'Config.php';

class Database {
    private $host;
    private $user;
    private $password;
    private $database;
    private $connection;

    public function __construct()
    {
        $config = Config::getInstance();
        $this->host = $config->get('DB_HOST');
        $this->user = $config->get('DB_USER');
        $this->password = $config->get('DB_PASSWORD');
        $this->database = $config->get('DB_NAME');
        $this->connect();
    }

    private function connect()
    {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql)
    {
        return $this->connection->query($sql);
    }

    public function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }

    public function close()
    {
        $this->connection->close();
    }
}