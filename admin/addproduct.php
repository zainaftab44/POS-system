<?php include 'header.php' ; ?>

   
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
                                <form class="form">
                                    <fieldset>
<input type="text" class="form-control-plaintext" placeholder="Enter product name" name="pname"/>
<input type="number" class="form-control-plaintext" placeholder="Enter Unit price" name="pprice"/>
<input type="text" class="form-control-plaintext" placeholder="quantity" name="pqty"/>
<table  class="table table-striped">
<th><td>item</td><td>quantity</td></th>
<tr id="stock_table">
<td colspan='2'> <select  class="form-control" name="iname[]"> <option>a</option><option>b</option><option>c</option></select></td>
<td> <input  class="form-control" type="number" placeholder="quantity" name="iqty[]"> </td>
</tr>
</table>
<input type="button" class="btn btn-info" id="add-more" value="Add stock">
<input type="button" class="btn btn-success" id="save-product" value="Save Product">
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
                var newIn = '<tr id="'+next+'"><td colspan="2"> <select  class="form-control" name="iname[]"> <option>a</option><option>b</option><option>c</option></select></td><td> <input  class="form-control" type="number" placeholder="quantity" name="iqty[]"> </td></tr>';
                var newInput = $(newIn);
                $(addto).after(newInput);
            });

        });
        </script>
        <!-- /#wrapper -->
        <?php include 'footer.php' ?>
