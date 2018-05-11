<?php
include "header.php";
// error_reporting(E_ALL);
if (isset($_POST["name"]) && isset($_POST["payed"]) && isset($_POST["total"]) && isset($_POST["phone"]) && isset($_POST["fdate"]) && isset($_POST["tdate"])) {
    $query = "Insert into invoice (payed,total,name,phone,due_date,st_date) values (?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iissss", $_POST["payed"], $_POST["total"], $_POST["name"], $_POST["phone"], $_POST["tdate"], $_POST["fdate"]);
    echo mysqli_error($conn);

    $stmt->execute();
    $bid = $conn->insert_id;
    $stmt->close();

    if (isset($_POST["iname"])) {
        for ($i = 0; $i < sizeof($_POST["iname"]); $i++) {
            $stmt = $conn->prepare("Insert into invoiceproducts (invoiceid,productid,quantity,unitprice) values(?,?,?,?)");
            $stmt->bind_param("iiii", $bid, $_POST["iname"][$i], $_POST["quantity"][$i], $_POST["price"][$i]);
            $stmt->execute();
            $stmt->close();
            $stmt = $conn->prepare("Update items i,product_items pi set i.quantity=i.quantity-?  where i.id=pi.iid And pi.pid=?");
            $stmt->bind_param("ii", $_POST["quantity"][$i], $_POST["iname"][$i]);
            $stmt->execute();
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
            var total = 0;
            for (var i = 0; i < eles.length; i++) {
                var sub = document.getElementById("sub" + eles[i].id.slice(-1));
                total += parseInt(sub.innerHTML)
            }
            var tot = document.getElementById("tota");
            tot.value = total;

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


                <div class="container">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover" id="tab_logic">
                                <thead>
                                    <tr>
                                        <th class="text-center"> # </th>
                                        <th class="text-center"> Product </th>
                                        <th class="text-center"> Qty </th>
                                        <th class="text-center"> Price </th>
                                        <th class="text-center"> Total </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id='addr0'>
                                        <td>1</td>
                                        <td><select class="form-control" name='iname[]' onChange="option_checker(this);"><?php echo $options; ?></select></td>
                                        <td><input type="number" name='quantity[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0" /></td>
                                        <td><input type="number" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0" /></td>
                                        <td><input type="number" name='sub[]' placeholder='0.00' class="form-control total" readonly/></td>
                                    </tr>
                                    <tr id='addr1'></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <button id="add_row" type="button" class="btn btn-default pull-left">Add Row</button>
                            <button id='delete_row' type="button" class="pull-right btn btn-default">Delete Row</button>
                        </div>
                    </div>
                    <div class="row clearfix" style="margin-top:20px">
                        <div class="pull-right col-md-4">
                            <table class="table table-bordered table-hover" id="tab_logic_total">
                                <tbody>
                                    <tr>
                                        <th class="text-center">Sub Total</th>
                                        <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Discount</th>
                                        <td class="text-center">
                                            <div class="input-group mb-2 mb-sm-0">
                                                <input type="number" class="form-control" id="tax" placeholder="0">
                                                <div class="input-group-addon">%</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Discount Amount</th>
                                        <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly/></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Grand Total</th>
                                        <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php /*?>
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
                                <input name="total" id="tota" type="number" onchange="function(e){e.preventDefault();}" class="form-control btn-btn-default pull-right" style="width:10%" value="00.0" />
                            </td>
                        </tr>
                        <tr>
                            <td>payed</td>
                            <td colspan="4">
                                <input name="payed" id="tota" type="number" class="form-control btn-btn-default pull-right" value="00.0" />
                            </td>
                        </tr>
                    </tfoot>
                </table>
                */?>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>


            <!-- </div> -->
            <!-- /.panel-body -->
            <!-- </div> -->
        </div>
    </div>
    <script>
        function option_checker(id) {
            var myOption = $(id).val();
            var s = 0;
            $('#tab_logic tbody tr select').each(function(index, element) {
                var myselect = $(this).val();
                if (myselect == myOption) {
                    s += 1;
                }
            });
            if (s > 1) {
                alert(myOption + ' as been added already try new..')
            }
        }

        function calc() {
            $('#tab_logic tbody tr').each(function(i, element) {
                var html = $(this).html();

                var qty = $(this).find('.quantity').val();
                var price = $(this).find('.price').val();
                $(this).find('.total').val(qty * price);

                calc_total();
            });
        }

        function calc_total() {
            total = 0;
            $('.total').each(function() {
                total += parseInt($(this).val());
            });
            $('#sub_total').val(total.toFixed(2));
            tax_sum = total / 100 * $('#tax').val();
            $('#tax_amount').val(tax_sum.toFixed(2));
            $('#total_amount').val((tax_sum + total).toFixed(2));
        }
        $(document).ready(function() {

            option_list('addr0');

            var i = 1;
            $("#add_row").click(function() {
                b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                option_list('addr' + i);
                i++;
            });
            $("#delete_row").click(function() {
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }
                calc();
            });

            $(".product").on('change', function() {
                option_checker(this)
            });


            $('#tab_logic tbody').on('keyup change', function() {
                calc();
            });
            $('#tax').on('keyup change', function() {
                calc_total();
            });


            /*  var next = 0;
            $("#add-more").click(function(e) {

                e.preventDefault();
                var addto = "#products-table0" // + (next);
                var addRemove = "#products-table" + (next);
                next = next + 1;
                // var newIn = ' <tr id="products-table' + next + '"><td><button id="remove' + next\ +
                //     '" class="btn btn-danger remove-me">X</button></td><td><select name="iname[]" id="iname' + next +
                //     '" onchange="updprice(' + next + ',this.value)" class="form-control"><?php echo $options; ?></select></td><td><input  type="number" value="0" id="iqty' + next +
                //     '" onchange="updateprice(' + next + ')"  name="quantity[]" placeholder="Quantity" class="form-control input-md" /></td><td><input type="number"  id="iprice' + next +
                //     '"   onchange="updateprice(' + next + ')"  class="form-control input-md" name="price[]" placeholder="Price" /></td><td><p id="sub' + next + '">00.00</p></td></tr>';
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
            });*/

        });
    </script>
    <!-- /.panel .chat-panel -->

    <?php include "footer.php";?>