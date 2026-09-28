<?php

function checkAllFieldsAreNotFilled($firstname, $lastname, $email, $password, $confirmpass){
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirmpass)) {
        return true;
    } else {
        return false;
    }
    
}

function checkFieldsNotFilled($email, $password){
    if (empty($email) || empty($password)) {
        return true;
    } else {
        return false;
    }
    
}

function createUserTable($conn){
    $createQuery = "CREATE TABLE IF NOT EXISTS allusers(
        id INT AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(100) NOT NULL,
        lastname VARCHAR(100) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );";

    $result = mysqli_query($conn, $createQuery);

    if ($result) {
        return true;
    } else {
        return false;header('Location:../signup.php?error=databsefault1');
        exit();
    }  
}

function checkLenghtOfPassword($password){
    if (strlen($password) < 8) {
        return true;
    } else {
        return false;
    }
}

function checkPasswordMatch($password, $confirmpass){
    if ($password === $confirmpass) {
        return true;
    } else {
        return false;
    }
    
}

function insertData($firstname, $lastname, $email, $hashedPassword, $conn){
    $insertQ = "INSERT INTO allusers (firstname, lastname, email, password)
     VALUES ('$firstname', '$lastname', '$email', '$hashedPassword');";
    
    if (mysqli_query($conn, $insertQ)) {
        return true;
    } else {
        return false;
    }
    
    
}

function checkEmailIsUsed($conn, $email){
    $isEmailUsed = "SELECT * FROM allusers WHERE email = '$email'; ";
    $result = mysqli_query($conn, $isEmailUsed);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
        
    }else{
        header('Location:../signup.php?error=serverproblem2');
        exit();
    }
}

function checkEmailIsNotExists($conn, $email){
    $emailQuery = "SELECT * FROM allusers WHERE email = '$email';";
    $result = mysqli_query($conn, $emailQuery);
    if ($result) {
        if (mysqli_num_rows($result) < 1) {
            return true;
        } else {
            return false;
        }
        
    } else {
        header('Location:../signin.php?error=serverproblem3');
        exit();
    }
    
}

function isPasswordMatchesWithDb($conn, $email, $password){
    $emailQuery = "SELECT * FROM allusers WHERE email = '$email';";
    $result = mysqli_query($conn, $emailQuery);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        //now check hte password
        if (password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }
        
    }
}
?>