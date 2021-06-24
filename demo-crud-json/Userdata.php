<?php


class Userdata
{
    public static string $pathUser = 'product.json';

    public static function loadData(): array
    {
        $dataJson = file_get_contents(self::$pathUser);
        $data = json_decode($dataJson);
        return self::convertUser($data);

    }

    public static function saveData($data)
    {
        $dataJson = json_encode($data);
        file_put_contents(self::$pathUser, $dataJson);
    }

    public static function convertUser($data): array
    {
        $users = [];
        foreach ($data as $item) {
            $user = new User($item->email, $item->pass);
            array_push($users, $user);
        }
        return $users;

    }

    public static function addUser($user)
    {
        $users = self::loadData();
        array_push($users, $user);
        self::saveData($users);
    }

    public static function checkLog($user): bool
    {
        $users = self::loadData();
        foreach ($users as $item) {
            if ($user->email == $item->email && $user->pass == $item->pass) {
                return true;
            }
        }
        return false;

    }

    public static function login($email, $pass)
    {
        $user = new User($email, $pass);
        if (self::checkLog($user)) {
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $pass;
            header('location:index.php');
        } else {
            echo "<div class='alert alert-danger' role='alert'>
  wrong password or email!
</div>";
        }
    }


}