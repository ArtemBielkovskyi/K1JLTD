<?php
    include ("../database/db_connect.php");
    include ("Header.php");
    $result = $conn->query("SHOW COLUMNS FROM userdata LIKE 'accountType'");
    $email = $_SESSION['email'];
    $message = '';
    if ($result->num_rows == 0) {
        // Add the accountType column if it does not exist
        $conn->query("ALTER TABLE userdata ADD accountType VARCHAR(255)");
        $stmt = $conn->prepare("UPDATE userdata SET accountType = 'User' WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->close();
    }
    //changing accout type of the user 
    //getting variable from dataset 
    $stmt = $conn->prepare("SELECT accountType FROM userdata WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($accountType);
    $stmt->fetch();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $code = $_POST["code"];

        //checking code which have been inserted by user
        switch ($code) {
            case 'K1JLTD':
                    //Changing account type variable in the database for specific user 
                    $stmt = $conn->prepare("UPDATE userdata SET accountType = 'Staff' WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['accountType'] = 'Staff';
                    Header('Location: '.$_SERVER['PHP_SELF']);
                break;
            default:
                $message = "Wrong code!";
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
                <?php if($message == "Wrong code!"): ?>
                    <span class="IncorrectCode">Wrong code!</span>
                <?php endif; ?>
                <!-- under construction -->
                <div class="space"></div>
                <button class="changeUsernameButton" onclick="window.open('ChangeUsername.php','_self')">Change username</button>
                <button class="changePasswordButton" onclick="window.open('ChangePassword.php','_self')">Change password</button>
            </div>
            <div class="UserDesignBlock"></div>
        </div>
        <div class="Footer">
            <div class="FooterText">K1J LTD</div>
            <div class="FooterText">All rights reserved</div>
        </div>
    </body>
</html>