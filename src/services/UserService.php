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
        if (isset($properties['id'])) $user->set_id($properties['id']);
        return $user;
    }

    private function create_user_from_record(array $user_arr): User | NULL
    {
        if (!$user_arr) return NULL;
        else {
            $user_arr['type'] = $user_arr['type'] === 'admin' ? UserType::Admin : UserType::Customer;
            $user = $this->create_new($user_arr);
            return $user;
        }
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
        if (count($user_arr) === 1) $user_arr = $user_arr[0];
        return $this->create_user_from_record($user_arr);
    }

    public function get_user_by_id(string $id): User | NULL
    {
        $user_arr = $this->databaseService->retrieve_by_id($this->table_name, $id);
        return $this->create_user_from_record($user_arr);
    }

    public function verify_user_password(string $password, string $user_id): bool
    {
        $user_arr = $this->databaseService->retrieve_by_id($this->table_name, $user_id);
        if (!$user_arr) return false;
        else return password_verify($password, $user_arr['password']);
    }
}
