<?php
include "header.php";
// error_reporting(E_ALL);
if (isset($_POST["name"]) && isset($_POST["payed"]) && isset($_POST["total"]) && isset($_POST["phone"]) && isset($_POST["fdate"]) && isset($_POST["tdate"])) {
    $query = "Insert into invoice (payed,total,name,phone,due_date,st_date) values (?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iissss", $_POST["payed"],$_POST["total"], $_POST["name"], $_POST["phone"], $_POST["tdate"], $_POST["fdate"]);
    echo mysqli_error($conn);

    $stmt->execute();
    $bid = $conn->insert_id;
    $stmt->close();
    
    if (isset($_POST["iname"])) {
        for ($i = 0; $i < sizeof($_POST["iname"]); $i++) {
            $stmt = $conn->prepare("Insert into invoiceproducts (invoiceid,productid,quantity,unitprice) values(?,?,?,?)");
            // echo "Insert into invoiceproducts (invoiceid,productid,quantity,unitprice) values(?,?,?,?)";
            $stmt->bind_param("iiii", $bid, $_POST["iname"][$i], $_POST["quantity"][$i], $_POST["price"][$i]);
            $stmt->execute();
            // echo mysqli_error($conn);
            $stmt->close();
        }
    }
} 

$query = "Select id,name,cost from products";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($id, $name, $price);
$options = "";
$arr = array();
while ($stmt->fetch()) {
    $options .= "<option value=\"$id\">$name</option>";
    $arr["$id"] = $price;
}
?>
    <script>
        var prices = <?php echo json_encode($arr); ?>;

        function updprice(place, obj) {
            var input = document.getElementById("iprice" + place);
            input.value = prices[obj];
        }

        function updateprice(id) {
            var prc = document.getElementById("iprice" + id);
            var qty = document.getElementById("iqty" + id);

            var subtotal = prc.value * qty.value
            var sub = document.getElementById("sub" + id);
            sub.innerHTML = subtotal;
            var eles = document.getElementsByName("quantity[]");
            var total=0;
            for (var i = 0; i < eles.length; i++) {
               var sub=document.getElementById("sub" + eles[i].id.slice(-1));
                 total +=parseInt(sub.innerHTML)
            }
            var tot = document.getElementById("tota");
tot.value=total;

        }
    </script>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Order</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <form class="form-horizontal" method="post" action="addbill.php">
                    <div class="row">
                        <div class=" col-md-7 form-group pull-left">
                            <label class="col-md-4 control-label " for="name">Name</label>
                            <div class="col-md-6">
                                <input id="name" name="name" type="text" placeholder="Customer Name" class="form-control input-md" required="">
                            </div>
                            <br>
                            <label class="col-md-4 control-label" for="name">Contact no.</label>
                            <div class="col-md-6">
                                <input id="name" name="phone" type="text" placeholder="Customer Number" class="form-control input-md" required="">
                            </div>
                        </div>
                        <div class="col-md-5 form-group pull-right">
                            <label class="col-md-4 control-label " for="name">From </label>
                            <div class="col-md-6">
                                <input id="name" name="fdate" type="date" placeholder="Date" class="form-control input-md" required="">
                            </div>
                            <label class="col-md-4 control-label" for="name">To </label>
                            <div class="col-md-6">
                                <input id="name" name="tdate" type="date" placeholder="Date" class="form-control input-md" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <input type="button" class="btn btn-info" id="add-more" value="+" />
                    </div>
                    <table class="table table-bordered table-bordered table-striped">
                        <thead>
                            <th>

                                <td>
                                    Product
                                </td>
                                <td>
                                    Quantity
                                </td>
                                <td>
                                    Unit Price
                                </td>
                                <td>
                                    Subtotal
                                </td>
                            </th>
                        </thead>
                        <tbody>
                            <tr id="products-table0">
                                <!--    <td>
                                    <select name="iname[]" id="iname0" onchange="updprice(0,this.value)" class="form-control">
                                    <?php echo $options; ?>
                                </select>
                                </td>
                                <td>
                                    <input type="number" id="iqty0" onchange="updateprice(0)" name="quantity[]" placeholder="Quantity" class="form-control input-md" />
                                </td>

                                <td>
                                    <input type="number" id="iprice0" disabled onchange="updateprice(0)" class="form-control input-md" name="price[]" placeholder="Price" />
                                </td>

                                <td>
                                    <p id="sub0">00.00</p>
                                </td>-->
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td colspan="4">
                                    <input name="total" id="tota" type="number" onchange="function(e){e.preventDefault();}" class="form-control btn-btn-default pull-right" style="width:10%" value="00.0"/>
                                </td>
                            </tr>
                            <tr>
                                <td>payed</td>
                                <td colspan="4">
                                    <input name="payed" id="tota" type="number" class="form-control btn-btn-default pull-right" value="00.0"/>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- <input type="button" class="btn btn-info" id="add-more" value="+" /> -->
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>


            <!-- </div> -->
            <!-- /.panel-body -->
            <!-- </div> -->
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var next = 0;
            $("#add-more").click(function(e) {

                e.preventDefault();
                var addto = "#products-table0" // + (next);
                var addRemove = "#products-table" + (next);
                next = next + 1;
                var newIn = ' <tr id="products-table' + next + '"><td><button id="remove' + next + '" class="btn btn-danger remove-me">X</button></td><td><select name="iname[]" id="iname' + next + '" onchange="updprice(' + next + ',this.value)" class="form-control"><?php echo $options; ?></select></td><td><input  type="number" value="0" id="iqty' + next + '" onchange="updateprice(' + next + ')"  name="quantity[]" placeholder="Quantity" class="form-control input-md" /></td><td><input type="number"  id="iprice' + next + '"   onchange="updateprice(' + next + ')"  class="form-control input-md" name="price[]" placeholder="Price" /></td><td><p id="sub' + next + '">00.00</p></td></tr>';
                //<tr id="stock-table' + next + '"><td> <select  class="form-control" name="iid[]"><?php echo $options ?></select></td><td> <input  class="form-control" type="number" placeholder="quantity" name="iqty[]"  required> </td><td><button id="remove' + (next) + '" class="btn btn-danger remove-me" >X</button></td></tr>'; //<input type="button" class="btn btn-info" id="add-more'+(next)+'" value="+"></td></tr>';
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
                    var fieldID = "#products-table" + fieldNum;
                    $(fieldID).remove();
                    $(this).remove();
                });
            });

        });
    </script>
    <!-- /.panel .chat-panel -->

    <?php include "footer.php";?>