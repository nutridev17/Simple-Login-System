<?php
session_start();
if (isset($_SESSION['currentemail'])) {
    header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup.css">
    <title>Create New Account</title>
</head>
<body>
    <div class="container">
        <div class="regform">
            <form action="actions/join.php" method="post">
                <h2>Create New Account</h2>
                <div class="namebox">
                    <input type="text" name="firstname" id="firstname" placeholder="First Name">
                    <input type="text" name="secondname" id="secondname" placeholder="Last Name">
                </div>
                <input type="email" name="email" id="email" placeholder="Email Address">
                <input type="password" name="password" id="password" placeholder="Password">
                <input type="password" name="repassword" id="repassword" placeholder="Confirm Password">
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] === 'allfieldsarerequired') {
                        echo '<p class="response">Fill all fields to login</p>';
                    }elseif ($_GET['error'] === 'passwordlen') {
                        echo '<p class="response">Password must be more than 8 characters</p>';
                    }elseif ($_GET['error'] === 'passwordnotmatch') {
                        echo '<p class="response">Password not match</p>';
                    }elseif ($_GET['error'] === 'databsefault1') {
                        echo '<p class="response">Cannot create this user</p>';
                    }elseif ($_GET['error'] === 'tablecreationfailed') {
                        echo '<p class="response">Cannot create this user</p>';
                    }elseif ($_GET['error'] === 'emailalreadyused') {
                        echo '<p class="response">Email already taken</p>';
                    }elseif ($_GET['error'] === 'serverproblem') {
                        echo '<p class="response">Cannot update user data</p>';
                    }else{
                        echo '<p class="response">Unknown eooro</p>';
                    }
                }
                ?>
                <input type="submit" value="Open Account">
                <a href="signin.php">Already have an account?</a>
            </form>
        </div>
        <div class="banner">
            <h2>Hello User, Good Morning !</h2>
        </div>
    </div>
</body>
</html>