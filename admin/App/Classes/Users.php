<?php

namespace App\Classes;

use App\Traits\validate;
use PDO;


class Users extends Database
{
    use validate;
    private $name, $email, $password, $profilePicture, $isAdmin, $errors;

    public function __set($key, $value)
    {
        if (property_exists($this, $key)) {
            $value = htmlspecialchars(($value));
            $this->$key = $value;
        } else {
            echo "not found";
        }
    }

    public function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->$key;
        }
    }

    public function addUser()
    {
        $this->checkExist();
        if (empty($this->errors)) {
            $result = $this->runDataBase("INSERT INTO users (name,email,password,profirPicturePath,isAdmin) VALUES ('$this->name','$this->email','$this->password','$this->profilePicture','$this->isAdmin');");

            return $result;

        } else {
            return $this->errors;
        }
    }

    public function showUser()
    {
        $this->checkPasswordExist();
        if (empty($this->errors)) {
            $result = $this->runDataBase("SELECT * FROM users WHERE email = '$this->email' AND password = '$this->password'");
            return $result;
        } else {
            return $this->errors;
        }
    }

    public function showUser2()
    {
        $result = $this->runDataBase("SELECT * FROM users");
        // return $result;
        return $result->fetchAll(PDO::FETCH_ASSOC);
        ;

    }

    public function showUserByEmail($em)
    {
        $result = $this->runDataBase("SELECT * FROM users WHERE email = '$em'");
        return $result->fetchAll(PDO::FETCH_ASSOC);

    }

    public function destroy($id)
    {
        $result = $this->runDataBase("DELETE FROM users WHERE id = $id");

    }

    public function showById($id)
    {
        $result = $this->runDataBase("SELECT * FROM users WHERE id = $id");
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    public function update($id)
    {
        $result = $this->runDataBase("UPDATE `users` SET `name`='$this->name' , `email`='$this->email' , `password`='$this->password' , `profirPicturePath`='$this->profilePicture' WHERE id=$id");
        if ($result) {
            return "updated";
        } else {
            return "failed";
        }
    }

}