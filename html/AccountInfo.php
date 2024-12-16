<?php
    session_start();
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
                ??
                <!-- under construction -->
                <div class="space"></div>
                <button class="changePasswordButton" onclick="window.open('ChangePassword.php','_self')">Change password</button>
            </div>
            <div class="UserDesignBlock"></div>
        </div>
    </body>
</html>