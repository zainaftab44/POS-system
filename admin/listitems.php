<?php include 'header.php';?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">List Items</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-striped">
                    <th><td>name</td><td>quantity</td><td>price</td><td>Status</td><td></td></th>
                    <?php
if (isset($_POST["iname"]) && isset($_POST["iprice"]) && isset($_POST["iqty"])) {
    $query = "Select id,name,cost,quantity,minlevel from items";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        $stmt->bind_result($id, $name, $price, $qty, $mnlevel);
        while ($stmt->fetch()) {
            $status = "<i class='alert alert-success'>No issues</i>";
            if ($mnlevel >= $qty) {
                $status = "<i class='alert alert-danger'>Low quantity</i>";
            }
            echo "<tr><td>$id</td><td>$name</td><td>$qty</td><td>$price</td><td>$status</td><td><a class='btn btn-warning' href='./updateitem.php?id=$id' >Update</a><a class='btn btn-danger' href='./removeitem.php?id=$id'>Remove</a></td></tr>";
        }

    }
}
?>
                </table>
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>

<!-- /#wrapper -->
<?php include 'footer.php'?>
