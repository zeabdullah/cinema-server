<?php
require_once('Model.php');

class User extends Model
{
    private string $email;
    private string $first_name;
    private string $last_name;

    protected static string $table_name = 'users';

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->email = $data['email'];
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
    }

    public static function create(array $data)
    {
        global $mysqli;

        $sql = sprintf("INSERT INTO %s values (null, ?, ?, ?, null, null)", static::$table_name);

        $query = $mysqli->prepare($sql);
        $query->bind_param(
            "sss",
            $data['email'],
            $data['first_name'],
            $data['last_name'],
        );
        $query->execute();

        $data['id'] = $query->insert_id;

        return new self($data);
    }
}