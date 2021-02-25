<?php
session_start();
require_once 'database.php'; //nawiązanie połączenia
if(isset($_POST['email']))
	{
		$email = filter_input(INPUT_POST, 'email');
		$_SESSION['given_login']=$email;
		$password = filter_input(INPUT_POST, 'password');
		
		$userQuery = $db->prepare('SELECT id, username, password FROM users WHERE email = :email');
		$userQuery->bindValue(':email', $email, PDO::PARAM_STR);
		$userQuery->execute();
		
		$user = $userQuery->fetch(); //wkładanie do tablicy ascojacyjnej 

		if($user!=false && password_verify($password, $user['password'])) //jeżeli tablica ascojacyjna nie jest pusta i haslo soę zgadza, udane logowanie
		{
			$_SESSION['logged_id']=$user['id'];
			unset($_SESSION['bad_attempt']);
			header('Location:biezacymiesiac.php');
		}
		else
		{
			$_SESSION['bad_attempt']=true;
			header('Location:logowanie.php');
			exit();
		}
	}
else
	{
		header('Location:logowanie.php');
		exit();
	}
?>

