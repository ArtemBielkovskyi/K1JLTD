<?php
session_start();
include("../database/db_connect.php");

$email = $_SESSION['email'];
$oldUsername = $_SESSION['username'];
$message = '';
$result = $conn->prepare("SELECT username FROM userdata WHERE email = '$email'");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['newUsername'])) {
    if ($oldUsername != $_POST['newUsername']) {
        $newUsername = $_POST['newUsername'];
        $result->prepare("UPDATE userdata SET username = '$newUsername' WHERE email = '$email'");
        $result->execute();
        $result->store_result();
        $_SESSION['username'] = $newUsername;
        $message = "Username changed successfully!";
    }
    else{
        $message = "New username is the same as the old one!";
    }
    
}
$result->close();
$conn->close();


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Change Username</title>
        <link rel="stylesheet" type="text/css" href="ChangeUsername.css">
    </head>
    <body>
        <div class="header">
            <div class="logo">K1J LTD</div>
            <a href="../Index.php"><button><i class="fas fa-house"></i>Home</button></a>
            <a href="UnSignedAnalyticsPage.php"><button><i class="fa-solid fa-chart-line"></i>Analytics</button></a>
            <a href="LoginPage.php"><button class="Log"><i class="fa-solid fa-right-to-bracket"></i>Login</button></a>
            <a href="Registration.php"><button class="Reg"><i class="fa-solid fa-address-card"></i>Register</button></a>
            <?php if (isset($_SESSION['email'])): ?>
				<script>
                    document.querySelector('.Log').style.display = 'none';
                    document.querySelector('.Reg').style.display = 'none';
                </script>
                <div class="usericon" onclick='window.open("AccountInfo.php","_self")'><?php echo $_SESSION['username'];?></div>
                <form action="logout.php" method="POST"><button class="logoff">Log off</button></form>
            <?php endif; ?>
        </div>

        <div class="container">
            <div class="header">
                <h2>Change Username</h2>
            </div>
            <form action="ChangeUsername.php" method="post">
                <div class="input-Username">
                    <label>New Username</label>
                    <input type="Username" name="newUsername" required>
                </div>
                <div class="input-group SubmutButton">
                    <button type="submit" class="btn" name="change">Change</button>
                </div>
            </form>
            <?php if($message == 'Username changed successfully!'): ?>
                <div class="SuccessBlock"><?php echo $message ?></div>
            <?php endif; ?>
            <?php if($message == 'New username is the same as the old one!'): ?>
                <div class="ErrorBlock"><?php echo $message ?></div>
            <?php endif; ?>
        </div>
    </body>
</html>