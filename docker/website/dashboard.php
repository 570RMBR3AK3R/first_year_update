<?php
session_start();

include("db_connection.php");
include("auth_session.php");

if ($_SESSION["username"] == "admin") {
    echo "Hello, admin!";
    $sql = "SELECT username,password,email FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Name</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["username"]."</td><td>".$row["password"]." ".$row["email"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"])) {
        $username = $_POST["username"];

        if ($username == 'admin'){
            echo 'You cant delete yourself';
        
        } else{
                $sql = "DELETE FROM users WHERE username = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $username);
                $stmt->execute();

                echo "User deleted successfully!";
        }
    }

    ?>

    <form method="post" action="dashboard.php">
        Username to delete: <input type="text" name="username"><br>
        <input type="submit" value="Delete User">
    </form>
    <?php
} else {
    echo "Hello, " . $_SESSION["username"] . "!";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
        $email = $_POST["email"];

        $sql = "UPDATE users SET email = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $_SESSION["username"]);
        $stmt->execute();

        echo "Email updated successfully!";
        
    }

    ?>
    <form method="post" action="dashboard.php">
        New Email: <input type="text" name="email"><br>
        <input type="submit" value="Update Email">
    </form>
    <?php
}

echo '<a href="logout.php">Logout</a>';
?>
