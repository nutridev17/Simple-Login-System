<?php
session_start();
if (!isset($_SESSION['currentemail'])) {
    header('Location:signin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <?php
        echo 'Email ' . $_SESSION['currentemail'];
    ?>
    <form action="actions/logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</body>
</html>