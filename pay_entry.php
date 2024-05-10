<?php
                include_once 'classes/db1.php';
                session_start(); // Start session

                // Check if payment was successful
                if (isset($_SESSION['usn']) &&($_SESSION ['eid'])) {
                    // $eventid = $_GET['event_id'];
                    $usn = $_SESSION['usn'];
                    $eventid=$_SESSION['eid'];
                    $INSERT2 = "INSERT INTO registered (usn, event_id) VALUES ('$usn', '$eventid')";
                    $conn->query($INSERT2);
                }
                    // Execute the SQL query to insert the data into the database
                    // You need to properly execute this query using the database connection $conn
                //     if ($conn->query($INSERT2) === TRUE) {
                //         echo"<script>
                //         alert('Thank you for participation');
                //         </script>";
                //     }
                //  else {
                //     echo "Error: " . $INSERT2 . "<br>" . $conn->error;
                // }
  ?>
                
    