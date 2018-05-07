<!DOCTYPE html>
<?php include "dbconn.php";
session_start();
if(!isset($_SESSION['usr'])) {
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
        <!-- Bootstrap Core CSS -->
        <!-- <link href="./css/bootstrap.min.css" rel="stylesheet"> -->
        <meta charset='UTF-8'><meta name="robots" content="noindex">

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

        <!-- Custom Fonts -->
        <!-- <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
        <!--        <link href="../css/calender.min.css" rel="stylesheet" type="text/css">-->

        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'><link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                    <a class="navbar-brand" href="index.html">Sales Panel</a>
                </div>
                <!-- /.navbar-header -->
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="addbill.php"><i class="fa fa-bar-chart-o fa-fw"></i>Add Order</a>
                            </li>
                            <li>
                                <a href="billslist.php"><i class="fa fa-table fa-fw"></i>List Orders</a>
                            </li>

                            <li>
                                <a href="calendar.php"><i class="fa fa-table fa-fw"></i>Orders Calendar</a>
                            </li>
                            <li>
                                <a href="listitems.php"><i class="fa fa-edit fa-fw">List Stock</i> </a>
                            </li>
                            <li>
                                <a href="additem.php"><i class="fa fa-wrench fa-fw"></i>Add Stock</a>
                            </li>
                            <li>
                                <a href="addproduct.php"><i class="fa fa-sitemap fa-fw"></i> Add Product</a>
                            </li>
                            <li>
                                <a href="listproducts.php"><i class="fa fa-sitemap fa-fw"></i> List Products</a>
                            </li>

                            <li>
                                <a href="salesreports.php"><i class="fa fa-sitemap fa-fw"></i> Reports</a>
                            </li>
                        </ul>
                    </div>

            </nav>
