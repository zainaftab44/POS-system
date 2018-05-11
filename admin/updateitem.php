<?php include 'header.php';
$name;
$price;
$qty;
$mnlevel;
if (isset($_POST["iname"]) && isset($_POST["iprice"]) && isset($_POST["iqty"])) {
    $query = "update items set name=?,cost=?,quantity=?,minlevel=? where id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siiii", $_POST["iname"], $_POST["iprice"], $_POST["iqty"], $_POST["imnqty"], $_GET["id"]);
    if ($stmt->execute()) {
        echo "<script> $(document).ready(function(){
            alert('Stock updated');
            window.location.href = './listitems.php';
        })</script>";
    }
}

if (isset($_GET["id"])) {
    $query = "Select name,cost,quantity,minlevel from items where id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_GET["id"]);
    $stmt->execute();
    $stmt->bind_result($name, $price, $qty, $mnlevel);
    $stmt->fetch();
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
        <div class="col-lg-7">
            <form class="form form-horizontal" method="post" action="./updateitem.php?id=<?php echo $_GET[" id "]?>">
                <div class="control-group">
                    <!-- Username -->
                    <label class="control-label" for="iname">Item Name</label>
                    <div class="controls">
                        <input type="text" class="form-control" placeholder="Item Name" id="iname" name="iname" value="<?php echo $name;?>" required/>
                    </div>
                </div>
                <div class="control-group">
                    <!-- Password-->
                    <label class="control-label" for="iprice">Price</label>
                    <div class="controls">
                        <input type="number" min="0" class="form-control input-lg" placeholder="Unit Price" id="iprice" name="iprice" value="<?php echo $price;?>" required/>
                    </div>
                </div>
                <div class="control-group">
                    <!-- Password-->
                    <label class="control-label" for="iqty">Quantity</label>
                    <div class="controls">
                        <input type="number" class="form-control" min="0" placeholder="Quantity" id="iqty" name="iqty" value="<?php echo $qty;?>" required/>
                    </div>
                </div>
                <div class="control-group">
                    <!-- Password-->
                    <label class="control-label" for="imnqty">Lower Boundary</label>
                    <div class="controls">
                        <input type="number" class="form-control" placeholder="Min Quantity" id="imnqty" name="imnqty" min="0" value="<?php echo $mnlevel;?>" required/>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<!-- /#wrapper -->
<?php include 'footer.php'?>