<?php
session_start();
//Under construcion 
include("../database/db_connect.php");

$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT password, username FROM userdata WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($password, $username);
$stmt->fetch();
$oldPassword = $password;
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['newpassword'])) {
    if (password_verify($_POST["oldpassword"], $password)) {
        if ($_POST["oldpassword"] !== $_POST["newpassword"]) {
            if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$_POST['newpassword'])){
                $message = "Password must be at least 8 characters long, have one lower and one upper case letters, including minimum one special character!";
            }else {
            $newPassword = $_POST['newpassword'];
            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE userdata SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $newHashedPassword, $email);
            $stmt->execute();
            $_SESSION['password'] = $newHashedPassword;
            $message = "Password changed successfully!";
            }
        } else {
            $message = "New password is the same as the old one!";
        }
    } else {
        $message = "Old password is incorrect!";
    }    
}
$conn->close();

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
                <?php if($message == 'Password changed successfully!'): ?>
                    <div class="SuccessBlock"><?php echo $message ?></div>
                <?php elseif($message == 'New password is the same as the old one!'): ?>
                    <div class="ErrorBlock"><?php echo $message ?></div>
                <?php elseif($message == 'Old password is incorrect!'): ?>
                    <div class="ErrorBlock"><?php echo $message ?></div>
                <?php endif; ?>
                <?php if($message == "Password must be at least 8 characters long, have one lower and one upper case letters, including minimum one special character!"): ?>
                    <div class="ErrorBlock"><?php echo $message ?></div>
                <?php endif; ?>
            </form>
        </div>
    </body>
</html>