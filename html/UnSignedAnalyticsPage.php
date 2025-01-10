<?php
    include("../database/db_connect.php");
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
        <?php
            include("Header.php");
        ?>


        <?php if (!isset($_SESSION['email'])): ?>
            <center><span class="YouNeedToSignText">To access this page you need to be logged in.</span></center>
            <a href="LoginPage.php" class="loginLink"><button class="LoginButton Button">Login</button></a>
            <a href="Registration.php" class="RegLink"><button class="RegisterButton Button">Register</button></a>
        <?php else: ?>
            <div class="usersDataBlock">
                <?php

                    // Fetch last login time
                    $query = $conn->prepare("SELECT last_login FROM userdata WHERE email = ?");
                    $query->bind_param("s", $_SESSION['email']);
                    $query->execute();
                    $query->bind_result($last_login);
                    $query->fetch();
                    $query->close();
                    echo "Last login was on: <br/>", $last_login;

                    $query = $conn->prepare("SELECT accountType FROM userdata WHERE email = ?");
                    $query->bind_param("s", $_SESSION['email']);
                    $query->execute();
                    $query->bind_result($accountType);
                    $query->fetch();
                    $query->close();
                    if($accountType=='Staff'){
                        // localhost is localhost 
                        // servername is root 
                        // password is empty 
                        // database name is k1jltd 
                        $con = mysqli_connect("localhost","root","","k1jltd"); 
                            
                            // SQL query to display row count 
                            // in userdata table 
                            $sql = "SELECT * from userdata"; 
                            
                            if ($result = mysqli_query($con, $sql)) { 
                            
                            // Return the number of rows in result set 
                            $rowcount = mysqli_num_rows( $result ); 
                                
                            // Display result 
                            printf("<br/><br/>Total amount of users : %d\n", $rowcount); 
                        } 
                            
                        // Close the connection 
                        mysqli_close($con); 
                    }
                ?> 
            </div>
        <?php endif; ?>
        <div class="Footer">
            <div class="FooterText">K1J LTD</div>
            <div class="FooterText">All rights reserved</div>
        </div>
    </body>
</html>