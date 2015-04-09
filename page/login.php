<form id="txt" method="post">
<?php if(isset($_POST['name']) && isset($_POST['password'])){
	
	$name = utf8_decode($_POST['name']);
	$password = utf8_decode($_POST['password']);
$userinbase = $user->countUserByNameAndPassword($name, $password);

	if ($userinbase['id_user_in_base']){
		$userInfo = $user->getUserByName($name);
		$_SESSION['users'] = ['id' => $userInfo['id'], 'user' => $userInfo['name']];
		echo "Connecte !";
	}else{echo "Mauvais identifiant ou mot de passe";}
}
?>



  <br>
Nom : <input type="text" name="name" size="12"><br>
Mot de passe : <input type="password" name="password" size="10"><br>

<input type="submit" value="OK">
</form>

