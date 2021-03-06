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
	
	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->
	
	<script>
	
		function odliczanie()
		{
			var dzisiaj = new Date();
			
			var dzien = dzisiaj.getDate();
			var miesiac = dzisiaj.getMonth()+1;
			var rok = dzisiaj.getFullYear();
			
			if(dzien<10){
							dzien='0'+dzien;
						} 
			if(miesiac<10){
							miesiac='0'+miesiac;
							} 
			document.getElementById("data").defaultValue = rok+'-'+miesiac+'-'+dzien;
			
			setTimeout("odliczanie()", 1);
		}
		
	
	</script>
	
</head>

<body onload="odliczanie();">

	<header>
	
		<nav class="navbar navbar-dark bg-nav navbar-expand-lg">
		
			<a class="navbar-brand" href="menubootstrap.html"><i class="icon-money2 d-inline-block mr-1 align-center"></i><span class="logo">mojefinanse.com</span></a>
		
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
				<span class="navbar-toggler-icon"></span>
			</button>
		
			<div class="collapse navbar-collapse" id="mainmenu">
			
				<ul class="navbar-nav">
				
					<li class="nav-item ml-xl-5 mr-2">
						<a class="nav-link" href="przychod.php"><span class="aktywny"><i class="icon-plus"></i>Dodaj przychód</span></a>
					</li>
					
					<li class="nav-item mr-2">
						<a class="nav-link" href="wydatek.php"><i class="icon-minus"></i>Dodaj wydatek</a>
					</li>
					
					<li class="nav-item mr-2">
						<a class="nav-link" href="biezacymiesiac.php"><i class="icon-balance-scale"></i> Wyświetl bilans</a>
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
				
					
					<div class="col-lg-10 wpis">
					
						<header>
						
							<h1 class="text-center text-lg-left ml-0">Dodaj przychód</h1>
							
						</header>
					
						<form action="dodajprzychod.php" method="post">
					
							<div class="col-lg-6 pole d-inline-block ml-0">
								<label>Podaj kwotę: <input type="number" step="0.01" placeholder="kwota w zł" onfocus="this.placeholder=''" onblur="this.placeholder='kwota w zł'" name="kwota" required><label>
							</div>
							<div class="col-lg-4 d-none d-lg-inline-block">
								<i class="icon-money3"></i><i class="icon-plus1"></i><i class="icon-money4"></i>
							</div>
							<div class="pole ml-3">
								<label>Podaj datę: <input type="date"  id="data" name="dzien" required></label>
							</div>
							<div class="kategoriaprzychodu">
													
									<h2 class="text-center text-lg-left">Kategoria przychodu</h2>
								
									<div><label><input type="radio" value="Salary" name="przychod" checked> Wynagrodzenia</label></div>
									<div><label><input type="radio" value="Interest" name="przychod"> Odsetki bankowe</label></div>
									<div><label><input type="radio" value="Allegro" name="przychod"> Sprzedaż na allegro</label></div>
									<div><label><input type="radio" value="Another" name="przychod"> Inna</label></div>
								
							</div>
																	
							<div class="komentarze ml-3">
							<h2 class="text-center text-lg-left">Komentarz (opcjonalnie)</h2>
							<textarea name="komentarz" id="komentarz" rows="2" cols="40"></textarea>
							</div>
						
							<div class="przyciskiWydatek">
							
								<div class="col-md-5 d-inline-block mb-md-3"><input type="submit" value="Dodaj przychód"></div>
							
								<div class="col-md-1 offset-md-3  d-inline-block">
								<a class="anuluj" href="bilans.html">Anuluj</a>
								</div>								
							
							</div>
												
						</form>	
																	
						<footer>
		
							<div class="info my-md-5">
								Wszelkie prawa zastrzeżone &copy; 2021 Dziękuję za wizytę!
							</div>
	
						</footer>
					
					</div>
					
					<aside class="col-lg-2 d-none d-lg-block asideboczny">
					
						<img class ="img-fluid my-2" src="img/ad.jpg" alt="Reklama">
						
						<ul class="list-group">
							<a href="przychod.php" class="list-group-item list-group-item-dark list-group-item-action active"><i class="icon-plus"></i>Dodaj przychód</a>
							<a href="wydatek.php" class="list-group-item list-group-item-dark list-group-item-action"><i class="icon-minus"></i>Dodaj wydatek</a>
							<a href="biezacymiesiac.php" class="list-group-item list-group-item-dark list-group-item-action"><i class="icon-balance-scale"></i> Wyświetl bilans</a>
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