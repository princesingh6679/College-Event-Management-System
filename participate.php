<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>cems</title>
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        
    </head>
    <body>
    <?php require 'utils/header2.php'; ?>

    <?php

    include 'classes/db1.php';
    if (isset($_GET['id'])) {
        $eventid = $_GET['id'];
    }

    $query = "SELECT event_price FROM events WHERE event_id = '$eventid'";
$result =  $conn->query($query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $event_price = $row['event_price'];
} else {
    echo "Error retrieving event price: " .$conn->error;
}
    ?>


    <div class ="content"><!--body content holder-->
            <div class = "container">
                <div class ="col-md-6 col-md-offset-3">
    <form method="POST">

   
        <label>Student USN:</label><br>
        <input type="text" name="usn" class="form-control" required><br><br>
        <label>password:</label><br>
        <input type="password" name="pass" class="form-control" required><br><br>
        <label >Amount to be paid:<?Php  echo "Rs ".$event_price;?></label><br>


        <button type="submit" class="btn btn-success" name="update" >Pay & participte</button><br><br>
        <a href="usn.php" ><u>Already participated?</u></a>
        </div>
        </div>
    </div>
    </form>

    <!-- <script>
    function redirectToPay() {
      // Redirect to pay.html
      window.location.href = 'pay.html';
    }
  </script> -->
    <?php require 'utils/footer.php'; ?>
    </body>


</html>


<?php

    if (isset($_POST["update"]))
    {
        $usn=$_POST["usn"];
        $pass=$_POST["pass"];

        // Check if the userid is already present in the participant table
$checkQuery = "SELECT * FROM participent WHERE usn = '$usn' AND pass='$pass'";
$result = $conn->query($checkQuery);

if ($result->num_rows > 0) {
    session_start(); // Start session
    $_SESSION['usn'] = $usn; // Store usn in session
    $_SESSION['pass'] = $pass; // Store pass in session
    $_SESSION['eid']=$eventid;
    header("Location: payment_page.php?event_id=$eventid");
    exit();
    // else {
    //     echo "Error: " . $INSERT2 . "<br>" . $conn->error;
    // }
} else {
    echo"<script>
    alert('USN not registered. Please register first or password might be wrong');
    </script>";
}
    }

  ?>
   