<?php include 'header.php';?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Product Details </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <?php
                $id;
                $pname;
                $pprice;
                $ptype;
                $query = "Select id,name,cost,type from products where id=?;";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $_GET["id"]);
                $stmt->execute();
                $stmt->bind_result($id, $pname, $pprice, $ptype);
                $stmt->fetch();
                $type;
                if ($ptype == 0) {
                    $type = "Outsource";
                } else {
                    $type = "Inhouse";
                }

                $stmt->close();
            ?>
                <p>Product name: <input type="text" value="<?php echo $pname; ?>" placeholder="Product Name" name="pname" required disabled/></p>
                <p>Unit Price:<input type="text" value="<?php echo $pprice; ?>" placeholder="Product Price" name="pprice" required disabled/></p>
                <p>Type: <?php echo $type; ?></p>
               <?php if($ptype!=0){ ?>
                <table class="table table-bordered table-striped">
                    <th>
                        <td>name</td>
                        <td>quantity</td>
                        <!-- <td></td> -->
                    </th>
                    <?php
$query = "Select pi.id,i.name,pi.iqty from product_items pi,items i where pi.pid=? AND pi.iid=i.id order by pi.id asc;";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$stmt->bind_result($iid, $name, $qty);
while ($stmt->fetch()) {
    echo "<tr>
                           <td>$iid</td>
                           <td>$name</td>
                           <td>$qty</td>
                           </tr>";
}
$stmt->close();
?>
                </table>
                <?php } ?>
        </div> 
    </div>
</div>
<?php include 'footer.php'?>