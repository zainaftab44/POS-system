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
            <form class="form form-horizontal" method="post" action="./updateitem.php?id=<?php echo $_GET["id"]?>">
                <input type="text" class="form-control" placeholder="Item Name" name="iname" value="<?php echo $name;?>" required/>
                <br/>
                <input type="number" class="form-control" placeholder="Unit Price" name="iprice"  value="<?php echo $price;?>"  required/>
                <br/>
                <input type="number" class="form-control" placeholder="Quantity" name="iqty" value="<?php echo $qty;?>"  required/>
                <br/>
                <input type="number" class="form-control" placeholder="Min Quantity" name="imnqty" value="<?php echo $mnlevel;?>"  required/>
                <br/>
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