<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
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
            <label for="email">Email:</label>
             </td>
                <td>
            <input type="email" name="email" required>
               </td>
            </tr>
                 <tr>
                <td>
            <label for="phoneNumber">Phone Number:</label>
             </td>
                <td>
            <input type="text" name="phoneNumber" required>
              </td>
            </tr>
                <tr>
                    <td>
            <input type="submit" name="submit" >
            </td>
            </tr>
        </form>
    </table>
</body>

<?php
require_once './class-phpass.php';

function handle_validate($username, $password, $email, $phone){
  $username = test_input($username);
  $password = test_input($password);
  $email = test_input($email);
  $phone = test_input($phone);
  if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
    return "Invalid email";
   }
    if(!preg_match('/^0[3|5|7|8|9][0-9]{8}$/', $phone))
        {
            return 'invalid phone number';
        }
  $hasher = new PasswordHash(8,true);
  $hash = $hasher->HashPassword($password);
  
  $user = array("username"=>$username, "password"=>$hash, "email" => $email,"phone"=> $phone);


  return $user;
}

function test_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}
  $user = handle_validate($_POST["username"],$_POST["password"],$_POST["email"],$_POST["phoneNumber"]);
  echo $user;
  if($user["email"] != null)
    {
      setcookie("username", $user["username"],time()+ 86400,"/");
      setcookie("password", $user["password"],time()+ 86400,"/");
      setcookie("email", $user["email"],time()+ 86400,"/");
      setcookie("phone", $user["phone"],time()+ 86400,"/");
      header("Location: login-page.php");
    }  
?>

</html>