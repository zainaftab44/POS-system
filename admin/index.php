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
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $sbillcount; ?></div>
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
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $ihprodcount; ?></div>
                                        <div>inhouse products!</div>
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
                                        <div class="huge"><?php echo $outprodcount; ?></div>
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
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $tdlvrcount; ?></div>
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
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $pendbillcount; ?></div>
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
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $mnlvlcount; ?></div>
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

                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
        <?php include 'footer.php'?>
