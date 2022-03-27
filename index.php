<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Guestbook</title>
        <link rel="stylesheet" href="style.css">
    </head>


    <body>

        <div class="container">
            <h1>My Guestbook</h1>
            <form method="POST" id="submitForm" action="submit.php">
                <label>Name:</label> <input type="text" name="name" required><br>
                <label>Email:</label> <input type="text" name="email"><br>
                <label>Website:</label> <input type="url" name="website"><br>
                <label>Message:</label> <textarea name="message" name="message" required></textarea><br>
                <input type="hidden" name="honeypot">
                <input type="submit" name="submit" value="Submit">
            </form>

            <?php

            include "config.php"; 

                $stmt = $con->prepare("SELECT * FROM guestbook");
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $datetime = $row["datetime"];
                    $name = $row["name"];
                    $email = $row["email"];
                    $website = $row["website"];
                    $message = $row["message"];

                    // format date
                    $formattedDate = date("l, F j Y", strtotime($datetime));
                    // outputs "such as" Wednesday, March 9 2022

                    // format time
                    $formattedTime = date("g:iA", strtotime($datetime));
                    // outputs 8:36PM

            ?>


            <div class="comment">

                <div><strong>Date: </strong><?php echo $formattedDate . " at " . $formattedTime; ?></div>
                <div><strong>From: </strong><?php echo $name; ?></div>
                
                <div>
                <?php 
                    if (!empty($website)){
                    echo "<strong>Website: </strong>" . $website; 
                    }?>
                </div>

                <div><strong>Message </strong></div>
                <div><?php echo $message; ?></div>

            </div>

            <?php
                }
                $stmt->close();

            ?>
        </div>

    </body>

</html>

