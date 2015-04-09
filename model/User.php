<?php
class User
{
    protected $_bdd;

    public function __construct($connection){
        $this->_bdd = $connection;
    }

    public function countUserByNameAndPassword($name, $password){
        $request = $this->_bdd->getPDO()->prepare('SELECT count(*) as id_user_in_base FROM users where name = :name and password = :password');
        $response = $request->execute([
                'name'=> $name,
                'password'=> $password
        ]);
        $row = $request->fetch();
        return $row;
    }
    public function getUserByName($name){
        $request = $this->_bdd->getPDO()->prepare('SELECT *  FROM users where name = :name ');
            $response = $request->execute([
                    'name'=> $name
            ]);
            $row = $request->fetch();
            return $row;
    }
    public function countUserByName($name){
        $request = $this->_bdd->getPDO()->prepare('SELECT count(*) as nb_user FROM users where name = :name ');
        $response = $request->execute([
                'name'=> $name
        ]);
        $row = $request->fetch();
        return $row;
    }

    public function addUser($name, $password){
            $request = $this->_bdd->getPDO()->prepare('INSERT INTO users (name, password) VALUES ( :name, :password)');
            $response = $request->execute([
                    'name'=> $name,
                    'password' =>$password            
            ]); 

    }
}






























