<?php include 'header.php';
if (isset($_POST["iname"]) && isset($_POST["iprice"]) && isset($_POST["iqty"])) {
    $query = "update items set name=?,cost=?,quantity=?,minlevel=? where id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siiii", $_POST["iname"], $_POST["iprice"], $_POST["iqty"], $_POST["imnqty"], $_GET["id"]);
    if ($stmt->execute()) {
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
                        <h1 class="page-header">Update item</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-bell fa-fw"></i> Update Item</div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form class="form-horizontal">
                                    <fieldset>
                                        <?php
$name;
$price;
$qty;
$mnlevel;
if (isset($_GET["id"])) {
    $query = "Select name,cost,quantity,minlevel from items where id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_GET["id"]);
    $stmt->execute();
    $stmt->bind_result($name, $price, $qty, $mnlevel);
    $stmt->fetch();
}
?>
<input type="text" placeholder="Enter item name" name="iname" value="<?php echo $name; ?>" required/>
<input type="number" placeholder="Enter Unit price" name="iprice" value="<?php echo $price; ?>" required/>
<input type="number" placeholder="quantity" name="iqty" value="<?php echo $qty; ?>" required/>
<input type="number" placeholder="min quantity" name="imnqty" value="<?php echo $mnlevel; ?>"  required/>
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
