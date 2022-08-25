<?php
include_once(__DIR__ . "/../services/EntityService.php");

class UserService extends EntityService
{
    protected string $table_name = 'user';

    function __construct()
    {
        parent::__construct();
    }

    public function create_new(array $properties): User
    {
        $user = new User();
        $user->set_name($properties['name']);
        $user->set_email($properties['email']);
        $user->set_address($properties['address']);
        $user->set_user_type($properties['type']);
        return $user;
    }

    public function register_new_user(User $user, string $password): bool
    {
        $hashed_pw = password_hash($password, PASSWORD_BCRYPT);
        if ($this->save_to_database($user)) {
            return $this->databaseService->update_record($this->table_name, ['password' => $hashed_pw], $user->get_id());
        }
        return false;
    }

    public function get_user_by_email(string $email): User | NULL
    {
        $user_arr = $this->databaseService->retrieve_by_field($this->table_name, 'email', $email);
        if (!$user_arr) return NULL;
        else {
            $user_arr['type'] = $user_arr['type'] === 'admin' ? UserType::Admin : UserType::Customer;
            $user = $this->create_new($user_arr);
            return $user;
        }
    }
}
