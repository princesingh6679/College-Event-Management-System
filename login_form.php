<?php
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the submitted form contains the fields "name" and "password"
    if (isset($_POST["name"]) && isset($_POST["password"])) {
        $myusername = $_POST['name'];
        $mypassword = $_POST['password'];

        // Check if the admin credentials are correct
        if ($mypassword == 'admin' && $myusername == 'admin') {
            echo "login successful";
            // Redirect to admin page if credentials are correct
            $_SESSION['user']=$myusername;
            header("Location: adminPage.php");
            // Terminate script after redirection
        } else {
            // Display error message if credentials are incorrect
            $error_message = "Invalid credentials";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- prevent back navigation -->
    <!-- <script type ="text/javascript">
        function preventBack(){
            window.history.forward()};
            setTimeout("preventBack(),0");
            window.onunload=function(){null;}
            </script>
    <title>Login Page</title> -->

    <link href="logcss/bootstrap.min.css" rel="stylesheet">
    <link href="logcss/font-awesome.min.css" rel="stylesheet">
    <link href="logcss/style.css" rel="stylesheet">
    <style>
        .btn_uy button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn_uy button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<section class="form-01-main">
    <div class="form-cover">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-sub-main">
                        <div class="_main_head_as">
                            <a href="#">
                                <img src="images/vector.png">
                            </a>
<h2>Admin Login<h2>

                        </div>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-group">
                                <input id="email" name="name" class="form-control _ge_de_ol" type="text" placeholder="Enter Email" required="" aria-required="true">
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control" name="password" placeholder="********" required="required">
                                <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                            </div>
                            
                            <div class="form-group btn_uy">
                                <button type="submit"><span>Login</span></button>
                                <?php if(isset($error_message)) { ?>
                                    <p style="color: red;"><?php echo $error_message; ?></p>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
