<?php include "header.php";
//simple orders
$query = "Select Count(id) from invoice";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($sbillcount);
$stmt->fetch();
$stmt->close();

//inhouse products
$query = "Select Count(id) from products where type=1";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($ihprodcount);
$stmt->fetch();
$stmt->close();

//outsource products
$query = "Select Count(id) from products where type=0";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($outprodcount);
$stmt->fetch();
$stmt->close();

// deliveries today
$query = "Select Count(id) from invoice ";
$query .= " where due_date= '" . date('Y-m-d') . "'";
echo date('Y-m-d');
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($tdlvrcount);
$stmt->fetch();
$stmt->close();

// pending bills
$query = "Select Count(id) from invoice ";
$query .= " where status= 0";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($pendbillcount);
$stmt->fetch();
$stmt->close();
// low quantity level count
$query = "Select Count(id) from items where quantity<minlevel ";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($mnlvlcount);
$stmt->fetch();
$stmt->close();
// low quantity level count
$query = "Select Count(id) from messages";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($msgcount);
$stmt->fetch();
$stmt->close();



?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo $sbillcount; ?>
                            </div>
                            <div>Orders!</div>
                        </div>
                    </div>
                </div>
                <a href="billslist.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo $msgcount; ?>
                            </div>
                            <div>Messages!</div>
                        </div>
                    </div>
                </div>
                <a href="messages.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo $ihprodcount; ?>
                            </div>
                            <div>Inhouse products!</div>
                        </div>
                    </div>
                </div>
                <a href="listproducts.php?type=1">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo $outprodcount; ?>
                            </div>
                            <div>Oursource products!</div>
                        </div>
                    </div>
                </div>
                <a href="listproducts.php?type=0">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-truck fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo $tdlvrcount; ?>
                            </div>
                            <div>Deliveries Today!</div>
                        </div>
                    </div>
                </div>
                <a href="billslist.php?deliveries=today">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-exclamation-circle fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo $pendbillcount; ?>
                            </div>
                            <div>Pending Bills!</div>
                        </div>
                    </div>
                </div>
                <a href="billslist.php?status=pending">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-warning fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                <?php echo $mnlvlcount; ?>
                            </div>
                            <div>Low Quantity Stock!</div>
                        </div>
                    </div>
                </div>
                <a href="listitems.php?status=low">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <?php
        if($msgcount<=0){
         echo '<div class="col-lg-12">
            <h1 class="page-header">No message received</h1>
        </div>';
        }
        else{
$stmt = $conn->prepare("Select email,name,subject,message,creation_time from messages Order By creation_time DESC Limit 0,5");
$stmt->execute();
$stmt->bind_result($em, $nam, $subj, $msg, $dat);
?>

        <div class="col-lg-12">
            <h1 class="page-header">Latest 5 Messages</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <?php
while ($stmt->fetch()) {
    ?>

            <div class="left-panel">
                <div class="col-xs-11 col-sm-5 col-lg-5">
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
}

}
?>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include 'footer.php'?>