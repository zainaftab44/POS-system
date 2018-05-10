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
                <thead>
                    <th>
                        <td>name</td>
                        <td>quantity</td>
                        <td>price</td>
                        <td>Status</td>
                        <td></td>
                    </th>
                </thead>
                <?php
    $query = "Select id,name,cost,quantity,minlevel from items";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        $stmt->bind_result($id, $name, $price, $qty, $mnlevel);
        while ($stmt->fetch()) {
            $status = "<p class='alert alert-success'>No issues</p>";
            if ($mnlevel >= $qty) {
                $status = "<p class='alert alert-danger'>Low quantity</p>";
            }
            echo "<tr><td>$id</td><td>$name</td><td>$qty</td><td>$price</td><td>$status</td><td><a class='btn btn-warning' href='./updateitem.php?id=$id' >Update</a>&nbsp;&nbsp;<a class='btn btn-danger' href='./removeitem.php?id=$id'>Remove</a></td></tr>";
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