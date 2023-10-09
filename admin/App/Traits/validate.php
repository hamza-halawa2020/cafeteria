<?php

namespace App\Traits;

use App\Classes\Database;

trait validate
{

    public function checkName($res)
    {
        if (empty($res)) {
            return "plesae write your name.";

        } else if (is_numeric($res)) {
            return "name invalid , must be string";
        }
    }

    public function checkEmail($res)
    {
        $email = $_POST["email"];

        if (empty($res)) {
            return "Please write your email.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid Email.";
        }


    }


    public function checkExist()
    {

        $result = $this->runDataBase("SELECT * FROM users WHERE email= '$this->email'");

        if ($result->rowCount() > 0) {
            $this->errors[] = "this user ie exist please log in";
        }
    }

    public function checkPasswordExist()
    {

        $result = $this->runDataBase("SELECT * FROM users WHERE email= '$this->email'");
        $result2 = $this->runDataBase("SELECT * FROM users WHERE password= '$this->password'");

        if ($result->rowCount() > 0 && $result2->rowCount() > 0) {
            $this->errors[] = "this user ie exist please log in";
        }
    }

    public function checkPassword($res)
    {
        $passwordPattern = "/^[a-z_]{7}$/";
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        if (empty($res)) {
            return "Please write your Password.";
        } else if (!preg_match($passwordPattern, $res)) {
            return "Passwords must be 7 charachters.";
        } else if ($confirmPassword !== $password) {
            return "Passwords do not match.";
        }
    }
    public function checkLoginPassword($res)
    {
        $passwordPattern = "/^[a-z_]{7}$/";
        if (empty($res)) {
            return "Please write your Password.";
        } else if (!preg_match($passwordPattern, $res)) {
            return "Passwords must be 7 charachters.";
        }
    }
}