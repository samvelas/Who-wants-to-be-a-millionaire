<?php


class PDOConnection
{
    const HOST = "localhost";
    const DATABASE = "test";
    const USERNAME = "root";
    const PASSWORD = "sam123";

    /**
     * @var PDO
     */
    private $connection;

    public function __construct()
    {
        $conn = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DATABASE, self::USERNAME, self::PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->connection = $conn;
    }

    /**
    * @return PDO
    */

    public function getConnection()
    {
        return $this->connection;
    }
}