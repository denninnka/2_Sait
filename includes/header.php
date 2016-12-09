<?php
session_start();
if(!isset($_SESSION['isLogged'])){
	$_SESSION['isLogged'] = false;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title><?= $pageTitle;?></title>
	<meta charset="utf-8">
</head>
<body>
