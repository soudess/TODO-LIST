<?php 
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname   = 'php-todo';

$conn = new mysqli($hostname, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
?>