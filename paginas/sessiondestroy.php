<?php
session_start();

$_SESSION = [];

session_destroy();

header("Location: inicio_sesion.php");
exit(); 
