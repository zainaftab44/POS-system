<?php include 'header.php';

if (isset($_POST['pname']) && isset($_POST['pprince']) && isset($_POST['ptype'])) {
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
        $pid = $conn->insert_id;
        if ($stmt->execute()) {
            $stmt->close();
            for ($i = 0; $i < sizeof($_POST["iid"]); $i++) {
                $stmt = $conn->prepare("Insert into product_items (pid,iid,iqty) values(?,?,?)");
                $stmt->bind_param("iii", $pid, $_POST["iid"][$i]);
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
       $("#ptype").on('change',function(){
           if(this.value===0){
                $("#table-stock").hide();
           }else if(this.value===1){
                $("#table-stock").show();
           }
       });
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
                    <div class="col-lg-12">
                                <form class="form form-horizontal" method="post" action="./addproduct.php">
                                    <fieldset>
<input type="text" class="form-control-plaintext" placeholder="Enter Product Name" name="pname"/>
<input type="number" class="form-control-plaintext" placeholder="Enter Unit Price" name="pprice"/>
<input type="text" class="form-control-plaintext" placeholder="Enter Description" name="pdesc"/>
 <select class="form-control form-control-lg" id="ptype" name="ptype" style="width:auto" >
    <option> Select type</option>
    <option value="0">Outsource</option>
    <option value="1">Inhouse</option>
 </select>

<!-- <input type="text" class="form-control-plaintext" placeholder="quantity" name="pqty"/> -->
<table id="table-stock"  class="table table-striped">
<th><td>Item</td><td>Quantity</td></th>
<tr id="stock_table">
<td colspan='2'> <select  class="form-control" name="iid[]">
    <?php
    $options='';
    $query = "Select id,name from items";
    $stmt = $conn->prepare($query);
    if ($stmt->execute()) {
        $stmt->bind_result($id, $name);
        while ($stmt->fetch()) {
            $options.="<option value='$id'>$name</option>";
        }

    }
    $stmt->close();
    echo $options;
?>
</select></td>
<td> <input  class="form-control" type="number" placeholder="quantity" name="iqty[]"> </td>
</tr>
</table>
<input type="button" class="btn btn-info" id="add-more" value="Add stock">
<input type="submit" class="btn btn-success" id="save-product" value="Save Product">
                                    </fieldset>
                                </form>
                            </div>
                    <!-- /.col-lg-4 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>

        <script>
        $(document).ready(function () {
            var next = 0;
            $("#add-more").click(function(e){
                e.preventDefault();
                var addto = "#stock_table";
                // var addRemove = "#field" + (next);
                next = next + 1;
                var newIn = '<tr id="'+next+'"><td colspan="2"> <select  class="form-control" name="iid[]"><?php echo $options?></select></td><td> <input  class="form-control" type="number" placeholder="quantity" name="iqty[]"> </td></tr>';
                var newInput = $(newIn);
                $(addto).after(newInput);
            });

        });
        </script>
        <!-- /#wrapper -->
        <?php include 'footer.php'?>
