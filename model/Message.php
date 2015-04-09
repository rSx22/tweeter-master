<?php
class Message
{
    protected $_bdd;

    public function __construct($connection){
        $this->_bdd = $connection;
    }
public function addMessage($name, $message){
    $request = $this->_bdd->getPDO()->prepare('INSERT INTO messages (message, users_id) SELECT :message, id FROM users WHERE name = :name');
    $response = $request->execute([
            'name'=> $name,
            'message' =>$message               
    ]); 
}
public function getAllMessage(){
    $request = $this->_bdd->getPDO()->query('SELECT `messages`.`message`, `users`.`name` FROM `messages` INNER JOIN `users` ON `messages`.`users_id` = `users`.`id`');
    $messages = $request->fetchAll();
    return $messages;
}
    
}


































function addMessageFlash($type, $message)
{
    // autorise que 4 types de messages flash
    $types = ['success','error','alert','info'];
    if (!in_array($type, $types)) {
        return false;
    }

    // on vérifie que le type existe
    if (!isset($_SESSION['flashBag'][$type])) {
        //si non on le créé avec un Array vide
        $_SESSION['flashBag'][$type] = [];
    }

    // on ajoute le message
    $_SESSION['flashBag'][$type][] = $message;
}

