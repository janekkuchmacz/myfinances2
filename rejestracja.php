<?php

session_start();

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
	<link rel="stylesheet" href="main.css">
	<link rel="stylesheet" href="css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&amp;subset=latin-ext" rel="stylesheet">
	
	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->
	
</head>

<body>

	<header>
	
	</header>
	
	<main>
		
		<article>
		
			<div class="container">
			
				<div class="row">
				
					
					<div class="col-lg-10 offset-lg-1 my-3 wpis">
					
						<header>
						
							<h1 class="ml-0 mb-4 text-center">Witaj w aplikacji mojefinanse.com<i class="icon-money1 d-none d-lg-inline-block"></i></h1>
							
							<h2 class="ml-0 mb-4 text-center"><i class="icon-money1 d-lg-none"></i></h2>
						
						</header>
						
						<div id="panelrejestracji">
						
						<form method="post" action="save.php">
		
							<h2 class="mb-4">Rejestracja użytkownika </h2>
							<div class="mr-2 mr-sm-4 mr-md-5">
								<label> Podaj swoje imię 
								<div><i class="icon-adult mr-1"></i><input type="text" placeholder="imię" onfocus="this.placeholder=''" onblur="this.placeholder='imię'"  value="<?php 
			
								if(isset($_SESSION['fr_name']))
								{
									echo $_SESSION['fr_name'];
									unset($_SESSION['fr_name']);
								}
								
								?>" name="name">
								</div>
								</label>
								<?php
			
									if(isset($_SESSION['e_name']))
									{
										echo '<div class="ml-2 mb-2"><span style="color:red;">'.$_SESSION['e_name'].'</span></div>';
										unset($_SESSION['e_name']);
									}
								
								?>							
							</div>
							
							<div class="mr-2 mr-sm-4 mr-md-5">
								<label>Podaj swój e-mail 
								<div><i class="icon-mail-alt mr-1"></i><input type="email" placeholder="email" onfocus="this.placeholder=''" onblur="this.placeholder='email'" value="<?php 
			
								if(isset($_SESSION['fr_email']))
								{
									echo $_SESSION['fr_email'];
									unset($_SESSION['fr_email']);
								}
								?> "name="email">
								</div>
								</label>							
								<?php
			
									if(isset($_SESSION['e_email']))
									{
										echo '<div class="ml-2 mb-2"><span style="color:red;">'.$_SESSION['e_email'].'</span></div>';
										unset($_SESSION['e_email']);
									}
								
								?>
							</div>	
							
							
							<div class="mr-2 mr-sm-4 mr-md-5">
							<label>Podaj hasło 
							<div><i class="icon-key mr-1"></i><input type="password" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'" name="password" required>
							</div>
							</label>
							<?php
		
								if(isset($_SESSION['e_pass']))
								{
									echo '<div class="ml-2 mb-2"><span style="color:red;">'.$_SESSION['e_pass'].'</span></div>';
									unset($_SESSION['e_pass']);
								}
							
							?>							
							</div>
							
							
						<input type="submit"value="Zarejestruj się" class="ml-4 ml-sm-3 ml-md-0 mr-md-1">
							
						</form>
						</div>
		
						<div class="info">
							Wszelkie prawa zastrzeżone &copy; 2021 Dziękuję za wizytę!
						</div>
	
						</footer>
					
					</div>
				
				</div>
			
			</div>
		
		</article>
		
	</main>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js"></script>
	
</body>
</html>