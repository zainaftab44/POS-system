<?php 
$print=0;
if(isset($_POST["id"]))
    $print=1;
include "header.php";

?>
<script type='text/javascript' src='../js/example.js'></script>

<div id="abcdefg">
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;l
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        
        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
        
        @media print {
            #abcdefg {
                background-color: black;
            }
        }
        /** RTL **/
        
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }
        
        .rtl table {
            text-align: right;
        }
        
        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
    <?php

$query = "Select name,total,payed,phone,status,due_date,st_date from invoice where id=?";
$id = $_POST["id"];
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($name, $total, $payed, $phone, $status, $ddate, $sdate);
$stmt->fetch();
$sdate = date("d-m-Y", strtotime($sdate));
$ddate = date("d-m-Y", strtotime($ddate));
$stmt->close();
?>
        <div id="page-wrap">
            <!--<button class="btn btn-primary hidden-print pull-right btn-lg" onclick="PrintPanel()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>-->

            <!--<a class="btn btn-primary pull-right btn-lg" href="./clearbill.php?id=<?php echo $id; ?>">Clear bill</a>-->

            <div class="invoice-box">
                <table cellpadding="0" cellspacing="0">
                    <tr class="top">
                        <td colspan="4">
                            <table>
                                <tr>
                                    <td class="title">
                                        <img src="../images/logo.jpg" style="width:100%; max-width:200px;">
                                    </td>

                                    <td>
                                        Invoice #:
                                        <?php echo $id; ?><br> Created:
                                        <?php echo $sdate; ?><br> Due:
                                        <?php echo  $ddate; ?> 
                                        <div id="ccopy" style="display:none"><br><strong>Client Copy</strong><div>
                                        <div id="ocopy"  style="display:none"><br><strong>Office Copy</strong><div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="information">
                        <td colspan="4">
                            <table>
                                <tr>
                                    <td>
                                        MA Printers<br> Near Chowk Daroghawala
                                        <br> Lahore, PK 54000
                                        <br>0323-4747110
                                        <br>0323-7404040
                                    </td>

                                    <td>
                                        Customer Info<br>
                                        <?php echo " Name: " . $name; ?><br>
                                        <?php echo "Phone: " . $phone; ?><br>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="heading">
                        <td colspan="2">
                            Payment Method
                        </td>

                        <td colspan="2">
                            Payed
                        </td>
                    </tr>

                    <tr class="details">
                        <td colspan="2">
                            Cash
                        </td>

                        <td colspan="2">
                            <?php echo "Rs." . $payed; ?>
                        </td>
                    </tr>

                    <tr class="heading">
                        <td>
                            Product
                        </td>
                        <td style='text-align:right'>
                            Unit Price
                        </td>
                        <td style='text-align:right'>
                            Quantity
                        </td>
                        <td style='text-align:right'>
                            Subtotal
                        </td>
                    </tr>
                    <?php

$query = "Select p.name,ip.unitprice,ip.quantity from products p , invoiceproducts ip where ip.invoiceid=? And ip.productid=p.id";
$id = $_POST["id"];
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($pname, $pup, $pqty);
while ($stmt->fetch()) {
    echo " <tr class=\"item\">
                                    <td>$pname</td>
                                    <td style='text-align:right'>Rs. $pup</td>
                                    <td style='text-align:right'>$pqty</td>
                                    <td style='text-align:right'>Rs. " . ($pqty * $pup) . "</td>
                                </tr>";
}
?>
                        <tr class="total">
                            <td  colspan="3"></td>

                            <td>
                                Total:
                                <?php echo "Rs." . $total; ?>
                            </td>
                        </tr>
                        <tr class="total">
                            <td  colspan="3"></td>

                            <td>
                                <?php
if ($payed >= $total) {
    echo "Change: Rs." . ($payed - $total);
} else {
    echo "Remaining: Rs." . ($total - $payed).'<br>';
    
    echo "Percentage Paid: " . (($payed/$total)*100). "%";
}
?>
                            </td>
                        </tr>
                </table>
                <br/>
                <br/>
                <div class="text-center center-block">System Developed by Skynetlabz for MAprinters.net</div>
            </div>
        </div>
</div>
<style>
    #bg-text {
        color: lightgrey;
        font-size: 120px;
        transform: rotate(300deg);
        -webkit-transform: rotate(300deg);
    }
    
    #background {
        position: absolute;
        z-index: 0;
        background: transparent;
        display: block;
        min-height: 50%;
        min-width: 70%;
        color: yellow;
        left: 30%
    }
</style>
<script>
    function myFunction() {
        window.print();
    }

    function PrintPanel() {
        var panel = document.getElementById("abcdefg");
        var printWindow = window.open('', '', 'height=auto,width=auto,scrollbars=1');

        printWindow.document.write('<html><head><title></title></head>');
        printWindow.document.write('<body>');
        var pHeight = panel.clientHeight;
        var windowHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
        var noOfWatermark = pHeight / windowHeight;
        printWindow.document.write('<style>#bg-text{color:#8c292966;font-size:120px;transform:rotate(300deg);-webkit-transform:rotate(300deg)}#background{position:absolute;z-index:0;background:transparent;display:block;min-height:50%;min-width:70%;color:#8c292966;left:20%;top:20%} @media print{#bg-text{color:#8c292966;font-size:120px;transform:rotate(300deg);-webkit-transform:rotate(300deg)}#background{position:absolute;z-index:0;background:transparent;display:block;min-height:50%;min-width:70%;color:#8c292966;left:20%;top:20%}}</style>')
        <?php if ($status == 1) {?>
        printWindow.document.write('<div id="background"><p id="bg-text">Paid</p></div>');
        <?php } else {?>
        printWindow.document.write('<div id="background"><p id="bg-text">Remaining</p></div>');
        <?php }?>
        printWindow.document.write(panel.innerHTML);
        // window.setTimeout("javascript:setPortrait();", 500);
        printWindow.document.write('<script></script></body></html>');
        printWindow.document.close();


        setTimeout(function() {
            printWindow.print();
        }, 500);
        callback();
    }
    
</script>
</div>

<?php include "footer.php";?>