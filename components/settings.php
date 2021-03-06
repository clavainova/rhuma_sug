<?php
//verify that account is logged in and that the user's data matches the database
//if not, redirect to login page 

if (verifyLogin()) :
?>
    <a href="http://localhost/RhumaSug/account_management/logout.php">
        <h2>LOGOUT</h2>
    </a>

    <article class="three-col">
        <a href="http://localhost/RhumaSug/index.php?page=history">
            <div class="highlightbox-margin">
                <h1>History</h1>
                <p>View a history of your orders and report failed delivery or faulty product.</p>
            </div>
        </a>
        <a href="http://localhost/RhumaSug/index.php?page=tracking">
            <div class="highlightbox-margin">
                <h1>Tracking</h1>
                <p>Monitor your current orders</p>
            </div>
        </a>
        <a href="http://localhost/RhumaSug/index.php?page=update">
            <div class="highlightbox-margin">
                <h1>Update personal details</h1>
                <p>Change your delivery address or update your payment method</p>
            </div>
        </a>
    </article>
<?php
else :

    //include the forms
    include "login.php";
endif;
?>