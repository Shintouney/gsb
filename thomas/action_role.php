<?php
session_start();

//sélectionne le rôle qu'on veut et le met en variable session

//echo $_POST['Role'];

$_SESSION['role']=$_POST['Role'];

//print_r ($_SESSION);

header("location:index.php")
?>