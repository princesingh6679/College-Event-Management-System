<?php
include_once 'classes/db1.php';


// Fetch distinct event names for the dropdown
$eventQuery = mysqli_query($conn, "SELECT DISTINCT event_title FROM events ORDER BY event_title");
$events = mysqli_fetch_all($eventQuery, MYSQLI_ASSOC);

$totalAmount = 0;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedEvent = $_POST["selected_event"];

    // Query to retrieve details of students for the selected event
    $result = mysqli_query($conn, "SELECT * FROM events
        JOIN registered r ON events.event_id = r.event_id
        JOIN participent p ON r.usn = p.usn
        WHERE events.event_title = '$selectedEvent'
        ORDER BY events.event_title");

    if (mysqli_num_rows($result) > 0) {
        // Display the student details in a table
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>cems</title>
            <?php require 'utils/styles.php'; ?>
            <!-- CSS links, file found in utils folder -->
        </head>


        <style>

.table-hover th {
    background-color: springgreen;
    color:black;
} 

.total-amount {
        background-color: orange; /* Light gray background */
        padding: 10px; /* Padding for spacing */
        margin-top:40px;
        border-radius: 5px; /* Rounded corners */
        border: 1px solid #ccc; /* Border */
        font-family: Arial, sans-serif; /* Font */
        font-size: 16px; /* Font size */
        color: #333; /* Text color */
        display: inline-block;
        font-weight:bold;
    }

    </style>

        

        <body>
            <?php include 'utils/adminHeader.php' ?>
            <div class="content">
                <div class="container">
                    <h1>Student details for <?php echo $selectedEvent; ?></h1>

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
                    <div class="total-amount">Total Amount Generated:   <?php echo $totalAmount; ?></div><br>

                   <br> <a href="Stu_details.php" class="btn btn-primary">Back to Main Page</a>
                </div>
            </div>

    <?php include 'utils/footer.php'?>;

        </body>

        </html>
        <?php
    } else {
        echo "<script>
        alert('No participant yet');
        window.location.href='Stu_details.php';
        </script>";
    }
    exit(); // Stop execution after displaying student details
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>cems</title>
    <?php require 'utils/styles.php'; ?>
    <!-- CSS links, file found in utils folder -->
</head>

<body>
    <?php include 'utils/adminHeader.php' ?>
    <div class="content">
        <div class="container">
            <h1>Student Details</h1>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                    <label for="selected_event">Select Event:</label>
                    <select class="form-control" id="selected_event" name="selected_event" required><
                        <?php
                        // Populate the dropdown with distinct event names
                        foreach ($events as $event) {
                            echo "<option value='" . $event["event_title"] . "'>" . $event["event_title"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Get Student Details</button>
                <a href="fulldetail.php" class="btn btn-primary">Show whole participant</a>

            </form>
        </div>
    </div>

    <?php include 'utils/footer.php'?>;

</body>

</html>
