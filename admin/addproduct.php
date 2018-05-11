<?php include 'header.php';
// error_reporting(E_ALL);
if (isset($_POST['pname']) && isset($_POST['pprice']) && isset($_POST['ptype'])) {
    if ($_POST['ptype'] == 0) {
        $query = "Insert into products (name, cost,type,description)values(?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("siis", $_POST['pname'], $_POST['pprice'], $_POST['ptype'], $_POST['pdesc']);
        if ($stmt->execute()) {
            echo "<script> $(document).ready(function(){
                alert('Product added');
                window.location.href = './listproducts.php';
            })</script>";
        }
    } else if ($_POST['ptype'] == 1) {
        $query = "Insert into products (name, cost,type,description)values(?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("siis", $_POST['pname'], $_POST['pprice'], $_POST['ptype'], $_POST['pdesc']);
        $rv = $stmt->execute();
        //echo mysqli_error($conn);
        if ($rv) {
            $pid = $conn->insert_id;
            $stmt->close();
            for ($i = 0; $i < sizeof($_POST["iid"]); $i++) {
                $stmt = $conn->prepare("Insert into product_items (pid,iid,iqty) values(?,?,?)");
                $stmt->bind_param("iii", $pid, $_POST["iid"][$i],$_POST["iqty"][$i]);
                $stmt->execute();
                $stmt->close();
            }

            echo "<script> $(document).ready(function(){
                alert('Product added');
                window.location.href = './listproducts.php';
            })</script>";
        }
    }
}
?>

<script>
    function changedval(obj) {
        if (obj.value == 0) {
            $("#add-more").hide();
            $("#table-stock").hide();
        } else if (obj.value == 1) {
            $("#add-more").show();
            $("#table-stock").show();
        }
    }
</script>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Product</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <form class="form form-horizontal" method="post" action="./addproduct.php">
                    Product Name: <input type="text" class="form-control form-control-plaintext" placeholder="Enter Product Name" name="pname" required/>
                    Unit Price: <input type="number" class="form-control form-control-plaintext" placeholder="Enter Unit Price" name="pprice"  required/>
                    Description: <input type="text" class="form-control form-control-plaintext" placeholder="Enter Description" name="pdesc"  required/>
                    <br/> <select class="form-control form-control-lg" onchange="changedval(this)" id="ptype" name="ptype" style="width:auto"  required>
                        <option value="1">Inhouse</option>
                        <option value="0">Outsource</option>
                    </select>

                    <!-- <input type="text" class="form-control-plaintext" placeholder="quantity" name="pqty"/> -->
                    <table id="table-stock" class="table table-bordered table-hover table-striped">
                        <thead>
                            <th>
                                <td>Item</td>
                                <td>Quantity</td>
                            </th>
                        </thead>
                        <tr id="stock_table0">
                            <!-- <td> <select class="form-control" name="iid[]"> -->
                            <?php
$options = '';
$query = "Select id,name from items";
$stmt = $conn->prepare($query);
if ($stmt->execute()) {
    $stmt->bind_result($id, $name);
    while ($stmt->fetch()) {
        $options .= "<option value=\"$id\">$name</option>";
    }

}
$stmt->close();
// echo $options;
?>
                                <!-- </select></td> -->
                                <!-- <td><input class="form-control" type="number" placeholder="quantity" name="iqty[]"></td> -->
                                <!-- <td><input type="button" class="btn btn-info" id="add-more0" value="+"></td> -->
                        </tr>
                    </table>
                    <br/>
                    <input type="button" class="btn btn-info" id="add-more" value="+" />
                    <input type="submit" class="btn btn-success" id="save-product" value="Save Product">
            </form>
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>

<script>
    $(document).ready(function() {
        var next = 0;
        $("#add-more").click(function(e) {
            e.preventDefault();
            var addto = "#stock_table0" // + (next);
            var addRemove = "#stock_table" + (next);
            next = next + 1;
            var newIn = '<tr id="stock-table' + next + '"><td> <select  class="form-control" name="iid[]"><?php echo $options ?></select></td><td> <input  class="form-control" type="number" placeholder="quantity" name="iqty[]"  required> </td><td><button id="remove' + (next) + '" class="btn btn-danger remove-me" >X</button></td></tr>'; //<input type="button" class="btn btn-info" id="add-more'+(next)+'" value="+"></td></tr>';
            var newInput = $(newIn);
            // var add=$("#add-more"+(next-1))
            //   var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >X</button>';
            // var removeButton = $(removeBtn);
            //     $(addto).after(newInput);
            // var removeButton = $(removeBtn);
            $(addto).after(newInput);
            // $(addRemove).after(removeButton);

            $('.remove-me').click(function(e) {
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length - 1);
                var fieldID = "#stock-table" + fieldNum;
                $(fieldID).remove();
                $(this).remove();
            });
        });

    });
</script>
<!-- /#wrapper -->
<?php include 'footer.php'?>