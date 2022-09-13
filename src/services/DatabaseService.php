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
        $query = "INSERT INTO $table ($columns) VALUES ($values);";
        if ($this->connection->query($query) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function retrieve_by_id(string $table, string $id): array
    {
        $query  = "SELECT * FROM $table WHERE id='$id'";
        $result = $this->connection->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return array();
        }
    }

    function retrieve_by_field(string $table, string $field, string $value): array
    {
        $query = "SELECT * FROM $table WHERE $field='$value'";
        $result = $this->connection->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return array();
        }
    }

    function retrieve_all_records(string $table): array
    {
        $results_array = array();
        $query = "SELECT * FROM $table";
        $result = $this->connection->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($results_array, $row);
            }
        }
        return $results_array;
    }

    function record_exists(string $table, string $id): bool
    {
        $query  = "SELECT * FROM $table WHERE id='$id'";
        $result = $this->connection->query($query);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function record_exists_by_field(string $table, string $field, string $data): bool
    {
        $query  = "SELECT * FROM $table WHERE $field='$data'";
        $result = $this->connection->query($query);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update_record(string $table, array $data, string $id): bool
    {
        $query = "UPDATE $table SET ";
        foreach ($data as $column => $value) {
            $query .= "$column = '$value'";
        }
        $query .= " WHERE id = '$id'";
        return $this->connection->query($query);
    }

    function delete_by_id(string $table, string $id): bool
    {
        $query = "DELETE FROM $table WHERE id='$id'";
        if ($this->connection->query($query) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function get_filtered_records(string $table, array $data, string $operator = 'AND'): array
    {
        $query_str = "SELECT * FROM $table WHERE ";
        foreach ($data as $key => $value) {
            $query_str .= "$key = '$value' $operator ";
        }
        $query_str = substr($query_str, 0, -1 * (strlen($operator) + 2)) . ";";

        $results_array = array();
        $result = $this->connection->query($query_str);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($results_array, $row);
            }
        }
        return $results_array;
    }
}
