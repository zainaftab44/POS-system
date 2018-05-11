<?php include "header.php"; ?>
	<link rel='stylesheet' type='text/css' href='../css/style.css' />
	<link rel='stylesheet' type='text/css' href='../css/print.css' media="print" />
	<script type='text/javascript' src='../js/example.js'></script>


	<div id="page-wrap">

<!-- <div class="container"> -->
    <!-- <div class="row"> -->
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order # 12345</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
						John Smith<br>
						0321-1234567
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
						<address>
							<strong>Order Date:</strong><br>
							March 7, 2014<br><br>
						</address>
    			</div>
    		</div>
    	</div>
    <!-- </div> -->
  
    <!-- <div class="row"> -->
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-hover table-striped table-bordered table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<tr>
    								<td>BS-200</td>
    								<td class="text-center">$10.99</td>
    								<td class="text-center">1</td>
    								<td class="text-right">$10.99</td>
    							</tr>
                                <tr>
        							<td>BS-400</td>
    								<td class="text-center">$20.00</td>
    								<td class="text-center">3</td>
    								<td class="text-right">$60.00</td>
    							</tr>
                                <tr>
            						<td>BS-1000</td>
    								<td class="text-center">$600.00</td>
    								<td class="text-center">1</td>
    								<td class="text-right">$600.00</td>
								</tr>
    						</tbody>
									<tfoot>
									<tr>
										<td class="no-line"></td>
										<td class="no-line"></td>
										<td class="no-line text-center"><strong>Total</strong></td>
										<td class="no-line text-right">$685.99</td>
									</tr>
	</tfoot>
    					</table>
    				</div>
    			</div>
    		<!-- </div> -->
    	<!-- </div>
    	</div> -->
    </div>
</div>

<button class="btn btn-primary btn-lg">Clear bill</button>
	</div>

	<?php include "footer.php"; ?>
