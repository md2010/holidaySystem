<?php 


$conn = null;
$servername = "localhost";
$dbname = "companylaravel";
$user = "root";
$password = "1234";

try {
	$conn =  new PDO("mysql:host=$servername;dbname=$dbname", 
				$user, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDO $e)
{
	echo $e->getMessage();
}

$statement = $conn->prepare("UPDATE users SET availableDays = 20");
$statement->execute();



    