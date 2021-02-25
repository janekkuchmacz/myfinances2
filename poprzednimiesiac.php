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
					
						<div class="col-lg-6 d-inline-block">
							<header>
					
							<h1 class="ml-0">Przeglądaj bilans</h1>
								
							</header>
						
							<div id="dropdown">
								<a href="#">Wybierz okres czasu</a>
								<ul>
									   <li><a href="biezacymiesiac.php">Bieżący miesiąc</a></li>
									   <li><a href="poprzednimiesiac.php">Poprzedni miesiąc</a></li>
									    <li><a href="biezacyrok.php">Bieżący rok</a></li>
									    <li><a href="niestandardowy_zakres.php">Niestandardowy</a></li>
								  </ul>
							</div>
						</div>
						<div class="col-lg-4 d-none d-lg-inline-block">
							<i class="icon-balance-scale1"></i>
						</div>
							<div id="okresczasu">
								<span class="bilansdla">Bilans dla: </span> <span class="kolumnytabeli">poprzedniego miesiąca</span>
							</div>									
							<div id="tabelaPrzychody">
<?php
			function zamien_na_PL($nazwa_ang)
			{
				if ($nazwa_ang=="Salary") return "Wynagrodzenie";
				if ($nazwa_ang=="Interest") return "Odestki bankowe";
				if ($nazwa_ang=="Allegro") return "Allegro";
				if ($nazwa_ang=="Another") return "Inne";
				if ($nazwa_ang=="Transport") return "Transport";
				if ($nazwa_ang=="Books") return "Książki";
				if ($nazwa_ang=="Food") return "Jedzenie";
				if ($nazwa_ang=="Apartments") return "Mieszkanie";
				if ($nazwa_ang=="Telecommunication") return "Telekomunikacja";		
				if ($nazwa_ang=="Health") return "Opieka zdrowotna";	
				if ($nazwa_ang=="Clothes") return "Ubranie";	
				if ($nazwa_ang=="Hygiene") return "Higiena";	
				if ($nazwa_ang=="Kids") return "Dzieci";	
				if ($nazwa_ang=="Recreation") return "Rozrywka";	
				if ($nazwa_ang=="Trip") return "Wycieczka";	
				if ($nazwa_ang=="Savings") return "Oszczędności";	
				if ($nazwa_ang=="For Retirement") return "Złota jesień";	
				if ($nazwa_ang=="Debt Repayment") return "Spłata długów";	
				if ($nazwa_ang=="Gift") return "Darowizna";								
			}
			
			require_once 'database.php';
			$userID=$_SESSION['logged_id'];
			$incomeQuery=$db->query("SELECT name, SUM(amount) AS IncomeSum FROM incomes_category_assigned_to_users, incomes WHERE incomes.user_id='$userID' AND incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id AND MONTH(date_of_income)=MONTH(CURDATE()-INTERVAL 1 MONTH) AND YEAR(date_of_income)=YEAR(CURDATE() - INTERVAL 1 MONTH) GROUP BY name ORDER BY IncomeSum DESC"); //otrzymujemy obiekt klasy PDO statement 
			$incomeTable=$incomeQuery->fetchAll();//tablica asocjacyjna
?>
									
										<table>
										
										<tr>
										<td colspan="2"><span class="tytultabeliprzychody">Przychody</span></td>
										</tr>
										<tr>
										<td><span class="kolumnytabeli">Kategoria</span></td>
										<td><span class="kolumnytabeli">Przychód</span></td>
										</tr>
										<?php
											foreach($incomeTable as $incomeRow)
											{
												$incomeRowName=zamien_na_PL($incomeRow['name']);
												echo "<tr><td>$incomeRowName</td><td>{$incomeRow['IncomeSum']} zł</td></tr>";
											}
											
										?>
										<tr>
										<td><span class="tytultabeliprzychody">Suma</span></td>
										<td><span class="tytultabeliprzychody">
										<?php
										$incomeQuery=$db->query("SELECT SUM(amount) AS IncomeSum FROM incomes WHERE user_id='$userID' AND MONTH(date_of_income)=MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(date_of_income)=YEAR(CURDATE() - INTERVAL 1 MONTH)");
										$incomeSum=$incomeQuery->fetchAll();
										foreach($incomeSum AS $incomeSumm )
										{
											echo $incomeSumm['IncomeSum']." zł";
											$incomeSUM=$incomeSumm['IncomeSum'];
										}
										?>										
										</span></td>
										</tr>
																	
										</table>
																	
							</div>
							
