<?php
session_start();
if (!isset($_SESSION['currentemail']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location:../signin.php');
    exit();
}

session_unset();
session_destroy();
header('Location:../signin.php?message=loggedout');
exit();
?>