<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Privacy Policy and Terms of Service</title>
        <link rel="stylesheet" type="text/css" href="TermsOfService.css">
        <link rel="stylesheet" href="../fonts/css/all.css">
        <meta utf-8>
    </head>
    <body>
    <div class="header">
            <div class="logo" onclick="window.open('../Index.php','_Self')">K1J LTD</div>
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
    <div class="TermsOfService">
        <h2>Privacy Policy and Terms of Service for K1JLTD Website</h2><br/><br/><br/>
        Effective Date: <i>01/01/2025 – 01/01/2035</i><br/>
        <h4>Privacy Policy</h4><br/><br/>
        1. Data Collection<br/><br/>
        We collect and process the following types of information:<br/>
        •	For Employees: Personal identification, login credentials, and activity data related to the sales system, customer data, and product data.<br/>
        •	For Customers: Personal identification, contact information, dashboard usage analytics, email tracking, instant messaging data, and shared content.<br/><br/>
        2. Use of Data<br/><br/>
        We use collected data for:<br/>
        •	Enhancing user experience on the Website.<br/>
        •	Providing and improving services for employees and customers.<br/>
        •	Complying with legal and regulatory requirements.<br/><br/>
        3. Data Sharing<br/><br/>
        We do not share user data with third parties except:<br/>
        •	With consent from the user.<br/>
        •	When required by law or legal proceedings.<br/>
        •	To protect our rights or enforce our Terms.<br/><br/>
        4. Data Security<br/><br/>
        We implement industry-standard measures to secure data. Users are responsible for safeguarding their login credentials and notifying us immediately of any unauthorized access or security breach.<br/><br/>
        5. User Rights<br/><br/>
        Users have the right to:<br/>
        •	Access their data.<br/>
        •	Request corrections to inaccurate data.<br/>
        •	Request deletion of data where applicable by law.<br/>
        To exercise these rights, contact us at k1jltd@customer.com.<br/><br/>
        6. Cookies and Tracking<br/><br/>
        The Website uses cookies to improve functionality and analytics. Users can manage their cookie preferences through their browser settings.<br/>
        ________________________________________<br/><br/>
        <h4>Terms of Service</h4><br/><br/>
        1. Purpose of the Website<br/><br/>
        The K1JLTD Website is designed to provide:<br/>
        •	Employees with access to sales systems, customer data, and product data.<br/>
        •	Customers with access to dashboard analytics, email tracking, instant messaging with employees, and file/content sharing.<br/><br/>
        2. Acceptable Use<br/><br/>
        a. For Employees:<br/>
        Employees must use the Website responsibly and only for work-related purposes. Unauthorized access to restricted areas or misuse of customer data is prohibited.<br/>
        b. For Customers:<br/>
        Customers may use the Website to view analytics, track emails, communicate with employees, and share files/content. All shared content must comply with applicable laws and not infringe on third-party rights.<br/><br/>
        3. Prohibited Activities<br/><br/>
        Users must not:<br/>
        •	Hack, disrupt, or damage the Website or its features.<br/>
        •	Upload malicious or illegal content.<br/>
        •	Extract or scrape data without authorization.<br/>
        •	Violate laws or third-party rights.<br/><br/>
        4. Intellectual Property<br/><br/>
        All content, trademarks, logos, and data on the Website are the property of K1JLTD or its licensors. Unauthorized use, reproduction, or distribution is prohibited.<br/><br/>
        5. Communication Features<br/><br/>
        a. Instant Messaging:<br/>
        Messages between employees and customers are for professional purposes. K1JLTD reserves the right to monitor communications for compliance.<br/>
        b. File and Content Sharing:<br/>
        All shared files must comply with legal standards and be free from malware. K1JLTD is not responsible for the accuracy or legality of shared content.<br/><br/>
        6. Limitation of Liability<br/><br/>
        K1JLTD is not liable for:<br/>
        •	Direct, indirect, or consequential damages resulting from Website use.<br/>
        •	Unauthorized access to user data.<br/>
        •	Issues with third-party integrations or links accessed through the Website.<br/><br/>
        7. Termination of Access<br/><br/>
        K1JLTD reserves the right to suspend or terminate access for any user violating these Terms.<br/><br/>
        8. Modifications to Terms<br/><br/>
        We may update these Terms periodically. Continued use of the Website after changes constitutes acceptance of the revised Terms.<br/><br/>
        10. Contact Information<br/><br/>
        For questions or concerns, please contact us:<br/><br/>
        K1JLTD<br/>
    </div>
        <div class="Footer">
            <div class="FooterText">K1J LTD</div>
            <div class="FooterText">All rights reserved</div>
        </div>


    </body>
</html>