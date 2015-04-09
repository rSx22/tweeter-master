<form id="txt" method="post">
  <br>
Identifiant : 
<?php 
if (isset($_SESSION['users']['user'])){
	echo $_SESSION['users']['user'];
	$name = $_SESSION['users']['user'];
	 

		if (isset($_POST['message'])){
			$message = $_POST['message'];
			$mess->addMessage($name, $message);
			echo "<br>Message envoyé !";	
		}

}else{
echo "Non identifié";
}

?>
<br>
Message : <input type="text" name="message" size="10"><br>

<input type="submit" value="OK">
</form>
<?php require_once 'home.php';?>
