<?php
// Start the session
session_start();

// Include your database connection file here
include("db_connection.php");

if(isset($_POST['submit'])){
    $u = $_POST['username'];
    $p = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $u);
    $password = mysqli_real_escape_string($conn, $p);

    $query    = "SELECT * FROM `users` WHERE username='$username' AND password='" . md5($password) . "'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
    }else{
        echo "Invalid username or password";
    }
}

echo '<br><a href="registration.php">Click here to register , if not registerd yet</a> ';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="post" action="">
        <br>
        <label>Username:</label><br>
        <input type="text" name="username" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <input type="submit" name="submit" value="Login">
    </form>
</body>
</html>  