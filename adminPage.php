<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:login_form.php');
}

include_once 'classes/db1.php';
$result = mysqli_query($conn, "SELECT * FROM staff_coordinator s ,event_info ef ,student_coordinator st,events e where e.event_id= ef.event_id and e.event_id= s.event_id and e.event_id= st.event_id");
?>


<style>
    .table-hover th {
        background-color: #23dff0;
        color: black;
    }
</style>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>cems</title>
</head>

<body>
    <?php include 'utils/adminHeader.php' ?>

    <div class="content">
        <div class="container">
            <h1>Event details</h1>
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Event_name</th>
                            <th>Price</th>
                            <th>Student Co-ordinator</th>
                            <th>Staff Co-ordinator</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Location</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['event_title'] . '</td>';
                            echo '<td>' . $row['event_price'] . '</td>';
                            echo '<td>' . $row['st_name'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['Date'] . '</td>';
                            echo '<td>' . $row['time'] . '</td>';
                            echo '<td>' . $row['location'] . '</td>';
                            echo '<td>'
                                . '<a href="deleteEvent.php?id=' . $row['event_id'] . '"class = "btn btn-danger">Delete</a> '
                                . '</td>';
                            echo '</tr>';
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <a class="btn btn-success" href="createEventForm.php">Create Event</a>
        </div>
    </div>

    <?php require 'utils/footer.php'; ?>
</body>

</html>