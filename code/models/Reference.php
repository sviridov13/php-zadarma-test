<?php


namespace code\models;


use code\core\Model;

class Reference extends Model
{
    function findAll($userId)
    {
        $result = $this->db->row("SELECT * from reference.phone_book where user_id = :user_id", ["user_id" => $userId]);
        return $result;
    }

    public function save($email, $phoneNumber, $firstName, $secondName, $photo=null, $userId)
    {
        $this->db->query("INSERT INTO reference.phone_book SET phone_number = :phone_number, first_name = :first_name, 
                                     second_name = :second_name, email = :email, photo = :photo, user_id = :user_id",
            ["phone_number" => $phoneNumber, "email" => $email, "first_name" => $firstName, "second_name" => $secondName, "photo" => $photo, "user_id" => $userId]);
    }

    public function getOneById($id)
    {
        return $this->db->oneRow("SELECT * from reference.phone_book where phone_id = :phone_id", ["phone_id" => $id]);
    }

    public function deleteById($id)
    {
        $this->db->query("DELETE FROM reference.phone_book WHERE phone_id = :phone_id", ["phone_id" => $id]);
    }

    public function updateById($email, $phoneNumber, $firstName, $secondName, $id, $photo=null)
    {
        if ($photo !== null) {
            echo "Test456";
            $this->db->query("UPDATE reference.phone_book SET phone_number = :phone_number, first_name = :first_name, 
                                     second_name = :second_name, email = :email, photo = :photo WHERE phone_id = :phone_id",
                ["phone_number" => $phoneNumber, "email" => $email, "first_name" => $firstName, "second_name" => $secondName, "photo" => $photo, "phone_id" => $id]);
        } else {
            $this->db->query("UPDATE reference.phone_book SET phone_number = :phone_number, first_name = :first_name, 
                                     second_name = :second_name, email = :email WHERE phone_id = :phone_id",
                ["phone_number" => $phoneNumber, "email" => $email, "first_name" => $firstName, "second_name" => $secondName, "phone_id" => $id]);
        }
    }
}