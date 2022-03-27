<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Guestbook</title>
        <link rel="stylesheet" href="../style.css">
    </head>

        <body>

            <div class="container">
                <?php

                include "../config.php"; 

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

                    $formattedDate = date("l, F j Y", strtotime($datetime));
                    $formattedTime = date("g:iA", strtotime($datetime));

            ?>

                    <div class="comment">

                        <div><strong>Date: </strong><?php echo $formattedDate . " at " . $formattedTime; ?></div>
                        <div><strong>From: </strong><?php echo $name; ?></div>

                        <div>
                        <?php 
                        if (!empty($website)){
                        echo "<div><strong>Website: </strong>" . $website; 
                        }?>
                        </div>

                        <div><strong>Message </strong></div>
                        <div><?php echo $message; ?></div>

                        <!-- create a form with to POST data to index.php (the same file you're writing this in) -->
                        <form method="POST" action="index.php">
                        <!-- this is a hidden field for capturing and passing the id to the query -->
                        <input type="hidden" name="submitID" value="<?php echo $id; ?>">
                        <!-- we are using the name submitDel to reference the submit button click -->
                        <input type="submit" name="submitDel" value="Delete">
                        </form>
                    </div>


            <?php
            }

            $stmt->close();

            if (isset($_POST['submitDel'])) {

                $id = $_POST['submitID'];

                $stmt = $con->prepare("DELETE FROM guestbook WHERE id = ?");
                $stmt->bind_param("s", $id);
                $stmt->execute();
                $stmt->close();

                // this redirects the user
                header('location: index.php');

            }

            ?>
        </div>

    </body>

</html>

