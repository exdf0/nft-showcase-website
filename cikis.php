<?php
session_start();
unset($_SESSION['giris']);
header("Location:index.php");
?>