<?php include "header.php";

if (isset($_POST["rempayment"]) && isset($_GET["id"])) {
    $stmt = $conn->prepare("update invoice set payed=payed+? where id=?");
    $stmt->bind_param("ii", $_POST["rempayment"], $_GET["id"]);
    if ($stmt->execute()) {
        $stmt->close();
        $stmt = $conn->prepare("Select payed,total from invoice where id=?");
        $stmt->bind_param("i", $_GET["id"]);
        $stmt->execute();
        $stmt->bind_result($pyd, $tot);
        $stmt->fetch();
        $stmt->close();        
        if ($tot - $pyd <= 0) {
            $stmt = $conn->prepare("update invoice set status=1 where id=?");
            $stmt->bind_param("i", $_GET["id"]);
            $stmt->execute();
            $stmt->close();
        }
    }
}
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
            font-size: 16px;
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
        @media print{
            #abcdefg{
                background-color:black;
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
$id = $_GET["id"];
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($name, $total, $payed, $phone, $status, $ddate, $sdate);
$stmt->fetch();
$stmt->close();
?>
        <div id="page-wrap">
            <div class="invoice-box">
                <table cellpadding="0" cellspacing="0">
                    <tr class="top">
                        <td colspan="4">
                            <table>
                                <tr>
                                    <td class="title">
                                        <img src="../images/logo.png" style="width:100%; max-width:300px;">
                                    </td>

                                    <td>
                                        Invoice #:
                                        <?php echo $id; ?><br> Created:
                                        <?php echo $sdate; ?><br> Due:
                                        <?php echo $ddate; ?>
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
                                        MA Printer.<br> 12345 Sunny Road
                                        <br> Lahore, PK 54000<br>0323-7404040
                                    </td>

                                    <td>
                                        <?php echo "Name: " . $name; ?><br>
                                        <?php echo "Phone:" . $phone; ?><br>
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
                        <td>
                            Quantity
                        </td>
                        <td>
                            Price
                        </td>
                        <td>
                            Subtotal
                        </td>
                    </tr>
                    <?php

$query = "Select p.name,ip.unitprice,ip.quantity from products p , invoiceproducts ip where ip.invoiceid=? And ip.productid=p.id";
$id = $_GET["id"];
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($pname, $pup, $pqty);
while ($stmt->fetch()) {
    echo " <tr class=\"item\">
                                    <td>$pname</td>
                                    <td>Rs. $pup</td>
                                    <td>$pqty</td>
                                    <td>Rs. " . ($pqty * $pup) . "</td>
                                </tr>";
}
?>
                        <tr class="total">
                            <td></td>
                            <!-- <td></td> -->

                            <td colspan="3">
                                Total:
                                <?php echo "Rs." . $total; ?>
                            </td>
                        </tr>
                        <tr class="total">
                            <td></td>
                            <td colspan="3">
                                <?php

if ($payed > $total) {
    echo "Change: Rs." . ($payed - $total);
} else {
    if ($status == 0) {
        echo "<form method='post' action='./payrem.php?id=" . $_GET["id"] . "'><input type='hidden' value='" . $total . "' name='total'/>Remaining: Rs.<input type='number' name='rempayment' class='input-sm' max='" . ($total - $payed) . "' min='0' value='" . ($total - $payed) . "' required/><input type='submit' value='pay' class='btn btn-warning' ></form>";
    } else if ($status == 1) {
        echo "Remaining: Rs." . ($total - $payed) . " Cleared";
    }

}
?>

                        </td>
                        </tr>
                </table>
                <br/>
                <br/>
                <div class="text-center center-block">Developed by Zain Aftab - fb.com/skynetlabz</div>
            </div>
        </div>
</div>
<a class="btn btn-primary" href="./clearbill.php?id=<?php echo $id;?>">Clear bill</a>
</div>

<?php include "footer.php";?>