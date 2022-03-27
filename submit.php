<?php 

include 'config.php';

if (isset($_POST['submit'])) {
    // checks for honeypot field
     if(!empty($honeypot)){
         return;
    } else {

         $name = $_POST['name'];
         $email = $_POST['email'];
         $website = $_POST['website'];
         $message = $_POST['message'];

        date_default_timezone_set("US/Eastern");
        $datetime = date("Y-m-d H:i:s");

         // this prepares our query (it gets the $con variable from config.php)
         $stmt = $con->prepare("INSERT INTO guestbook(datetime, name, email, website, message) VALUES (?,?,?,?,?)");

         // this binds our variables to the ones in the statement
         $stmt->bind_param("sssss", $datetime, $name, $email, $website, $message);

        // this executes the query
         $stmt->execute();

        // this closes the connection
        $stmt->close();

        // this redirects the user
        header('location: index.php');

    }

}

?>