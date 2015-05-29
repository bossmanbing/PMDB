<?php
session_start();
session_unset();
setcookie('name', null, -1, '/');
header('Location:../index.php');
?>
