<?php include "header.php";
$res = $conn->query("Select id from messages");
$count = $res->num_rows;
$res = 0;

$stmt = $conn->prepare("Select email,name,subject,message,creation_time from messages Order By creation_time DESC Limit ?,10");
$pgnum = 0;
if (isset($_GET["pg"])) {
    $pgnum = $_GET["pg"] * 10;
}

$stmt->bind_param("i", $pgnum);
$stmt->execute();
$stmt->bind_result($em, $nam, $subj, $msg, $dat);
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Messages</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <?php
while ($stmt->fetch()) {
    ?>

            <div class="left-panel">
                <div class="col-xs-12 col-sm-6 col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="icerik-bilgi">
                                    <h2>
                                       Subject: <?php echo $subj; ?>
                                    </h2>
                                    </a>
                                    <p>
                                       Message:  <?php echo $msg; ?>
                                    </p>
                                    <div class="btn-group">
                                        <p class="btn btn-social" data-toggle="tooltip" title="Sender Email"><i class="fa fa-2x fa-envelope"></i>
                                            <?php echo $em; ?>
                                        </p>
                                        <p class="btn btn-social" data-toggle="tooltip" title="Sender Name"><i class="fa fa-2x fa-user"></i>
                                            <?php echo $nam; ?>
                                        </p>
                                        <p class="btn btn-social" data-toggle="tooltip" title="Creation Date"><i class="fa fa-2x fa-calendar-times-o"></i>
                                            <?php echo $dat; ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
}?>
    </div>
</div>
<?php include "footer.php";?>