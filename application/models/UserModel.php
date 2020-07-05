<?php

/**
 * Created by PhpStorm.
 * User: Miko
 * Date: 7/13/2017
 * Time: 1:57 PM
 */
class UserModel extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'users';
    }

    public function check_login($email, $password)
    {
        return $this->db->where(array('email' => $email, 'password' => md5(sha1($password))))->get($this->table)->row();
    }
}