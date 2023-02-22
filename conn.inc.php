<?php
#echo $_SERVER['SERVER_NAME'] . "<BR>";
#exit();
#$dbuser = "jack";
#$dbpasswd = "grand.jack@gmail.com";

		$host = "127.0.0.1" ;
		$dbuser = "admin";
		$dbpasswd = "1234" ;
		$dbname = "kpvsequ" ;

$conn=mysqli_connect($host , $dbuser , $dbpasswd , $dbname);
// ?�d?��
if (!$conn)
{
    die("�s�����~: " . mysqli_connect_error());
}

$GLOBALS['conn'] = $conn;
$conn->query('SET NAMES utf8');
$pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host , $dbuser, $dbpasswd);

?>
