<?php
session_start();

if(!isset($_SESSION['logged_id']))
{
	header('Location:logowanie.php');
	exit();
}
require_once 'database.php';
$userID=$_SESSION['logged_id'];

$payment_method=$_POST['platnosc'];
$paymentQuery=$db->query("SELECT id FROM payment_methods_assigned_to_users WHERE user_id='$userID' AND name='$payment_method'"); //otrzymujemy obiekt klasy PDO statement 
$payment_method_assigned_to_user=$paymentQuery->fetchAll();
foreach($payment_method_assigned_to_user as $payment_method)
{
	$payment_method_assigned_to_userr=$payment_method['id'];
}

$expense_category=$_POST['kategoria'];
$expenseQuery=$db->query("SELECT id FROM expenses_category_assigned_to_users WHERE user_id='$userID' AND name='$expense_category'"); //otrzymujemy obiekt klasy PDO statement 
$expense_category_assigned_to_user=$expenseQuery->fetchAll();
foreach($expense_category_assigned_to_user as $expense_category)
{
	$expense_category_assigned_to_userr=$expense_category['id'];
}

$expense_amount=$_POST['kwota'];
$expense_date=$_POST['dzien'];
$expense_comment=$_POST['komentarz']; //czy sanityzowac komentarz?

$db->query("INSERT INTO expenses VALUES (NULL, '$userID', '$expense_category_assigned_to_userr', '$payment_method_assigned_to_userr', '$expense_amount', '$expense_date', '$expense_comment')");

header('Location:biezacymiesiac.php');

?>