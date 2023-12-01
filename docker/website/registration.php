<?php

include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST["username"];
    $password = md5($_POST["password"]);
    $e = $_POST["email"];

    $username = mysqli_real_escape_string($conn, $u);
    $email = mysqli_real_escape_string($conn, $e);

    if (empty($username) || empty($password) || empty($email)) {
        echo "All fields are required.";
    } else {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Username or email already exists. Please register with new credentials.";
        } else {
            $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $password, $email);
            $stmt->execute();

            echo "Registration successful!";
        }
    }
}

echo '<br><a href="index.php">Click here to login</a> ';

?>

<form method="post" action="registration.php">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    Email: <input type="text" name="email"><br>
    <input type="submit" value="Register">
</form>
