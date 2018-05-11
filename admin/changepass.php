<?php include "./header.php";
if (isset($_POST["email"])) {
    $stmt = $conn->prepare("update users set pass=?");
    $stmt->bind_param("s", md5($_POST["email"]));
    $stmt->execute();
}
?>
<div id="page-wrapper">
    <div class="row">

        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Change Password</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <fieldset> 
                            <div class="form-group">
                                <input class="form-control" placeholder="Enter new password" name="email" type="password" autofocus>
                            </div>
                            <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php";?>