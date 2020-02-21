<?php
//this checks the database connection and terminates the page loading if 
//it's unavailable

//this checks session for notifications or errors and shows them to the user
//if there are multiple it will only show the latest one of each
//can display both theoretically altho shouldn't happen

//unsets error/notification straight after displaying them on one page
//so the user only has to see them the one time, unless they repeat the same error

//if connection to database failed
if (getConnection() == false) :
?>
    <div class="error">
        <?php
        print(ERRORS[200]);
        die; //die if no database connection, otherwise will throw more errors
        ?>
    </div>
<?php
endif;

//if there's a notification
if (isset($_SESSION["notif"])) :
?>
    <div class="notif">
        <?php
        print($_SESSION["notif"]);
        ?>
    </div>
<?php
    //unset error
    unset($_SESSION['notif']);
endif;


//if there's an error
if (isset($_SESSION["error"])) :
?>
    <div class="error">
        <?php
        print(ERRORS[$_SESSION["error"]]);
        ?>
    </div>
<?php
    //unset error
    unset($_SESSION['error']);
endif;