<?php
			
			$expenseQuery=$db->query("SELECT name, SUM(amount) AS ExpenseSum FROM expenses_category_assigned_to_users, expenses WHERE expenses.user_id='$userID' AND expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id AND MONTH(date_of_expense)=MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(date_of_expense)=YEAR(CURDATE() - INTERVAL 1 MONTH) GROUP BY name ORDER BY ExpenseSum DESC"); //otrzymujemy obiekt klasy PDO statement 
			$expenseTable=$expenseQuery->fetchAll();//tablica asocjacyjna
			function wypiszTabele()
			{
					
					global $expenseTable;
					echo "['Kategoria', 'Udział procentowy']";
					foreach($expenseTable as $expenseRow)
						{
							$expenseRowName=zamien_na_PL($expenseRow['name']);
							$expenseValue=$expenseRow['ExpenseSum'];
							echo ', [\''.$expenseRowName.'\', '.$expenseValue.']';
						}
			}
?>
							
							<div id="wydatki">
								<div id="tabelaWydatki" class="col-lg-6 d-inline-block align-top">
								
									<table>
									
									<tr>
									<td colspan="2"><span class="tytultabeliwydatki">Wydatki</span></td>
									</tr>
									<tr>
									<td><span class="kolumnytabeli">Kategoria</span></td>
									<td><span class="kolumnytabeli">Wydatek</span></td>
									</tr>
									<?php
											foreach($expenseTable as $expenseRow)
											{
												$expenseRowName=zamien_na_PL($expenseRow['name']);
												echo "<tr><td>$expenseRowName</td><td>{$expenseRow['ExpenseSum']} zł</td></tr>";
											}
											
									?>
									<tr>
									<td><span class="tytultabeliwydatki">Suma</span></td>
									<td><span class="tytultabeliwydatki">
									<?php
										$expenseQuery=$db->query("SELECT SUM(amount) AS ExpenseSum FROM expenses WHERE user_id='$userID' AND MONTH(date_of_expense)=MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(date_of_expense)=YEAR(CURDATE() - INTERVAL 1 MONTH)");
										$expenseSum=$expenseQuery->fetchAll();
										foreach($expenseSum AS $expenseSumm )
										{
											echo $expenseSumm['ExpenseSum']." zł";
											$expenseSUM = $expenseSumm['ExpenseSum'];
										}
									?>
									</span></td>
									</tr>
																
									</table>															
								</div>
<?php
//wypiszTabele();

?>
<script type="text/javascript">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
	//Draw the chart and set the chart values
	function drawChart() {
	  var data = google.visualization.arrayToDataTable([<?php wypiszTabele();?>]);

	  // Optional; add a title and set the width and height of the chart
	  var options = {backgroundColor:'none', chartArea:{left:'0',top:'0',width:'100%',height:'100%'}, legend:{position: 'right', textStyle:{color:'#efefef', fontSize:'12'}}, pieSliceText:'percentage', pieSliceTextStyle:{color:'black', fontSize:'14'},  colors: ['#FF0000', '#8B0000', '#B22222', '#DC143C', '#CD5C5C', '#FA8072', '#E9967A', '#FFA07A','#FFDAB9','#FFE4B5', '#FFEFD5', '#FAFAD2', '#FFFACD', '#FFFFE0', 'white' ]}


	  // Display the chart inside the element with id="piechart"
	  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
	  chart.draw(data, options);
	}
</script>
								<div class="col-lg-4 mt-4 d-lg-inline-block wykres">
										<div id="piechart" style="width:350px; height: 300px;"></div>
								</div>

							</div>
							<div id="bilansfinalny">
								<div id="bilanskoncowy" class="col-lg-6 d-inline-block">
										<span class="kolumnytabeli"><i class="icon-balance-scale"></i>  Bilans </span>
										<br/>
										<span class="kolumnytabeli">Przychody:</span><span class="tytultabeliprzychody"><?= " $incomeSUM"." zł" ?> 
										</span><br/>
										<span class="kolumnytabeli">Wydatki:</span> <span class="tytultabeliwydatki"><?= "$expenseSUM"." zł" ?></span><br/>
<?php
$difference=$incomeSUM - $expenseSUM;
if($difference>0)
{
	echo '<span class="kolumnytabeli">Zaoszczędzono:</span> <span class="tytultabeliprzychody">'.round(($incomeSUM - $expenseSUM),2).' zł</span><br/>';
	echo '<span style="font-weight: 900;
	color: #36b03c;
	font-size: 24px;">Dobrze zarządzasz!!</span>';
} 
else
{
	echo '<span class="kolumnytabeli">Wydano za dużo o:</span> <span class="tytultabeliwydatki">'.round(($expenseSUM - $incomeSUM),2).' zł</span><br/>';
	echo '<span style="font-weight: 900;
	color:#FF0000;;
	font-size: 24px;">Wpadasz w długi!!</span>';
}
?>
										
								</div>
								<div id="twojbilans" class="col-lg-4 d-inline-block mt-3 text-center">
<?php 
if($difference>0)
{
	echo '<i class="icon-money4"></i><i class="icon-plus1"></i><i class="icon-money5 "></i>';
}
else
{
	echo'<i class="icon-money3"></i><i class="icon-minus1"></i><i class="icon-money4"></i>';
}
?>
							
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