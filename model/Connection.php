<?php
class Connection
{
    static $pdo;


    static function getPDO(){
        if(self::$pdo == null){
          self::$pdo = new \PDO('mysql:host=localhost;dbname=MyDB','root','95650');
          return self::$pdo;
        }else{return self::$pdo;}
    }
    
}


























