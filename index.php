<?php
    // commence la mise en tampons
    ob_start();
    //affiche les erreurs
    ini_set('error_reporting', E_ALL);

    // démarre la session
    session_start();

    // charge le fichier des fonctions PHP
    require_once 'model/Message.php';
    require_once 'model/User.php';
    require_once 'model/Connection.php';

    // Liste blanche, c'est notre routing qui correspont à nos pages
    $routing = [
        'home' => [
            'controller' => 'home',
            'secure' => false,
            ],
        'inscription' => [
            'controller' => 'subscription',
            'secure' => false,
            ],
        'login' => [
            'controller' => 'login',
            'secure' => false,
            ],

        'message' => [
            'controller' => 'message',
            'secure' => false,
            ],
        'logout' => [
            'controller' => 'logout',
            'secure' => false,
            ],
        '404' => [
            'controller' => '404',
            'secure' => false,
            ],
    ];

    // verifions la pertinance de la page en GET
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        if (!isset($routing[$page])) {
            // la page n'existe pas
            $page = '404';
        }
    } else {
        //page par defaut
        $page = 'home';
    }

    //check pour la sécurité : si la page à la clée 'secure' est true et que $_SESSION['name'] n'est pas définis
    if ($routing[$page]['secure'] === true && !isset($_SESSION['users'])) {
        //Met en session un message informatif
        addMessageFlash('info', 'Veuillez-vous connecter afin d\'accéder à cette page');

        //redirection
        header("location: index.php?page=login");
        exit;
    }
//$bdd = new \PDO('mysql:host=localhost;dbname=MyDB','root','95650');
$connection = new Connection();
$user = new User($connection);
$mess = new Message($connection);

?>
<!doctype html>
<html lang="fr">
<head>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="icon" href="images/arc.png" type="image/png" />
</head>
<body>
    <div id="panneau"> 
        <div class="letter">  
            <p>T</p>  
        </div><!-- 
        --><div class="letter">  
            <p>W</p>  
        </div><!-- 
        --><div class="letter">  
            <p>E</p>  
        </div><!-- 
        --><div class="letter">  
            <p>E</p>  
        </div><!-- 
        --><div class="letter">  
            <p>T</p>  
        </div><!-- 
        --><div class="letter">  
            <p>E</p>  
        </div><!-- 
        --><div class="letter">  
            <p>R</p>  
        </div>  

    </div>  

<ul>
    <li><a href="?page=home" title="home">Home</a></li>
    <li><a href="?page=message" title="message">Message</a></li>
    <li><a href="?page=inscription" title="inscription">inscription</a></li>

<?php if (isset($_SESSION['users'])){
        echo '<li><a href="?page=logout" title="logout">logout</a></li>';
    }else{
        echo '<li><a href="?page=login" title="login">login</a></li>';}
?>
</ul>

<?php

    if (isset($_SESSION['users'])){
    echo "Connecte !";
    }


    // Affiche les flashBag : des messages informatif du genre "votre message a bien été envoyé"
    if (isset($_SESSION['flashBag'])) {
        foreach ($_SESSION['flashBag'] as $type => $flash) {
            foreach ($flash as $key => $message) {
                echo '<div class="'.$type.'" role="'.$type.'" >'.$message.'</div>';
                // un fois affiché le message doit être supprimé
                unset($_SESSION['flashBag'][$type][$key]);
            }
        }
    }

    // Charge la page demandée
    $fileController = 'page/'.$routing[$page]['controller'].'.php';
    if (file_exists($fileController)) {
        require $fileController;
    } else {
        echo 'File is missing';
    }
ob_end_flush(); /* On vide le tampon et on retourne le contenu au client. */
?>
</body>
</html>
