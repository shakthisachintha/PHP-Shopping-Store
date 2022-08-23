<?php
class DatabaseService
{
    private $servername = DATABASE_SERVER;
    private $username = DATABASE_USER_NAME;
    private $password = DATABASE_PASSWORD;
    private $database = DATABASE_NAME;
    private $connection;

    function __construct()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
            return;
        }

        $this->connection = $conn;
    }

    function create_record(string $table, array $data): bool
    {
        $columns = implode(", ", array_keys($data));
        $escaped_values = $data;
        foreach ($escaped_values as $idx => $data) $escaped_values[$idx] = "'" . $data . "'";
        $values  = implode(", ", $escaped_values);
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        if ($this->connection->query($query) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function retrieve_by_id(string $table, string $id): array
    {
        $query  = "SELECT * FROM $table WHERE id=$id";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return array();
        }
    }



    function update_record(string $table, array $data, string $id): bool
    {
        $query = "UPDATE $table SET ";
        foreach ($data as $column => $value){
            $query .= ",$column = $value";
        }
        $query.="WHERE id = $id";
        return true;
    }

    function delete_by_id(string $table, string $id): bool
    {
        $query = "DELETE FROM $table WHERE id=$id";

        if ($this->conn->query($query) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
