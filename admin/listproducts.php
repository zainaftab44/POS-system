<?php include 'header.php';?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">List Products</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-striped">
                <thead><th>
                    <td>Name</td>
                    <td>Price</td>
                    <td>Type</td>
                    <td></td>
                </th></thead>
                <?php
                    $query = "Select id,name,cost,type from products ";
                    if(isset($_GET["type"])){
                        $query.= "where type = ".$_GET["type"];
                    }
                    // echo $query;
                    $stmt = $conn->prepare($query);
                    if ($stmt->execute()) {
                        $stmt->bind_result($id, $name, $price, $type);
                        while ($stmt->fetch()) {
                           
                            if($type == 0)
                                $type="Outsource"; 
                                else
                                $type="Inhouse";
                            echo " <tr><td>$id</td><td>$name</td><td>$price</td><td>$type</td><td><a href='productDetails.php?id=$id' class='btn btn-primary'>Details</a><a href='?id=$id' class='btn btn-danger'>remove</a></td></tr>";
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

<!-- /#wrapper -->
<?php include 'footer.php'?>