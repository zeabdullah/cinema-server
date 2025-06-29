<?php
require '../connection/connection.php';

abstract class Model
{
    protected int $id;
    protected string $created_at;
    protected string $updated_at;

    protected static string $table_name;
    protected static string $primary_key = "id";

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? -1;
    }

    public static function findById(int $id)
    {
        global $mysqli;

        $sql = sprintf(
            "Select * from %s WHERE %s = ?",
            static::$table_name,
            static::$primary_key
        );

        $query = $mysqli->prepare($sql);
        $query->execute([$id]);

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

    public static function getAll()
    {
        global $mysqli;

        $sql = sprintf("Select * from %s", static::$table_name);

        $query = $mysqli->prepare($sql);
        $query->execute();

        $data = $query->get_result();

        $objects = [];
        while ($row = $data->fetch_assoc()) {
            $objects[] = new static($row);
        }

        return $objects;
    }

    abstract public function save(): bool;

    abstract public static function create(array $data);

    // abstract public function update();

    public function delete(): bool
    {
        if ($this->id === -1) {
            return false;
        }
        global $mysqli;

        $sql = sprintf("DELETE FROM %s WHERE %s = ?", static::$table_name, static::$primary_key);
        return $mysqli->prepare($sql)->execute([$this->id]);
    }

    /**
     * Returns an associative array respresentation of the model
     */
    abstract public function toArray(): array;
}