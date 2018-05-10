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
        <div class="col-lg-7">
            <form class="form form-horizontal" method="post" action="additem.php">
                    <input type="text" class="form-control" placeholder="Enter item name" name="iname" required/>
                    <br/>
                    <input type="number" class="form-control" placeholder="Enter Unit price" name="iprice" required/>
                    <br/>
                    <input type="number" class="form-control" placeholder="quantity" name="iqty" required/>
                    <br/>
                    <input type="number" class="form-control" placeholder="min quantity" name="imnqty" required/>
                    <br/>
                    <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>

<!-- /#wrapper -->
<?php include 'footer.php'?>