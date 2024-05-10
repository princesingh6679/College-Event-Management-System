<?php
include_once 'classes/db1.php';
$result = mysqli_query($conn, "SELECT * FROM events,registered r ,participent p WHERE events.event_id=r.event_id and r.usn = p.usn order by event_title");
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>cems</title>
    <title></title>
    <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->

</head>


<style>
    .table-hover th {
        background-color: springgreen;
        color: black;
    }


    .total-amount {
        background-color: orange;
        /* Light gray background */
        padding: 10px;
        /* Padding for spacing */
        margin-top: 40px;
        border-radius: 5px;
        /* Rounded corners */
        border: 1px solid #ccc;
        /* Border */
        font-family: Arial, sans-serif;
        /* Font */
        font-size: 16px;
        /* Font size */
        color: #333;
        /* Text color */
        display: inline-block;
        font-weight: bold;
    }
</style>


<body><?php include 'utils/adminHeader.php' ?>
    <div class="content">
        <div class="container">
            <h1>Student details</h1>
            <?php

            $totalAmount = 0;

            if (mysqli_num_rows($result) > 0) {
            ?>
                <table class="table table-hover">

                    <tr>
                        <th>Serial No.</th>
                        <th>USN</th>
                        <th>Name</th>
                        <th>Branch</th>
                        <th>Class</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>College</th>
                        <th>Event</th>
                        <th>price paid</th>

                    </tr>
                    <?php
                    $i = 1; // Initialize serial number
                    while ($row = mysqli_fetch_array($result)) {
                        $totalAmount += $row["event_price"];
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row["usn"]; ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["branch"]; ?></td>
                            <td><?php echo $row["class"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["phone"]; ?></td>
                            <td><?php echo $row["college"]; ?></td>
                            <td><?php echo $row["event_title"]; ?></td>
                            <td><?php echo $row["event_price"]; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>

                <div class="total-amount">Total Amount Generated: <?php echo $totalAmount; ?></div>

            <?php
            } else {
                echo "No result found";
            }
            ?>
        </div>
    </div>

    <?php include 'utils/footer.php' ?>;
</body>

</html>