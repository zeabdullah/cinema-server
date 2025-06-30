<?php
require_once 'Model.php';

class User extends Model
{
    private string $email;
    private string $password;
    private string $first_name;
    private string $last_name;

    protected static string $table_name = 'users';

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->email = $data['email'];
        $this->password = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getFirstName()
    {
        return $this->first_name;
    }
    public function getLastName()
    {
        return $this->last_name;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * Sets a hashed version of the given plain-text password
     * @param string $plainPassword
     * @return void
     */
    public function setPassword(string $plainPassword)
    {
        $this->password = password_hash($plainPassword, PASSWORD_BCRYPT);
    }
    public function setFirstName(string $first_name)
    {
        $this->first_name = $first_name;
    }
    public function setLastName(string $last_name)
    {
        $this->last_name = $last_name;
    }

    public static function auth(string $email, string $password)
    {
        global $mysqli;
        $sql = sprintf("SELECT id, email, password, first_name, last_name FROM %s where email like ?", static::$table_name);

        $query = $mysqli->prepare($sql);
        $query->execute([$email]);

        $data = $query->get_result()->fetch_assoc();

        if (is_array($data)) {
            return password_verify($password, $data['password']) ? new self($data) : false;
        }

        return false;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ];
    }
}