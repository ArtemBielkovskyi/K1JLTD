<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
        <link rel="stylesheet" type="text/css" href="HomePage.css">
        <link rel="stylesheet" href="fonts/css/all.css">
        <meta utf-8>
    </head>
    <body>
        
        <div class="header">
            <div class="logo">K1J LTD</div>
            <a href="Index.php"><button><i class="fas fa-house"></i>Home</button></a>
            <a href="html/UnSignedAnalyticsPage.php"><button><i class="fa-solid fa-chart-line"></i>Analytics</button></a>
            <a href="html/LoginPage.php"><button class="Log"><i class="fa-solid fa-right-to-bracket"></i>Login</button></a>
            <a href="html/Registration.php"><button class="Reg"><i class="fa-solid fa-address-card"></i>Register</button></a>
            <?php if (isset($_SESSION['email'])): ?>
				<script>
                    document.querySelector('.Log').style.display = 'none';
                    document.querySelector('.Reg').style.display = 'none';
                </script>
                <div class="usericon" onclick='window.open("html/AccountInfo.php","_self")'><?php echo $_SESSION['username'];?></div>
                <form action="logout.php" method="POST"><button class="logoff">Log off</button></form>
            <?php endif; ?>
        </div>
        <div class="HeaderPic">
            K1J LTD
        </div>
         <div class="InformationBox">
            <div class = "aboutUsTitle">About us</div>
            <div class="AboutUsText block"><h4 class="AboutUsTextInBlock">The company's first location, opened in 1976 under the Price Club name, was in a converted airplane hangar on Morena Boulevard in San Diego. Originally serving only small businesses, the company found it could achieve far greater buying clout by also serving a selected audience of non-business members.
                Our operating philosophy has been simple. Keep costs down and pass the savings on to our members. Our large membership base and tremendous buying power, combined with our never-ending quest for efficiency, result in the best possible prices for our members. Since resuming the K1JLTD name in 1997, the company has grown worldwide with total sales in recent fiscal years exceeding $64 billion.
            </h4>
            </div>
            <div class = "OurViewsTitle">Our views</div>
            <div class="Ourviews block"><h4 class="OurviewsTextInBlock">Today, as the company evolves, it stays true to the qualities that helped attract and retain millions of loyal members around the globe:
                Commitment to quality. K1J LTD warehouses carry about 4,000 SKUs (stock keeping units) compared to the 30,000 found at most supermarkets. By carefully choosing products based on quality, price, brand, and features, the company can offer the best value to members.
                </h4></div>
        </div>
        <div class="SecondPicture"></div>
        <div class = "contactUs">
            <form class="ContactUsForm">
                <h2 class="ContactUsTitle">Contact us</h2>
                <p class="FirstNameField"><label>First Name:</label> <input name="myEmail" type="text" class="InputField"/></p>
                <p class="EmailAddressField"><label>Email Address:</label> <input style="cursor: pointer;" name="myEmail" type="text" class="InputField"/></p>
                <p class="MessageField"><label>Message:</label>  <textarea name="message" class="InputField"></textarea> </p>
                <!-- Checkbox for accepting terms/privacy policy -->
                <p>
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms" class="termsAndConditions">I accept the <a href="html/TermsOfService.php">Terms of Service</a> and <a href="html/TermsOfService.php">Privacy Policy</a>.</label>
                </p>
                <p><input type="submit" value="Send" class="SendMessage"/></p>
            </formclass>
        </div>
        <div class="Footer">
            <div class="FooterText">K1J LTD</div>
            <div class="FooterText">All rights reserved</div>
        </div>
    </body>
</html>