<?php include 'header.php';?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">List Products</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
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
    <div class="row">
        <div class="col-lg-12">
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$query = "Select id,name,cost,type from products ";
if (isset($_GET["type"])) {
    $query .= "where type = " . $_GET["type"];
}
// echo $query;
$stmt = $conn->prepare($query);
if ($stmt->execute()) {
    $stmt->bind_result($id, $name, $price, $type);
    while ($stmt->fetch()) {

        if ($type == 0) {
            $type = "Outsource";
        } else {
            $type = "Inhouse";
        }

        echo " <tr><td>$id</td><td>$name</td><td>$price</td><td>$type</td><td><a href='productDetails.php?id=$id' class='btn btn-primary'>Details</a><a href='?id=$id' class='btn btn-danger'>remove</a></td></tr>";
    }

}
?>
                </tbody>
            </table>
            <div id="pager"></div>
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<script>
    $(document).ready(function() {
        $("#myTable").tablesorter();
    });
</script>
<!-- /#wrapper -->
<?php include 'footer.php'?>