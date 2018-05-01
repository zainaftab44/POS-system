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
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-bell fa-fw"></i> Add Product</div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form class="form-horizontal">
                                    <fieldset>
<input type="text" placeholder="Enter product name" name="pname"/>
<input type="number" placeholder="Enter Unit price" name="pprice"/>
<input type="text" placeholder="quantity" name="pqty"/>
<input type="button" id="add-more" value="+">
<table  class="table table-striped">
<th><td>item</td><td>quantity</td></th>
<tr id="stock_table">
<td> <select name="iname[]"> <option>a</option><option>b</option><option>c</option></select></td>
<td> <input type="number" placeholder="quantity" name="iqty[]"> </td>
</tr>
</table>
                                    </fieldset>
                                </form>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                      
                        <!-- /.panel .chat-panel -->
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
                var newIn = '<tr id="'+next+'"><td> <select name="iname[]"> <option></option></select></td><td> <select name="iqty[]"> <option></option></select></td></tr>';
                var newInput = $(newIn);
                $(addto).after(newInput);
            });

        });
        </script>
        <!-- /#wrapper -->
        <?php include 'footer.php' ?>
