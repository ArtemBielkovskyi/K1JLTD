<?php
include '../database/db_connect.php';
$message = "";
$ExistingEmails = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $existingEmail = $conn->prepare("SELECT email FROM userdata WHERE email = ?");
    $existingEmail->bind_param("s", $email);
    $existingEmail->execute();
    $existingEmail->store_result();
    //password validation 
    if($existingEmail->num_rows>0){
        $message = "Email already exist!";
    } 
    elseif(!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$_POST['password'])){
        $message = "Password must be at least 8 characters long, have one lower and one upper case letters, including minimum one special character!";
    } 
    elseif($_POST['password']!==$_POST['password2']) {
        $message = "Passwords don't match!";
    } else{
        //password hashing and inserting into database
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $stmt = $conn->prepare('INSERT INTO userdata(username, email, password) VALUES (?,?,?)');
        $stmt->bind_param('sss', $username, $email, $password);
        //validation of email 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Email doesn't have right format!";
        } elseif ($stmt->execute()) {
            $message = "Account created successfully";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $existingEmail->close();
    $conn->close();
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registration K1JLTD</title>
        <link rel="stylesheet" type="text/css" href="Registration.css">
        <link rel="stylesheet" href="../fonts/css/all.css">
        <meta utf-8>
    </head>
    <body>
        <div class="header">
            <div class="logo">K1J LTD</div>
            <a href="../Index.php"><button><i class="fas fa-house"></i>Home</button></a>
            <a href="UnSignedAnalyticsPage.php"><button><i class="fa-solid fa-chart-line"></i>Analytics</button></a>
            <a href="LoginPage.php"><button class="Log"><i class="fa-solid fa-right-to-bracket"></i>Login</button></a>
            <a href="Registration.php"><button class="Reg"><i class="fa-solid fa-address-card"></i>Register</button></a>
        </div>
        <form method="post" class="RegistrationBlock">
            <i class="fa-solid fa-arrow-left-long" onclick="window.open('../Index.php', '_self');"></i><span class="RegTxt">Registration</span>
            <i class="fa-solid fa-user"></i><span class="UserTxt">Username</span>
            <input type="text" id="username" name="username" required>
            <i class="fa-solid fa-envelope"></i></i><span class="UserTxt">Email</span>
            <input type="text" name="email" required>
            <i class="fa-solid fa-lock"></i><span class="UserTxt">Password</span>
            <input type="password" name="password" required>
            <i class="fa-solid fa-lock"></i><span class="UserTxt">Confirm Password</span>
            <input type="password" name="password2" required>
            <button class="Submit" type="submit">Submit</button>
        </form>
        <?php if($message === "Account created successfully"): ?>
            <script>window.open('LoginPage.php','_self')</script>
        <?php endif; ?>
        <?php if($message === "Email already exist!" || $message === "Passwords don't match!"): ?>
        <div class="block"><?php echo $message ?></div>
        <?php endif;?>
        <?php if($message === "Email doesn't have right format!"): ?>
        <div class="blockLong"><?php echo $message ?></div>
        <?php endif;?>
        <?php if ($message === "Password must be at least 8 characters long, have one lower and one upper case letters, including minimum one special character!"): ?>
            <div class="blockVeryLong"><?php echo $message ?></div>
        <?php endif; ?>  
    </body>
</html>