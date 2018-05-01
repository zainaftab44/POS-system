<?php include "header.php"; ?>
	<link rel='stylesheet' type='text/css' href='../css/style.css' />
	<link rel='stylesheet' type='text/css' href='../css/print.css' media="print" />
	<script type='text/javascript' src='../js/example.js'></script>

	<div id="page-wrap">

		<textarea id="header">INVOICE</textarea>
		
		<div id="identity">
		
            <textarea id="address" disabled>customer name
Phone: (555) 555-5555
Adress: adsogjaosdgo</textarea>

            <div id="logo">

              <!-- <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                |
                <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
              </div> -->

              <div id="logohelp">
                <input id="imageloc"  disabled class="disabled" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
              <img id="image" src="../images/logo.png"  disabled class="disabled" alt="logo" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            <textarea id="customer-title"  disabled class="disabled"> customer name</textarea>

            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea  disabled class="disabled">000123</textarea></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><textarea id="date" disabled class="disabled">December 15, 2017</textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due">875.00</div></td>
                </tr>

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>Item</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		  </tr>
		  
		  <tr class="item-row">
		      <td class="item-name"><div class="delete-wpr"><textarea>flex</textarea></div></td>
		      <td><textarea class="cost">650.00</textarea></td>
		      <td><textarea class="qty">1</textarea></td>
		      <td><span class="price">650.00</span></td>
		  </tr>
		  
		  <tr class="item-row">
		      <td class="item-name"><div class="delete-wpr"><textarea >standies</textarea></div></td>
		      <td><textarea class="cost">75.00</textarea></td>
		      <td><textarea class="qty">3</textarea></td>
		      <td><span class="price">225.00</span></td>
		  </tr>
<!-- 		  
		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr> -->
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal">875.00</div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value"><div id="total">875.00</div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>

		      <td class="total-value"><textarea id="paid">300.00</textarea></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due">875.00</div></td>
		  </tr>
		
		</table>
		
		<!-- <div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div> -->
	
<button class="btn btn-primary btn-lg">Clear bill</button>
	</div>

	<?php include "footer.php"; ?>
