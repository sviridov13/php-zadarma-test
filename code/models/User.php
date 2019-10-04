<?php


namespace code\models;


use code\core\Model;

class User extends Model
{
    public function getUserLoginByLogin($login)
    {
        return $this->db->row("SELECT login FROM reference.users WHERE login= :login", ["login" => $login]);
    }

    public function save($login, $password)
    {
        $password = md5(md5(trim($password)));
        $this->db->query("INSERT INTO reference.users SET login = :login, password = :pass", ["login" => $login, "pass" => $password]);
    }

    public function getUserIdAndPasswordByLogin($login)
    {
        return $this->db->oneRow("SELECT user_id, password FROM reference.users WHERE login= :login", ["login" => $login]);
    }

    public function saveHash($hash)
    {
        $this->db->query("UPDATE reference.users SET hash = :userHash", ["userHash" => $hash]);
    }

    public function getUserByHash($hash)
    {
        return $this->db->row('SELECT * from reference.users WHERE hash = :hashcode', ['hashcode' => $hash]);
    }

}