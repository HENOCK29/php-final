

<?php
$dsn = 'mysql:dbname=user_db;host=localhost';
$user = 'root';
$password = '';

try
{
	$bdd = new PDO($dsn,$user,$password);
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "PDO error".$e->getMessage();
	die();
}
?>
