<?php

class User extends BaseModel
{
    /** find user by email */
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email',$email);

        $user = $this->db->getResult();

        if ($this->db->getRowCount() > 0){
            return true;
        }

        return false;
    }

    /** register function */
    public function registerUser($data){

        $sql = "INSERT INTO users(name,email,password,created_at) VALUES(:name,:email,:password,NOW())";
        $this->db->query($sql);

        $this->db->bind(':name',$data['name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);

        return $this->db->execute();
    }

    public function login($email,$password)
    {
        $sql = "SELECT * FROM users WHERE email= :email";
        $this->db->query($sql);
        $this->db->bind(':email',$email);

        $user = $this->db->getResult();

        $user_password = $user->password;
        $hashed_password = md5($password);

        if ($user_password == $hashed_password){
            return $user;
        }

        return false;
    }
}