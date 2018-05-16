<!DOCTYPE html>
<?php include "dbconn.php";
session_start();
if (!isset($_SESSION['usr'])) {
    header("Location:login.php");
}?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sales management system</title>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex">


    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#myTable").tablesorter();
        });
    </script>
    <style>
        th.headerSortUp {
            background-image: url('../images/asc.gif');
            /* background-color: #3399FF;  */
            background-repeat: no-repeat;
            background-position: center right;
        }
        
        th.headerSortDown {
            background-image: url('../images/desc.gif');
            /* background-color: #3399FF;  */
            background-repeat: no-repeat;
            background-position: center right;
        }
    </style>
</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <a class="navbar-brand" href="/admin">Sales Panel</a>
               
            </div>
            <div>
                     <?php 
                if(isset($print)&& $print==0){
                    $print=1;
                }
                if($print==1){?>
                <div class="pull-right">
                    <button class="btn btn-primary hidden-print pull-right" onclick="PrintPanel()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
                    <a class="btn btn-primary pull-right" href="./clearbill.php?id=<?php echo $id; ?>">Clear bill</a>
                </div>
                <?php }?>
            </div>
            <!-- /.navbar-header -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="addbill.php"><i class="fa fa-bar-chart-o fa-fw"></i> Add Order</a>
                        </li>
                        <li>
                            <a href="billslist.php"><i class="fa fa-list fa-fw"></i> List Orders</a>
                        </li>
                        <li>
                            <a href="listitems.php"><i class="fa fa-shopping-cart fa-fw"></i> List Stock </a>
                        </li>
                        <li>
                            <a href="additem.php"><i class="fa fa-plus-square fa-fw"></i> Add Stock</a>
                        </li>
                        <li>
                            <a href="addproduct.php"><i class="fa fa-plus-circle fa-fw"></i> Add Product</a>
                        </li>
                        <li>
                            <a href="listproducts.php"><i class="fa fa-product-hunt fa-fw"></i> List Products</a>
                        </li>
                        <li>
                            <a href="messages.php"><i class="fa fa-comments fa-fw"></i> Messages</a>
                        </li>
                        <li>
                            <a href="changepass.php"><i class="fa fa-key fa-fw"></i> Change Password</a>
                        </li>
                        <li>
                            <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </div>

        </nav>