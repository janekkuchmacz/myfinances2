<?php
//polaczenie z baza danych 
$config=require_once 'config.php' ;//config- nazwa tablicy asocjacyjnej, require_once - wkleja zawartość config.php

try
{
	$db = new PDO("mysql:host={$config['host']}; dbname={$config['database']}; charset=utf8", $config['user'], $config['password'], 
	[PDO::ATTR_EMULATE_PREPARES => false, 
	PDO::ATTR_ERRMODE =>PDO:: ERRMODE_EXCEPTION]);
}
catch (PDOException $error)
{
	echo $error->getMessage();
	exit('Database error');	
}
			
		

?>