<!DOCTYPE html>
<?php
include ("./dbconn.php");
    
session_start();
if (isset($_SESSION["usr"])) {
    session_abort();
    session_destroy();
    session_start();
}
// $status = "<p class='alert alert-warning'>Unable to login. Try again</p>";
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $query = "Select id from users where email=? and password=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $_POST["email"],md5( $_POST["password"]));
    if ($stmt->execute()) {
        $stmt->bind_result($id);
        if ($stmt->fetch()) {
            $status = "<p class='alert alert-success'>login successful</p>";
            $_SESSION["usr"]=$id;
            echo "<script>window.location.href='index.php'</script>";
            header("Location:index.php");
        }
        else{
            $status = "<p class='alert alert-danger'>Username or password incorrect</p>";
        }

    }
}
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel</title>

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

 <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
   
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <!-- <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                               </label>
                            </div> -->
                            <?php echo $status;?>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
