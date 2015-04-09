<form id="txt" method="post">

<?php if (isset($_POST['name']) && isset($_POST['password'])){
$name = utf8_decode($_POST['name']);
$password = utf8_decode($_POST['password']);
}

if(isset($name) AND isset($password)){
		$row = $user->countUserByName($name);
		if($row['nb_user'] == 0){
			$user->addUser($name, $password);
			echo "Identifiant cree !";
			$row = $user->getUserByName($name);
			$_SESSION['users'] = ['id' => $row['id'], 'user' => $row['name']];
		}else{echo "Identifiant deja utilise";
	}
}
?>


  <br>
Nom : <input type="text" name="name" size="12"><br>
Mot de passe : <input type="password" name="password" size="10"><br>

<input type="submit" value="OK">
</form>
