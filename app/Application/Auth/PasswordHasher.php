<?php
namespace App\Application\Auth;

interface PasswordHasher
{
    /**
     * @param $password
     * @return string
     */
    public function hash($password);

    /**
     * @param $password
     * @param $hashed
     *
     * @return bool
     */
    public function check($password, $hashed);
}
