<?php
include_once("./BaseEntity.php");

class User extends BaseEntity
{
    private string $email;
    private string $name;
    private string $address;
    private UserType $type;


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

enum UserType
{
    case Customer;
    case Admin;
}
