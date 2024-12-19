<?php
    session_start();
    include ("../database/db_connect.php");
    $result = $conn->query("SHOW COLUMNS FROM userdata LIKE 'accountType'");
    $email = $_SESSION['email'];
    if ($result->num_rows == 0) {
        // Add the accountType column if it does not exist
        $conn->query("ALTER TABLE userdata ADD accountType VARCHAR(255)");
        $stmt = $conn->prepare("UPDATE userdata SET accountType = 'User' WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->close();
    }

    $stmt = $conn->prepare("SELECT accountType FROM userdata WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($accountType);
    $stmt->fetch();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $code = $_POST["code"];


        switch ($code) {
            case 'K1JLTD':
                    $stmt = $conn->prepare("UPDATE userdata SET accountType = 'Staff' WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['accountType'] = 'Staff';
                    Header('Location: '.$_SERVER['PHP_SELF']);
                break;
            default:
                echo "Wrong code!";
                break;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Account Information</title>
        <link rel="stylesheet" type="text/css" href="AccountInfo.css">
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

        <div class="AccountInforamtion">
            <div class="MainInformation">
                <span class="AccountInfo">Account Information</span>
                <span class="GeneralInfo">User name</span>
                <?php echo $_SESSION['username']?>
                <div class="space"></div>
                <span class="GeneralInfo">Email</span>
                <?php echo $_SESSION['email']?>
                <div class="space"></div>
                <span class="GeneralInfo">Account type</span>
                <?php if($accountType !== 'Staff'): ?>
                <form method="post" class="codeBlock">
                    <span class="User">User</span>
                    <input class="code" name="code" placeholder="Staff member? Place your security code here" required>
                    <button class="Submit" type="submit">Submit</button>
                </form>
                <?php else: echo $accountType;?>
                <?php endif; ?>
                <!-- under construction -->
                <div class="space"></div>
                <button class="changeUsernameButton" onclick="window.open('ChangeUsername.php','_self')">Change username</button>
                <button class="changePasswordButton" onclick="window.open('ChangePassword.php','_self')">Change password</button>
            </div>
            <div class="UserDesignBlock"></div>
        </div>
    </body>
</html>