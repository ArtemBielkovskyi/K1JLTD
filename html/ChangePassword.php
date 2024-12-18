<?php
session_start();
//Under construcion 
include("../database/db_connect.php");

$email = $_SESSION['email'];
$oldPassword = $_SESSION['password'];
$message = '';
$result = $conn->prepare("SELECT password FROM userdata WHERE email = '$email'");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['newPassword'])) {
    if ($oldPassword != $_POST['newPassword']) {
        $newPassword = $_POST['newPassword'];
        $result->prepare("UPDATE userdata SET username = '$newPassword' WHERE email = '$email'");
        $result->execute();
        $result->store_result();
        $_SESSION['password'] = $newPassword;
        $message = "Password changed successfully!";
    }
    else{
        $message = "New password is the same as the old one!";
    }
    
}
$result->close();
$conn->close();

/*need to sort encryption out before its gonna work*/
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Change Password</title>
        <link rel="stylesheet" type="text/css" href="ChangePassword.css">
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
                <h2>Change Password</h2>
            </div>
            <form action="ChangePassword.php" method="post">
                <div class="input-group OldPass">
                    <label>Old Password</label>
                    <input type="password" name="oldpassword" required>
                </div>
                <div class="input-group">
                    <label>New Password</label>
                    <input type="password" name="newpassword" required>
                </div>
                <div class="input-group SubmutButton">
                    <button type="submit" class="btn" name="change">Change</button>
                </div>
            </form>
        </div>
    </body>
</html>