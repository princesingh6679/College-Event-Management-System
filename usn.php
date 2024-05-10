<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>cems</title>
        <title></title>
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        
    </head>
    <style>
        .col-md-6.col-md-offset-3{
            background-color: #EEE8AA;
        }
        </style>
    <body>
        <?php require 'utils/header2.php'; ?><!--header content. file found in utils folder-->

        <div class ="content"><!--body content holder-->
            <div class = "container">
                <div class ="col-md-6 col-md-offset-3">
                    <form action="RegisteredEvents.php" class="form-group" method="POST">
                        <h3>Check my registered events</h3>

                            <label for="usn"> Student USN: </label>
                            <input type="text"
                                   id="usn"
                                   name="usn"
                                   class="form-control" required>

                                   <label>password:</label><br>
        <input type="password" name="pass" class="form-control" required><br><br>
                        <button type="submit" class="btn btn-primary" name="submit" >Check</button>

                    </form>
                </div>
            </div>
</div>
<?php require 'utils/footer.php'; ?>
</body>
</html>
        
        <?php
 if (isset($_POST["submit"]))
 {
     $usn=$_POST["usn"];
     $pass=$_POST["pass"];

     include 'classes/db1.php';
     $checkQuery = "SELECT * FROM participent WHERE usn = '$usn'AND pass='$pass'";
     $result = $conn->query($checkQuery);
     if ($result->num_rows > 0) {
        header("Location: RegisteredEvents.php?usn=" . urlencode($usn)); 
     }
     else {

    
        echo"<script>
        alert('USN not registered. Please register first or password might be wrong');
        </script>";
    }
}
?>




