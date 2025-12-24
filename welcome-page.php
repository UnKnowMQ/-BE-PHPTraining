
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome-page</title>
</head>
<body>
    <h1>Welcome :</h1><?php echo $_SESSION["user"] ?>
    <form action="login-page.php" method="post">
    <input type="submit"  value="log out">
    </form>
</body>
</html>