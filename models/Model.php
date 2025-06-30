<?php
require_once '../connection/connection.php';

abstract class Model
{
    protected int $id;
    protected string $created_at;
    protected string $updated_at;

    protected static string $table_name;
    protected static string $primary_key = "id";

    protected const LIMIT = 20;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? -1;
    }

    public static function findById(int $id)
    {
        global $mysqli;

        $sql = sprintf(
            "SELECT * FROM %s WHERE %s = ?",
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

        $sql = sprintf("SELECT * FROM %s", static::$table_name);

        $query = $mysqli->prepare($sql);
        $query->execute();

        $data = $query->get_result();

        $objects = [];
        while ($row = $data->fetch_assoc()) {
            $objects[] = new static($row);
        }

        return $objects;
    }

    public function save(): bool
    {
        if ($this->id === -1) {
            return false;
        }

        $data = $this->toArray();
        unset($data['id']); // to prevent db insertion with ID '-1'

        $this->id = static::insert($data);

        return true;
    }

    public static function create(array $data)
    {
        $data['id'] = static::insert($data);
        return new static($data);
    }

    private static function insert(array $data)
    {
        global $mysqli;

        [$joinedCols, $placeholders] = getJoinedSqlStrings($data);
        $sql =
            sprintf(
                "INSERT INTO %s (%s) values (%s)",
                static::$table_name,
                $joinedCols,
                $placeholders
            );

        $query = $mysqli->prepare($sql);
        $query->execute(array_values($data));

        return $query->insert_id;
    }

    // TODO: Fix and implement
    // public function update($data)
    // {
    //     if ($this->id === -1) {
    //         return false;
    //     }
    //     unset($data['id']);

    //     global $mysqli;

    //     $sql = sprintf(
    //         "UPDATE %s
    //         SET ?
    //         WHERE %s = ?",
    //         static::$table_name,
    //         static::$primary_key
    //     );
    //     $colValArr = array_map(fn(string $col, string $v) => "$col=$v", array_keys($data), array_values($data));
    //     $joinedColValString = implode(',', $colValArr);
    //     var_dump($joinedColValString);

    //     if ($mysqli->prepare($sql)->execute([$joinedColValString, $this->id])) {
    //         return static::findById($this->id);
    //     }

    //     return false;
    // }

    public static function deleteById(int $id): bool
    {
        global $mysqli;

        $sql = sprintf(
            "DELETE FROM %s WHERE %s = ?",
            static::$table_name,
            static::$primary_key
        );
        return $mysqli->prepare($sql)->execute([$id]);
    }

    public function delete(): bool
    {
        if ($this->id === -1) {
            return false;
        }
        return static::deleteById($this->id);
    }

    /**
     * Returns an associative array respresentation of the model
     */
    abstract public function toArray(): array;
}