<?php

/**
 * @file
 * Database class file.
 */

namespace APP;

use PDO;

class Database
{
    private string $driver;
    private string $databaseName;
    private string $hostname;
    private string $dataSourceName;
    private array $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    private PDO $connection;

    private static ?Database $database = null;

    public function __construct(
        string $driver,
        string $databaseName,
        string $hostname,
        string $userName,
        string $password
    ) {
        $this->driver = $driver;
        $this->databaseName = $databaseName;
        $this->hostname = $hostname;

        $this->dataSourceName = $this->driver . ":dbname=" . $this->databaseName . ";host=" . $this->hostname;

        $this->connection = new PDO($this->dataSourceName, $userName, $password, $this->options);
    }

    public static function getConnection(): PDO
    {
        if (is_null(self::$database)) {
            self::$database = new Database("mysql", "app-java-api", "database", "root", "root");
        }
        return self::$database->connection;
    }
}
