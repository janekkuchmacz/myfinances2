<?php
session_start();

if(!isset($_SESSION['logged_id']))
{
	header('Location:logowanie.php');
	exit();
}
require_once 'database.php';
$income_category=$_POST['przychod'];

$userID=$_SESSION['logged_id'];
$incomesQuery=$db->query("SELECT id FROM incomes_category_assigned_to_users WHERE user_id='$userID' AND name='$income_category'"); //otrzymujemy obiekt klasy PDO statement 
$income_category_assigned_to_user=$incomesQuery->fetchAll();
foreach($income_category_assigned_to_user as $income_category)
{
	$income_category_assigned_to_userr=$income_category['id'];
}

$income_amount=$_POST['kwota'];
$income_date=$_POST['dzien'];
$income_comment=$_POST['komentarz']; //czy sanityzowac komentarz?
$db->query("INSERT INTO incomes VALUES (NULL, '$userID', '$income_category_assigned_to_userr', '$income_amount', '$income_date', '$income_comment')");

header('Location:biezacymiesiac.php');

?>