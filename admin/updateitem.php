<?php include 'header.php' ; ?>

   
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Stock item</h1>
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
<input type="text" placeholder="Enter item name" name="iname"/>
<input type="number" placeholder="Enter Unit price" name="iprice"/>
<input type="text" placeholder="quantity" name="iqty"/>
<button type="submit">Save</button>
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

        <!-- /#wrapper -->
        <?php include 'footer.php' ?>
