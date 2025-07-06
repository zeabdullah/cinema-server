<?php
require_once '../connection/Database.php';
require_once '../helpers/helpers.php';

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
        $db = Database::getInstance();

        $sql = sprintf(
            "SELECT * FROM %s WHERE %s = ?",
            static::$table_name,
            static::$primary_key
        );

        $query = $db->prepare($sql);
        $query->execute([$id]);

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

    public static function getAll()
    {
        $db = Database::getInstance();

        $sql = sprintf("SELECT * FROM %s", static::$table_name);

        $query = $db->prepare($sql);
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
        $db = Database::getInstance();

        [$joinedCols, $placeholders] = getJoinedSqlStrings($data);
        $sql =
            sprintf(
                "INSERT INTO %s (%s) values (%s)",
                static::$table_name,
                $joinedCols,
                $placeholders
            );

        $query = $db->prepare($sql);
        $query->execute(array_values($data));

        return $query->insert_id;
    }

    public function update($data): bool
    {
        if ($this->id === -1)
            return false;

        unset($data['id']);

        $sqlSetColumnsArr = array_fill(0, count($data), "%s=?");
        $sqlSetColumnsStr = implode(',', $sqlSetColumnsArr);
        $sqlSetColumnsStrFormatted = sprintf($sqlSetColumnsStr, ...array_keys($data));

        $sql = sprintf(
            "UPDATE %s
            SET %s
            WHERE %s = ?",
            static::$table_name,
            $sqlSetColumnsStrFormatted,
            static::$primary_key
        );

        $db = Database::getInstance();
        $isSuccessful = $db->prepare($sql)->execute([...array_values($data), $this->id]);
        return $isSuccessful;
    }

    public static function deleteById(int $id): bool
    {
        $db = Database::getInstance();

        $sql = sprintf(
            "DELETE FROM %s WHERE %s = ?",
            static::$table_name,
            static::$primary_key
        );
        return $db->prepare($sql)->execute([$id]);
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