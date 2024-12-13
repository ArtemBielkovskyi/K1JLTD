<?php
include '../database/db_connect.php';
$message = "";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM userdata WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $row['username'];
        session_regenerate_id();
        header("Location: UnSignedAnalyticsPage.php");
    } else {
        $message = "Invalid email or password";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="LoginPage.css">
        <link rel="stylesheet" href="../fonts/css/all.css">
    </head>
    <body>
        <div class="header">
            <div class="logo">K1J LTD</div>
            <a href="../Index.php"><button><i class="fas fa-house"></i>Home</button></a>
            <a href="UnSignedAnalyticsPage.php"><button><i class="fa-solid fa-chart-line"></i>Analytics</button></a>
            <a href="LoginPage.php"><button class="Log"><i class="fa-solid fa-right-to-bracket"></i>Login</button></a>
            <a href="Registration.php"><button class="Reg"><i class="fa-solid fa-address-card"></i>Register</button></a>
        </div>
        <form method="post" class="loginBlock">
            <i class="fa-solid fa-arrow-left-long" onclick="window.open('../Index.php', '_self');"></i><span class="LogTxt">Log in</span>
            <i class="fa-solid fa-envelope"></i></i><span class="UserTxt">Email</span>
            <input type="text" name="email" required>
            <i class="fa-solid fa-lock"></i><span class="UserTxt">Password</span>
            <input type="password" name="password" required>
            <button class="Submit" type="submit">Submit</button>
        </form>
        <?php if($message):?>
            <div class="block"><?php echo $message ?></div>
        <?php endif; ?>
    </body>
</html>