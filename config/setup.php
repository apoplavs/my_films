<?php

require_once('database.php');

try
{
	$pdo = new PDO('mysql:host=localhost;charset=utf8', $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	die('Error : ' . $e->getMessage());
}
$requete = "CREATE DATABASE IF NOT EXISTS db_films;";
$pdo->prepare($requete)->execute();

try
{
	$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	die('Error : ' . $e->getMessage());
}

$query = "CREATE TABLE IF NOT EXISTS films (
	id INT PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(64) NOT NULL,
	release_year INT NOT NULL,
	format ENUM('VHS', 'DVD', 'Blu-Ray') NOT NULL) 
	ENGINE InnoDB";
$bdd->prepare($query)->execute();


$query = "CREATE TABLE IF NOT EXISTS stars (
	id INT PRIMARY KEY AUTO_INCREMENT,
	first_name VARCHAR(32) NOT NULL,
	last_name VARCHAR(32) NOT NULL) 
	ENGINE InnoDB";
$bdd->prepare($query)->execute();


$query = "CREATE TABLE IF NOT EXISTS films_stars (
	id INT PRIMARY KEY AUTO_INCREMENT,
	film INT NOT NULL,
	star INT NOT NULL,
	FOREIGN KEY (film) REFERENCES films(id),
	FOREIGN KEY (star) REFERENCES stars(id)) 
	ENGINE InnoDB";
$bdd->prepare($query)->execute();

echo "<!DOCTYPE html>
<html>
<head>
	<title>setup</title>
</head>
<body>
	<h3 align='center'>база данних була успішно встановлена</h3>
	<div style='text-align: center'>
		<a href='../index.php'>
		<button>на головну</button>
		</a>
	</div>
</body>
</html>";
?>
