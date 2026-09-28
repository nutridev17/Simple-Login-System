<?php

include('../config/connect.php');
include('../actions/functions.php');

$firstname = $_POST['firstname'];
$lastname = $_POST['secondname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmpass = $_POST['repassword'];

    $allFieldsNotFilled = checkAllFieldsAreNotFilled($firstname, $lastname, $email, $password, $confirmpass);
    if ($allFieldsNotFilled) {
        header('Location:../signup.php?error=allfieldsarerequired');
        exit();
    }

    //then visit with requirements
    $checkLength = checkLenghtOfPassword($password);
    if ($checkLength) {
        header('Location:../signup.php?error=passwordlen');
        exit();
    }

    $checkPasswordMatch = checkPasswordMatch($password, $confirmpass);
    if (!$checkPasswordMatch) {
        header('Location:../signup.php?error=passwordnotmatch');
        exit();
    }

    //now create table if not exist
    $openAcc = createUserTable($conn);
    if (!$openAcc) {
        header('Location:../signup.php?error=tablecreationfailed');
        exit();
    }

    //check that email is preused
    $isEmailUsed = checkEmailIsUsed($conn, $email);
    if ($isEmailUsed) {
        header('Location:../signup.php?error=emailalreadyused');
        exit();
    }

    //now hash the password and insert data to the allusers table
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $insertQuery = insertData($firstname, $lastname, $email, $hashedPassword, $conn);
    if (!$insertQuery) {
        header('Location:../signup.php?error=serverproblem');
        exit();
    }

    //if creation successed
    session_start();
    $_SESSION['currentemail'] = $email;
    header('Location:../');

?>