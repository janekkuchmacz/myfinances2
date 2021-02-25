<?php
session_start();

if(!isset($_SESSION['logged_id']))
{
	header('Location:logowanie.php');
	exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<title>Moje finanse</title>
	<meta name="description" content="Aplikacja służąca do prowadzenia budżetu domowego">
	<meta name="keywords" content="budżet domowy, finase, oszczędności, balans, fianse, zarządzanie własnymi finansami, pieniądze">
	<meta name="author" content="Jan Kowalski">
	<meta http-equiv="X-Ua-Compatible" content="IE=edge">
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&amp;subset=latin-ext" rel="stylesheet">
	
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	
	
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
				
					<li class="nav-item ml-xl-5 mr-2">
						<a class="nav-link" href="przychod.php"><i class="icon-plus"></i>Dodaj przychód</a>
					</li>
					
					<li class="nav-item mr-2">
						<a class="nav-link" href="wydatek.php"><i class="icon-minus"></i>Dodaj wydatek</a>
					</li>
					
					<li class="nav-item mr-2">
						<a class="nav-link" href="biezacymiesiac.php"><span class="aktywny"><i class="icon-balance-scale"></i> Wyświetl bilans</span></a>
					</li>
					
					<li class="nav-item mr-2">
						<a class="nav-link" href="#"><i class="icon-cog"></i>Ustawienia</a>
					</li>
					
					<li class="nav-item mr-2">
						<a class="nav-link" href="logout.php"><i class="icon-logout"></i>Wyloguj</a>
					</li>
				
				</ul>
			
			</div>
		
		</nav>
	
	</header>
	
	<main>
		
		<article>
		
		<div class="container">
			
				<div class="row">
									
					<div class="col-lg-10  wpis">
					
						<div>
							<header>
					
							<h1 class="ml-0">Przeglądaj bilans</h1>
								
							</header>
						
							<div id="dropdown">
								<a href="#">Wybierz okres czasu</a>
								<ul>
									   <li><a href="biezacymiesiac.php">Bieżący miesiąc</a></li>
									   <li><a href="poprzednimiesiac.php">Poprzedni miesiąc</a></li>
									   <li><a href="biezacyrok.php">Bieżący rok</a></li>
									   <li><a href="niestandardowy.php">Niestandardowy</a></li>
								  </ul>
							</div>
						</div>
						<div class="col-lg-12 d-none d-lg-block text-center">
							<i class="icon-balance-scale1"></i>
						</div>
						<div id="zakres" class="text-center">
							
							<h1 class="ml-0">Podaj zakres</h1><form action="niestandardowy.php" method="post"><div class="pole"><label>Data początkowa: <input type="date"  class="data" name="poczatek" id="poczatek1" required></label></div><div class="pole"><label>Datę końcowa: <input type="date"  class="data" name="koniec" id="koniec1" required></label></div><div><div class="przycisk"><input type="submit" value="Wyświetl bilans"></div></div></form>
								
						</div>

					
							
							<footer>
		
							<div class="info mt-lg-5">
								Wszelkie prawa zastrzeżone &copy; 2021 Dziękuję za wizytę!
							</div>
	
							</footer>
							
					</div>
										
				
					
					<aside class="col-lg-2 d-none d-lg-block asideboczny">
					
						<img class ="img-fluid my-2" src="img/ad.jpg" alt="Reklama">
						
						
						<ul class="list-group">
							<a href="przychod.php" class="list-group-item list-group-item-dark list-group-item-action"><i class="icon-plus"></i>Dodaj przychód</a>
							<a href="wydatek.php" class="list-group-item list-group-item-dark list-group-item-action"><i class="icon-minus"></i>Dodaj wydatek</a>
							<a href="biezacymiesiac.php" class="list-group-item list-group-item-dark list-group-item-action active"><i class="icon-balance-scale"></i> Wyświetl bilans</a>
							<a href="#" class="list-group-item list-group-item-dark list-group-item-action"><i class="icon-cog"></i>Ustawienia</a>
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