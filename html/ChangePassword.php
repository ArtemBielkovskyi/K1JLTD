<?php
include("../database/db_connect.php");
include("Header.php");
//recieving data about users password from the database using email adress  
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
    //in case if account been found we set up new password
    if (password_verify($_POST["oldpassword"], $password)) {
        //this is going to work only if existing password is not the same as old one
        if ($_POST["oldpassword"] !== $_POST["newpassword"]) {
            //giving specific password requirements
            if(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$_POST['newpassword'])){
                $message = "Password must be at least 8 characters long, have one lower and one upper case letters, including minimum one special character!";
            }else {
            // this is going to work only if password longer that 8 digits, include capital, lower case and special symbols 
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
                <!-- Displaying messages to the user -->
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
        <div class="Footer">
            <div class="FooterText">K1J LTD</div>
            <div class="FooterText">All rights reserved</div>
        </div>
    </body>
</html>