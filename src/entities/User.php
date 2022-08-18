<?php
include_once(__DIR__ . '/BaseEntity.php');

class User extends BaseEntity
{
    protected string $email;
    protected string $name;
    protected string $address;
    protected UserType $type = UserType::Customer;
    protected string $tableName = 'user';

    function __construct()
    {
        parent::__construct();
    }

    function set_name(string $name): void
    {
        $this->name = $name;
    }

    function set_email(string $email): void
    {
        $this->email = $email;
    }

    function set_address(string $address): void
    {
        $this->address = $address;
    }

    function set_user_type(UserType $userType): void
    {
        $this->type = $userType;
    }

    function get_email(): string
    {
        return $this->email;
    }

    function get_name(): string
    {
        return $this->name;
    }

    function get_address(): string
    {
        return $this->address;
    }

    function get_userType(): UserType
    {
        return $this->type;
    }

    function attributes_to_array(): array{
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'type' => $this->type->value
        ];
    }

    public static function createNew(array $properties): User{
        $user = new User();
        $user->set_name($properties['name']);
        $user->set_email($properties['email']);
        $user->set_address($properties['address']);
        $user->set_user_type($properties['type']);
        return $user;
    }

    public static function register_new_user(User $user, string $password): bool{
        $hashed_pw = password_hash($password, PASSWORD_BCRYPT);
        if ($user->save_to_database()){
            return $user->databaseService->update_record('user',['password'=>$hashed_pw], $user->get_id());
        }
        return false;
    }

    function save_to_database(): bool {
        
        return true;
    }
}

enum UserType: string
{
    case Customer = 'customer';
    case Admin = 'admin';
}
