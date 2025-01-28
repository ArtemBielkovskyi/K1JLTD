<!-- need to instal and plase composer phar into your directory for this piece of code to work and install composer programmaticaly -->

<?php
// // Define the path to the Composer executable
// $composerPhar = __DIR__ . '/composer.phar';

// // Define the command to install Composer dependencies
// $command = 'php ' . escapeshellarg($composerPhar) . ' install';

// // Execute the command
// $output = [];
// $return_var = 0;
// exec($command, $output, $return_var);

// // Output the result
// if ($return_var === 0) {
//     echo "Dependencies installed successfully:\n";
//     echo implode("\n", $output);
// } else {
//     echo "Failed to install dependencies. Error code: $return_var\n";
//     echo implode("\n", $output);
// }

// // Include the Composer autoload file
// require_once(__DIR__ . '/vendor/autoload.php');

// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// // Your code using PHPMailer goes here
?>

<?php
session_start();
require_once(__DIR__ . '/vendor/autoload.php');

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// // Creating a Contact us form
// use PHPMailer\PHPMailer\PHPMailer;
$messageToUser = "";
// create a new object
// configure an SMTP
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message']) && isset($_POST['myEmail'])) {
    //connecting file to our specific host on mailtrap
    // require_once './vendor/autoload.php';  
    $mail = new PHPMailer();
    $message = $_POST['message'];
    $emailOfUser = $_POST['myEmail'];
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = '26c465e08b919c';
    $mail->Password = '435f6973aea1c0';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 2525;

    $mail->setFrom($emailOfUser, 'Your Hotel');
    $mail->addAddress('artembielkovskyi@gmail.com', 'Me');
    $mail->Subject = 'User enquires';
    // Set HTML 
    $mail->isHTML(TRUE);
    $mail->Body = $message;
    $mail->AltBody = 'Message from K1J LTD.';
    // added attachment 
    $attachmentPath = './confirmations/yourbooking.pdf';
    if (file_exists($attachmentPath)) {
        $mail->addAttachment($attachmentPath, 'yourbooking.pdf');
    }

    // send the message
    if(!$mail->send()){
        $messageToUser = 'Message could not be sent.';
    } else {
        $messageToUser = 'Message has been sent';
    }
}

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
            <a href="html/Products.php"><button><i class="fa-solid fa-bag-shopping"></i>Products</button></a>
            <a href="html/LoginPage.php"><button class="Log"><i class="fa-solid fa-right-to-bracket"></i>Login</button></a>
            <a href="html/Registration.php"><button class="Reg"><i class="fa-solid fa-address-card"></i>Register</button></a>
            <?php if (isset($_SESSION['email'])): ?>
				<script>
                    document.querySelector('.Log').style.display = 'none';
                    document.querySelector('.Reg').style.display = 'none';
                </script>
                <a href="html/Cart.php"><button class="Cart"><i class="fa-solid fa-cart-shopping"></i>Cart</button></a>
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
            <form method="post" class="ContactUsForm">
                <h2 class="ContactUsTitle">Contact us</h2>
                <p class="FirstNameField"><label>First Name:</label> <input name="myName" type="text" class="InputField"/></p>
                <p class="EmailAddressField"><label>Email Address:</label> <input style="cursor: pointer;" name="myEmail" type="email" class="InputField" required/></p>
                <p class="MessageField"><label>Message:</label>  <textarea name="message" class="InputField"></textarea> </p>
                <!-- Checkbox for accepting terms/privacy policy -->
                <p>
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms" class="termsAndConditions">I accept the <a href="html/TermsOfService.php">Terms of Service</a> and <a href="html/TermsOfService.php">Privacy Policy</a>.</label>
                </p>
                <p><input type="submit" class="SendMessage Submit"/></p>
            </form>
        </div>
        <!-- Displaying a message to the user -->
        <?php if($messageToUser == 'Message has been sent'):?>
            <center><div class="SuccessMessage"><?php echo $messageToUser?></div></center>
        <?php elseif($messageToUser == 'Message could not be sent'):?>
            <center><div class="ErrorMessage"><?php echo $messageToUser?></div></center>
        <?php endif; ?>
        <div class="Footer">
            <div class="FooterText">K1J LTD</div>
            <div class="FooterText">All rights reserved</div>
        </div>
    </body>
</html>