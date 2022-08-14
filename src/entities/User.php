<?php
include_once(__DIR__ . '/BaseEntity.php');

class User extends BaseEntity
{
    protected string $email;
    protected string $name;
    protected string $address;
    protected UserType $type = UserType::Customer;
    protected static string $tableName = 'user';

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
}

enum UserType: string
{
    case Customer = 'customer';
    case Admin = 'admin';
}
