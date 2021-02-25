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
	
	<script src="funkcje.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
	
	</script>
	
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
						<a class="nav-link" href="bilans.php"><span class="aktywny"><i class="icon-balance-scale"></i> Wyświetl bilans</span></a>
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
					
						<div class="col-lg-6 d-inline-block">
							<header>
					
							<h1 class="ml-0">Przeglądaj bilans</h1>
								
							</header>
						
							<div id="dropdown">
								<a href="#">Wybierz okres czasu</a>
								<ul>
									   <li><a href="biezacymiesiac.php">Bieżący miesiąc</a></li>
									   <li><a href="#" onclick="wyswietlTabele2()">Poprzedni miesiąc</a></li>
									   <li><a href="#" onclick="wyswietlTabele3()">Bieżący rok</a></li>
									   <li><a href="#" onclick="niestandardowy()">Niestandardowy</a></li>
								  </ul>
							</div>
						</div>
						<div class="col-lg-4 d-none d-lg-inline-block">
							<i class="icon-balance-scale1"></i>
						</div>
							<div id="zakres" class="text-center">
							
							<h1 class="ml-0">Podaj zakres</h1><form action="daterange.php" method="post"><div class="pole"><label>Data początkowa: <input type="date"  class="data" name="poczatek" id="poczatek1" required></label></div><div class="pole"><label>Datę końcowa: <input type="date"  class="data" name="koniec" id="koniec1" required></label></div><div><div class="przycisk"><input type="button" value="Wyświetl bilans" onclick="wyswietlTabele4()"></div></div></form>
								
							</div>
							<div id="okresczasu">
								<span class="bilansdla">Bilans dla: </span> <span class="kolumnytabeli">bieżącego miesiąca</span>
							</div>									
							<div id="tabelaPrzychody">
									
										<table>
										
										<tr>
										<td colspan="2"><span class="tytultabeliprzychody">Przychody</span></td>
										</tr>
										<tr>
										<td><span class="kolumnytabeli">Kategoria</span></td>
										<td><span class="kolumnytabeli">Przychód</span></td>
										</tr>
										<tr>
										<td>Wynagrodzenie</td>
										<td>2500,58 zł</td>
										</tr>
										<tr>
										<td>Odsetki bankowe</td>
										<td>1500,48 zł</td>
										</tr>
										<tr>
										<td>Sprzedaż na allegro</td>
										<td>480,95 zł</td>
										</tr>
										<tr>
										<td>Inne</td>
										<td>180,45 zł</td>
										</tr>
										<tr>
										<td><span class="tytultabeliprzychody">Suma</span></td>
										<td><span class="tytultabeliprzychody">3857,12 zł</span></td>
										</tr>
																	
										</table>
																	
							</div>
							
							<div id="wydatki">
								<div id="tabelaWydatki" class="col-lg-6 d-inline-block">
								
									<table>
									
									<tr>
									<td colspan="2"><span class="tytultabeliwydatki">Wydatki</span></td>
									</tr>
									<tr>
									<td><span class="kolumnytabeli">Kategoria</span></td>
									<td><span class="kolumnytabeli">Wydatek</span></td>
									</tr>
									<tr>
									<td>Jedzenie</td>
									<td>1000,58 zł</td>
									</tr>
									<tr>
									<td>Mieszkanie</td>
									<td>860,29 zł</td>
									</tr>
									<tr>
									<td>Transport</td>
									<td>480,95 zł</td>
									</tr>
									<tr>
									<td>Telekomunikacja</td>
									<td>80,45 zł</td>
									</tr>
									<tr>
									<td>Opieka zdrowotna</td>
									<td>280,45 zł</td>
									</tr>
									<tr>
									<td>Ubranie</td>
									<td>160,45 zł</td>
									</tr>
									<tr>
									<td>Higiena</td>
									<td>100,45 zł</td>
									</tr>
									<tr>
									<td>Dzieci</td>
									<td>200,45 zł</td>
									</tr>
									<tr>
									<td>Rozrywka</td>
									<td>50,85 zł</td>
									</tr>
									<tr>
									<td>Wycieczka</td>
									<td>320,45 zł</td>
									</tr>
									<tr>
									<td>Szkolenia</td>
									<td>52,45 zł</td>
									</tr>
									<tr>
									<td>Książki</td>
									<td>20,25 zł</td>
									</tr>
									<tr>
									<td>Oszczędności</td>
									<td>400,00 zł</td>
									</tr>
									<tr>
									<td>Złota jesień</td>
									<td>300,50 zł</td>
									</tr>
									<tr>
									<td>Spłata długów</td>
									<td>0,00 zł</td>
									</tr>
									<tr>
									<td>Darowizna</td>
									<td>50,50 zł</td>
									</tr>
									<tr>
									<td>Inne</td>
									<td>100,45 zł</td>
									</tr>
									<tr>
									<td><span class="tytultabeliwydatki">Suma</span></td>
									<td><span class="tytultabeliwydatki">2658,17 zł</span></td>
									</tr>
																
									</table>															
								</div>
								<div class="col-lg-4 mt-4 d-lg-inline-block wykres">
										<div id="piechart" style="width:350px; height: 670px;"></div>
								</div>
							</div>
							<div id="bilansfinalny">
								<div id="bilanskoncowy" class="col-lg-6 d-inline-block">
										<span class="kolumnytabeli"><i class="icon-balance-scale"></i>  Bilans </span>
										<br/>
										<span class="kolumnytabeli">Przychody:</span><span class="tytultabeliprzychody"> 3857,12 zł</span><br/>
										<span class="kolumnytabeli">Wydatki:</span> <span class="tytultabeliwydatki">2658,17 zł </span><br/>
										<span class="kolumnytabeli">Zaoszczędziłeś:</span> <span class="tytultabeliprzychody">1198,95 zł</span><br/>
								</div>
								<div id="twojbilans" class="col-lg-4 d-inline-block mt-3 text-center">
										<i class="icon-money4"></i><i class="icon-plus1"></i><i class="icon-money5"></i>
								</div>
							</div>
							
							<footer>
		
							<div class="info">
								Wszelkie prawa zastrzeżone &copy; 2021 Dziękuję za wizytę!
							</div>
	
							</footer>
							
					</div>
										
				
					
					<aside class="col-lg-2 d-none d-lg-block asideboczny">
					
						<img class ="img-fluid my-2" src="img/ad.jpg" alt="Reklama">
						
						
						<ul class="list-group">
							<a href="przychod.php" class="list-group-item list-group-item-dark list-group-item-action"><i class="icon-plus"></i>Dodaj przychód</a>
							<a href="wydatek.php" class="list-group-item list-group-item-dark list-group-item-action"><i class="icon-minus"></i>Dodaj wydatek</a>
							<a href="bilans.php" class="list-group-item list-group-item-dark list-group-item-action active"><i class="icon-balance-scale"></i> Wyświetl bilans</a>
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