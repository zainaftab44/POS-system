<?php include 'header.php';
if (isset($_POST["iname"]) && isset($_POST["iprice"]) && isset($_POST["iqty"])) {
    $query = "Insert into items (name,cost,quantity,minlevel) values(?,?,?,?)";
    $stmt= $conn->prepare($query);
    $stmt->bind_param("siii",$_POST["iname"],$_POST["iprice"],$_POST["iqty"],$_POST["imnqty"]);
    if($stmt->execute()){
        echo "<script> $(document).ready(function(){
            alert('Stock added');
            window.location.href = './listitems.php';
        })</script>";
    }
}
?>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Stock item</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-bell fa-fw"></i> Add Product</div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form class="form-horizontal" method="post" action="additem.php">
                                    <fieldset>
<input type="text" placeholder="Enter item name" name="iname" required/>
<input type="number" placeholder="Enter Unit price" name="iprice" required/>
<input type="number" placeholder="quantity" name="iqty" required/>
<input type="number" placeholder="min quantity" name="imnqty" required/>
<button type="submit">Save</button>
                                    </fieldset>
                                </form>
                            </div>
                            <!-- /.panel-body -->
                        </div>

                        <!-- /.panel .chat-panel -->
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>

        <!-- /#wrapper -->
        <?php include 'footer.php'?>
