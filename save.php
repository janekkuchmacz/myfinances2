<?php

session_start();

if (isset($_POST['email']))
{
		
		//zakładamy udaną walidację
		$wszystko_OK=true;
		
		//sprawdzanie imienia
		$name=$_POST['name'];
		//sprawdzenie dlugosci imienia
		if((strlen($name)<3) || (strlen($name)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_name']="Imię musi posiadać od 3 do 20 znaków!";
		}
		
		if(ctype_alpha($name)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_name']="Imię może składać się tylko z liter (bez polskich znaków)!";
		}		
		
		//sprawdzania emaila
		$email=$_POST['email'];
		$emailB= filter_var($email, FILTER_SANITIZE_EMAIL); //usuwa niedozwolone znaki z adresu email
		if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres email!";
		}
		//sprawdzanie czy emaila nie ma w bazie
		require_once 'database.php'; //nawiązanie połączenia
			//wyjmowanie adresów z users jeżeli jesteśmy zalogowani
		$usersQuery=$db->query('SELECT id,email FROM users'); //otrzymujemy obiekt klasy PDO statement 
		$users=$usersQuery->fetchAll();
		$registered_user_ID=1; //nadanie ID pierwszermu userowi
		foreach($users as $userr)
			{
				if($userr['email']==$email)
				{
					$wszystko_OK=false;
					$_SESSION['e_email']="Email jest już w bazie!";
				}
				$registered_user_ID=$userr['id']+1;
			}			
		//sprawdzanie hasla
		$password=$_POST['password'];
		if((strlen($password)<8)||(strlen($password)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_pass']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		//zapamiętaj wprowadzone dane
		$_SESSION['fr_name'] = $name;
		$_SESSION['fr_email'] = $email;
		if($wszystko_OK==true)
		{
			//hashowania hasła
			$password_hash=password_hash($password, PASSWORD_DEFAULT);
			$query = $db->prepare('INSERT INTO users VALUES(NULL, :username, :password, :email)');
			$query->bindValue(':username', $name, PDO::PARAM_STR);
			$query->bindValue(':password', $password_hash, PDO::PARAM_STR);
			$query->bindValue(':email', $email, PDO::PARAM_STR);
			$query->execute();
			// rejestruje się nowy użytkownik, a my kopiujemy domyślne kategorie z tabeli ..._default do tabeli:..._assigned_to_users i wówczas w tej tabeli możesz dowolnie edytować te kategorie
			
			$incomesQuery=$db->query('SELECT name FROM incomes_category_default'); //otrzymujemy obiekt klasy PDO statement 
			$incomescategories=$incomesQuery->fetchAll();
			foreach ($incomescategories as $incomecategory)
			{
				$incategory=$incomecategory['name'];
				$db->query("INSERT INTO incomes_category_assigned_to_users (user_id, name) VALUES ('$registered_user_ID', '$incategory')");
			}
			$paymentQuery=$db->query('SELECT name FROM payment_methods_default'); //otrzymujemy obiekt klasy PDO statement 
			$paymentcategories=$paymentQuery->fetchAll();
			foreach ($paymentcategories as $paymentcategory)
			{
				$paycategory=$paymentcategory['name'];
				$db->query("INSERT INTO payment_methods_assigned_to_users (user_id, name) VALUES ('$registered_user_ID', '$paycategory')");
			}
			$expensesQuery=$db->query('SELECT name FROM expenses_category_default'); //otrzymujemy obiekt klasy PDO statement 
			$expensecategories=$expensesQuery->fetchAll();
			foreach ($expensecategories as $expensecategory)
			{
				$excategory=$expensecategory['name'];
				$db->query("INSERT INTO expenses_category_assigned_to_users (user_id, name) VALUES ('$registered_user_ID', '$excategory')");
			}
			
			
			
			/*$db->query("INSERT INTO incomes_category_assigned_to_users (name) select (name) FROM incomes_category_default");
			$db->query("UPDATE incomes_category_assigned_to_users SET user_id='$registered_user_ID' WHERE user_id=0");
			
			for($i=1; $i<=4; $i++)
			{
				$query2=$db->prepare('INSERT INTO incomes_category_assigned_to_users (user_id) VALUES (:user_id WHERE user_id=0)');
				$query2->bindValue(':user_id', $registered_user_ID, PDO::PARAM_STR);
				$query2->execute();			
			}
			*/
			
			
		}
		else
		{
			header('Location:rejestracja.php');
			exit();
		}
}
else
{
			header('Location:rejestracja.php');
			exit();
}



?>
<!DOCTYPE html>
<html lang="pl">
<head>

    <meta charset="utf-8">
    <title>Zapisanie się do newslettera</title>
    <meta name="description" content="Używanie PDO - zapis do bazy MySQL">
    <meta name="keywords" content="php, kurs, PDO, połączenie, MySQL">

    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="main.css">
	<link rel="stylesheet" href="css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&amp;subset=latin-ext" rel="stylesheet">
	
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->

</head>

<body>

<header>
	
		<nav class="navbar navbar-dark bg-nav navbar-expand-lg">
		
			<a class="navbar-brand" href="menubootstrap.html"><i class="icon-money2 d-inline-block mr-1 align-center"></i><span class="logo">mojefinanse.com</span></a>
		
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
				<span class="navbar-toggler-icon"></span>
			</button>
		
			<div class="collapse navbar-collapse" id="mainmenu">
			
				<ul class="navbar-nav">
				
					<li class="nav-item  ml-xl-5 mr-2">
						<a class="nav-link disabled" href="#"><i class="icon-plus"></i>Dodaj przychód</a>
					</li>
					
					<li class="nav-item mr-2">
						<a class="nav-link disabled" href="#"><i class="icon-minus"></i>Dodaj wydatek</a>
					</li>
					
					<li class="nav-item mr-2">
						<a class="nav-link disabled" href="#"><i class="icon-balance-scale"></i> Wyświetl bilans</a>
					</li>
					
					<li class="nav-item mr-2">
						<a class="nav-link disabled" href="#"><i class="icon-cog"></i>Ustawienia</a>
					</li>
					
					<li class="nav-item mr-2">
						<a class="nav-link disabled" href="#"><i class="icon-logout"></i>Wyloguj</a>
					</li>
				
				</ul>
			
			</div>
		
		</nav>
	
	</header>
	
	<main>
		
		<article>
		
			<div class="container">
			
				<div class="row">
				
					
					<div class="col-lg-10 text-center wpis">
					
							<header>
						
								<h1 class="ml-0 mb-4">Witaj w mojefinanse.com!</h1>
								
								<h2 class="ml-0 mb-4"><i class="icon-money1"></i></h2>
						
							</header>
											
							<h2>Zaloguj się na swoje konto!</h2>
							
							<a class="rejestracja my-4 mx-auto text-uppercase" href="logowanie.php">Logowanie</a>
										
						<footer>
		
							<div class="info">
								Wszelkie prawa zastrzeżone &copy; 2021 Dziękuję za wizytę!
							</div>
	
						</footer>
					
					</div>
					
					<aside class="col-lg-2 d-none d-lg-block asideboczny">
					
						<img class ="img-fluid my-2" src="img/ad.jpg" alt="Reklama">
						
						<ul class="list-group"> 
							<li class="list-group-item list-group-item-dark"><i class="icon-plus"></i>Dodaj przychód</li>
							<li class="list-group-item list-group-item-dark"><i class="icon-minus"></i>Dodaj wydatek</li>
							<li class="list-group-item list-group-item-dark"><i class="icon-balance-scale"></i> Wyświetl bilans</li>
							<li class="list-group-item list-group-item-dark"><i class="icon-cog"></i>Ustawienia</li>
						</ul>
					
					<aside>
				
				</div>
			
			</div>
		
		</article>
		
	</main>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js"></script>
    

</body>
</html>