<?php include "header.php";?>

            <div id="page-wrapper">
            <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add Order</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                                  <!--                                <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
                                                                <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
                                                                <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
                                <!------ Include the above in your HEAD tag ---------->
                                <form class="form-horizontal">
                                    <fieldset>
                                        <div class="row">
                                            <div class=" col-md-7 form-group pull-left">
                                                <label class="col-md-4 control-label " for="name">Name</label>
                                                <div class="col-md-6">
                                                    <input id="name" name="name" type="text" placeholder="Customer Name" class="form-control input-md" required="">
                                                </div>
                                                <br>
                                                <label class="col-md-4 control-label" for="name">Contact no.</label>
                                                <div class="col-md-6">
                                                    <input id="name" name="name" type="tel" placeholder="Customer Number" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-5 form-group pull-right">
                                                <label class="col-md-4 control-label " for="name">From Date</label>
                                                <div class="col-md-6">
                                                    <input id="name" name="name" type="date" placeholder="Customer Name" class="form-control input-md" required="">
                                                </div>
                                                <label class="col-md-4 control-label" for="name">To date</label>
                                                <div class="col-md-6">
                                                    <input id="name" name="name" type="date" placeholder="Customer Number" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row "> <button type="button"> Add Items</button></div>
                                        <table class="table table-bordered table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Type
                                                    </th>
                                                    <th>
                                                        Quantity
                                                    </th>
                                                    <th>
                                                        Unit Price
                                                    </th>
                                                    <th>
                                                        Total
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select class="form-control">
                                                            <option>Flex</option>
                                                            <option>Card</option>
                                                            <option>Standy</option>
                                                            <option>Brochure</option>
                                                            <option>other</option>
                                                        </select>

                                                    </td>
                                                    <td>
                                                        <input type="number" name="quantity" placeholder="Quantity" class="form-control input-md"/>
                                                    </td>

                                                    <td>
                                                        <input type="number"  class="form-control input-md" name="price" placeholder="Price"/>
                                                    </td>

                                                    <td>
                                                        <p>00.00</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select class="form-control">
                                                            <option>Flex</option>
                                                            <option>Card</option>
                                                            <option>Standy</option>
                                                            <option>Brochure</option>
                                                            <option>other</option>
                                                        </select>

                                                    </td>
                                                    <td>
                                                        <input type="number" name="quantity" placeholder="Quantity" class="form-control input-md"/>
                                                    </td>

                                                    <td>
                                                        <input type="number"  class="form-control input-md" name="price" placeholder="Price"/>
                                                    </td>

                                                    <td>
                                                        <p>00.00</p>
                                                    </td>
                                                </tr>  <tr>
                                                    <td>
                                                        <select class="form-control">
                                                            <option>Flex</option>
                                                            <option>Card</option>
                                                            <option>Standy</option>
                                                            <option>Brochure</option>
                                                            <option>other</option>
                                                        </select>

                                                    </td>
                                                    <td>
                                                        <input type="number" name="quantity" placeholder="Quantity" class="form-control input-md"/>
                                                    </td>

                                                    <td>
                                                        <input type="number"  class="form-control input-md" name="price" placeholder="Price"/>
                                                    </td>

                                                    <td>
                                                        <p>00.00</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4" ><p class="pull-right">0.00</p></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </fieldset>
                                </form>


                            <!-- </div> -->
                            <!-- /.panel-body -->
                            <!-- </div> -->
                            </div>
                        </div>

                        <!-- /.panel .chat-panel -->

                <?php include "footer.php";?>