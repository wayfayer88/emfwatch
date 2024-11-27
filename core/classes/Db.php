<?php

final class Db

{
    private PDO $connection;
    private PDOStatement $stmt;
    private static $instance = null;

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(array $db_config) {
        $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}'}";
        try {
            $this->connection = new PDO($dsn, $db_config['username'], $db_config['password'], $db_config['options']);
            return $this;
            } catch(PDOException $e) {
                abort(500, $e->getMessage());
            }
        }

        public function query($query, $params = []) {
            try {
                $this->stmt = $this->connection->prepare($query);
                $this->stmt->execute($params);
            } catch (PDOException $e) {
                return false;
            }
            return $this;
        }

        public function find()
        {
            return $this->stmt->fetch();
        }

    public function findAll()
    {
        return $this->stmt->fetchAll();
    }
}