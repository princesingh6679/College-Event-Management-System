<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>cems</title>
    <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->

</head>

<style>
    .col-md-8.col-md-offset-2{
        background-color: #8FBC8B;
        
       
    }
    .heading{
        padding-left: 550px;
    }
</style>

<body>

    <?php require 'utils/header2.php';?>
    <h1 class="heading" >Register Your Account</h1>
    <div class="content">
        <!-- body content holder -->
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <form method="POST">


                    <label>Student USN:</label><br>
                    <input type="text" name="usn" class="form-control" required><br><br>

                    <label>Student Password:</label><br>
                    <input type="password" name="pw" class="form-control" required><br><br>

                    <label>Student Name:</label><br>
                    <input type="text" name="name" class="form-control" required><br><br>

                    <label>Branch:</label><br>
                    <input type="text" name="branch" class="form-control" required><br><br>

                    <label>Class:</label><br>
                    <input type="text" name="class" class="form-control" required><br><br>

                    <label>Email:</label><br>
                    <input type="text" name="email" class="form-control" required><br><br>

                    <label>Phone:</label><br>
                    <input type="text" name="phone" class="form-control" required><br><br>

                    <label>College:</label><br>
                    <input type="text" name="college" class="form-control" required><br><br>

                    <button type="submit" class="btn btn-primary" name="up" required>Submit</button><br><br>


            </div>
        </div>

    </div>
    </form>


    <?php require 'utils/footer.php'; ?>
</body>

</html>

<?php

if (isset($_POST["up"])) {
    $usn = $_POST["usn"];
    $pass = $_POST["pw"];
    $name = $_POST["name"];
    $branch = $_POST["branch"];
    $sem = $_POST["class"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $college = $_POST["college"];


    if (!empty($usn) || !empty($pass) || !empty($name) || !empty($branch) || !empty($class) || !empty($email) || !empty($phone) || !empty($college)) {

        include 'classes/db1.php';
        $INSERT = "INSERT INTO participent (usn,pass,name,branch,class,email,phone,college) VALUES('$usn','$pass','$name','$branch','$class','$email','$phone','$college')";

        if ($conn->query($INSERT) === True) {
            echo "<script>
                    alert('Registered Successfully!');
                    window.location.href='usn.php';
                    </script>";
        } else {
            $checkQuery = "SELECT * FROM participent WHERE usn = '$usn' AND pass='$pass'";
            $result = $conn->query($checkQuery);

            if ($result->num_rows > 0) {

                echo "<script>
                    alert('Already registered USN');
                    window.location.href='usn.php';
                    </script>";
            }
        }

        $conn->close();
    } else {
        echo "<script>
            alert('All fields are required');
            window.location.href='register.php';
                    </script>";
    }
}

?>