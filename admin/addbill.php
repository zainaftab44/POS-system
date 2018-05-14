<?php
include "header.php";
// error_reporting(E_ALL);
if (isset($_POST["name"]) && isset($_POST["payed"]) && isset($_POST["total"]) && isset($_POST["phone"]) && isset($_POST["fdate"]) && isset($_POST["tdate"])) {
    $query = "Insert into invoice (payed,total,name,phone,due_date,st_date,status) values (?,?,?,?,?,?,?)";
    $status;
    if ($_POST["total"] == $_POST["payed"]) {
        $status = 1;
    } else {
        $status = 0;
    }
    $stmt = $conn->prepare($query);
    // echo $query;
    //    echo "Insert into invoice (payed,total,name,phone,due_date,st_date) values (". $_POST["payed"].",".$_POST["total"].",".$_POST["name"].",".$_POST["phone"].",".$_POST["tdate"].",".$_POST["fdate"].",".$status.")";
    $stmt->bind_param("iissssi", $_POST["payed"], $_POST["total"], $_POST["name"], $_POST["phone"], $_POST["tdate"], $_POST["fdate"], $status);
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
    ?>
    <form id="myForm" action="billdetails.php" method="post">
    <?php
    echo "<input type=\"hidden\" name=\"id\" value=\"$bid\">";
    ?>
    </form>
    <script type="text/javascript">
        document.getElementById('myForm').submit();
    </script>
    <?php
}

$query = "Select id,name,cost from products";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($id, $name, $price);
$options = "<option value=''>Select Product</option>";
$arr = array();
while ($stmt->fetch()) {
    $options .= "<option value='$id'>$name</option>";
    $arr["$id"] = $price;
}
$stmt->close();

?>
    <script>
        var prices = <?php echo json_encode($arr); ?>;

        function updprice(place, obj) {
            var input = document.getElementById("iprice" + place);
            input.value = prices[obj.value];
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
                <!-- <div class="row">
                    <input type="button" class="btn btn-info" id="add-more" value="+" />
                </div> -->


                <div class="row clearfix">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover" id="tab_logic">
                            <thead>
                                <tr>
                                    <th class="text-center"> </th>
                                    <th class="text-center"> Product </th>
                                    <th class="text-center"> Qty </th>
                                    <th class="text-center"> Price </th>
                                    <th class="text-center"> Total </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id='addr0'>
                                    <!-- <td>1</td>
                                        <td><select class="form-control" id="iname0" name='iname[]' onChange="option_checker(this,0);"><?php echo $options; ?></select></td>
                                        <td><input type="number" id="iqty0" name='quantity[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0" /></td>
                                        <td><input type="number" id="iprice0" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0" /></td>
                                        <td><input type="number" id="sub0" name='sub[]' placeholder='0.00' class="form-control total" readonly/></td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <button id="add-more" type="button" class="btn btn-default pull-left">Add Row</button>
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
                                    <td class="text-center"><input type="number" name='total' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Payed</th>
                                    <td class="text-center"><input type="number" name='payed' id="payed" placeholder='0.00' class="form-control" /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>


            <!-- </div> -->
            <!-- /.panel-body -->
            <!-- </div> -->
        </div>
    </div>
    <script>
        function option_checker(id, place) {
            updprice(place, id);
            var myOption = $(id).val();
            var s = 0;
            //  alert(JSON.stringify($(id)))
            //updprice(id.id.splice(-1), id);
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

        function option_list(id) {
            el = '#' + id;
            // var myArray = ["Product 1", "Product 2", "Product 3", "Product 4"];
            var collect = '<option value="">Select Product</option>';
            collect += "<?php echo $options ?>";
            // for (var i = 0; i < myArray.length; i++) {
            //     collect += '<option value="' + myArray[i] + '">' + myArray[i] + '</option>';
            // }
            $(el + " select").html(collect);
        }

        function calc() {
            $('#tab_logic tbody tr').each(function(i, element) {
                var html = $(this).html();

                var qty = $(this).find('.qty').val();
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
            $('#sub_total').val(total.toFixed(0));
            tax_sum = total / 100 * $('#tax').val();
            $('#tax_amount').val(tax_sum.toFixed(0));
            $('#total_amount').val((total-tax_sum).toFixed(0));
        }
        $(document).ready(function() {

            option_list('addr0');

            // var i = 1;
            // $("#add_row").click(function() {
            //     b = i - 1;
            //    $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);

            //     $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
            //     option_list('addr' + i);
            //     i++;
            // });
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


            var next = 0;
            $("#add-more").click(function(e) {

                e.preventDefault();
                var addto = "#addr0" // + (next);
                var addRemove = "#addr" + (next);
                next = next + 1;
                var newIn = "<tr id='addr" + next + "'>" +
                    "<td><button id='remove " + (next) + "' class='btn btn-danger remove-me' >X</button></td>" +
                    // "<td>" + next + "</td>" +
                    "<td><select class=form-control' id='iname" + next + "' name='iname[]' onChange='option_checker(this," + next + ")'><?php echo $options; ?></select></td>" +
                    "<td><input type='number' id='iqty" + next + "' name='quantity[]' placeholder='Enter Qty' class='form-control qty' step='0' min='0' /></td>" +
                    "<td><input type='number' id='iprice" + next + "' name='price[]' placeholder='Enter Unit Price' class='form-control price' step='0.00' min='0' /></td>" +
                    "<td><input type='number' id='sub" + next + "' name='sub[]' placeholder='0.00' class='form-control total' readonly/></td>" +
                    "</tr>";


                var newInput = $(newIn);
                var add = $("#add-more" + (next - 1))
                var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >X</button>';
                var removeButton = $(removeBtn);
                $(addto).after(newInput);
                var removeButton = $(removeBtn);
                $(addto).after(newInput);
                // $(addRemove).after(removeButton);

                $('.remove-me').click(function(e) {
                    e.preventDefault();
                    var fieldNum = this.id.charAt(this.id.length - 1);
                    var fieldID = "#addr" + fieldNum;
                    $(fieldID).remove();
                    $(this).remove();
                });
            });

        });
    </script>
    <!-- /.panel .chat-panel -->

    <?php include "./footer.php";?>