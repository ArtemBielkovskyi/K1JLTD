<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Analytics Page</title>
        <link rel="stylesheet" type="text/css" href="UnSignedAnalyticsPage.css">
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
            <?php if (isset($_SESSION['email'])): ?>
				<script>
                    document.querySelector('.Log').style.display = 'none';
                    document.querySelector('.Reg').style.display = 'none';
                </script>
                <div class="usericon" onclick='window.open("AccountInfo.php","_self")'><?php echo $_SESSION['username'];?></div>
                <form action="logout.php" method="POST"><button class="logoff">Log off</button></form>
            <?php endif; ?>
        </div>
        
        <?php if (!isset($_SESSION['email'])): ?>
            <span>To access this page you need to be logged in.</span>
                <a href="LoginPage.php"><button class="LoginButton Button">Login</button></a>
                <a href="Registration.php"><button class="RegisterButton Button">Register</button></a>
        <?php else: ?>
            <div class="usersDataBlock">
                User's <?php echo $_SESSION['username']; ?> analytics data
            </div>
        <?php endif; ?>
    </body>
</html>