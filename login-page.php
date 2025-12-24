<?php
session_unset();
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <table>
        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST">

            <tr>
                <td>
                    <label for="username">Username:</label>
                </td>
                <td>
                    <input type="text" name="username" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Password:</label>
                </td>
                <td>
                    <input type="password" name="password" required>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submit">
                </td>
            </tr>
        </form>
    </table>

    <?php

    require_once "./class-phpass.php";

    function test_input($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function handle_login($username, $password)
    {
        $username = test_input($username);
        $password = test_input($password);

        $hasher = new PasswordHash(8, true);
    
        if(!empty($username) && !empty($password))
            {
                
        if (strcmp($username, $_COOKIE["username"]) != 0 || !$hasher->CheckPassword($password, $_COOKIE["password"])) {
            return 'Wrong username or password';
        } else {
            $_SESSION["user"] = $_POST["username"];
          
            header("Location: welcome-page.php");
        }

            }
    }
        echo handle_login($_POST["username"], $_POST["password"]);
          echo $_SESSION["user"];
    ?>
</body>

</html>