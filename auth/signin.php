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
    <title>Login to account</title>
    <link rel="stylesheet" href="css/signin.css">
</head>
<body>
    <div class="container">
        <div class="banner">
            <h2>Hello User, Good Morning !</h2>
        </div>
        <div class="loginform">
            <form action="actions/login.php" method="post">
                <h2>Login to Account</h2>
                <input type="email" name="email" id="email" placeholder="Email Address">
                <input type="password" name="pass" id="pass" placeholder="Pasaword">
                <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] === 'allfieldsarerequired') {
                            echo '<p class="response">Fill all fields to login</p>';
                        }elseif ($_GET['error'] === 'accountnotfound') {
                            echo '<p class="response">User not found</p>';
                        }elseif ($_GET['error'] === 'passwordlen') {
                            echo '<p class="response">Password must be more than 8 characters</p>';
                        }elseif ($_GET['error'] === 'invalidpassword') {
                            echo '<p class="response">Invalid password</p>';
                        }else{
                            echo '<p class="response">Unknown Error</p>';
                        }
                    }
                ?>
                <input type="submit" value="Log In" class="loginbtn">
                <a href="#">Forgot Your Password?</a>
                <a href="signup.php" class="createbtn">Create New Account</a>
            </form>
        </div>
    </div>
</body>
</html>