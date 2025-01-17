<!-- Header for the website -->
<?php
    session_start();
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="Header.css">
    <link rel="stylesheet" href="../fonts/css/all.css">
</head>
<body>
    <div class="header">
    <div class="logo" onclick="window.open('../Index.php','_Self')">K1J LTD</div>
    <a href="../Index.php"><button><i class="fas fa-house"></i>Home</button></a>
    <a href="UnSignedAnalyticsPage.php"><button><i class="fa-solid fa-chart-line"></i>Analytics</button></a>
    <a href="Products.php"><button><i class="fa-solid fa-bag-shopping"></i>Products</button></a>
    <a href="LoginPage.php"><button class="Log"><i class="fa-solid fa-right-to-bracket"></i>Login</button></a>
    <a href="Registration.php"><button class="Reg"><i class="fa-solid fa-address-card"></i>Register</button></a>
    <?php if (isset($_SESSION['email'])): ?>
        <script>
            document.querySelector('.Log').style.display = 'none';
            document.querySelector('.Reg').style.display = 'none';
        </script>
        <a href="Cart.php"><button class="Cart"><i class="fa-solid fa-cart-shopping"></i>Cart</button></a>
        <div class="usericon" onclick='window.open("AccountInfo.php","_self")'><?php echo $_SESSION['username'];?></div>
        <form action="logout.php" method="POST"><button class="logoff">Log off</button></form>
    <?php endif; ?>
    </div>
</body>