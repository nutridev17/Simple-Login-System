<?php
include('../config/connect.php');
include('../actions/functions.php');

$email = $_POST['email'];
$password = $_POST['pass'];

$fieldsNotFilled = checkFieldsNotFilled($email, $password);
if ($fieldsNotFilled) {
    header('Location:../signin.php?error=allfieldsarerequired');
    exit();
}

$isEmailNotExist = checkEmailIsNotExists($conn, $email);
if ($isEmailNotExist) {
    header('Location:../signin.php?error=accountnotfound');
    exit();
}

$checkLength = checkLenghtOfPassword($password);
if ($checkLength) {
    header('Location:../signin.php?error=passwordlen');
    exit();
}

$isPasswordMatch = isPasswordMatchesWithDb($conn, $email, $password);
if (!$isPasswordMatch) {
    header('Location:../signin.php?error=invalidpassword');
    exit();
}

//login successfull
session_start();
$_SESSION['currentemail'] = $email;
header('Location:../');
?>