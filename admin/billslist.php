<?php include 'header.php';?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Orders List</h1>
            <form method="post" action="./billslist.php">
                <select name="type" required>
                    <option value="">Select Source</option>
                    <option value="0">Outsource</option>
                    <option value="1">Inhouse</option>
                </select>
                <button type="submit" class="btn btn-primary">Show</button>
            </form>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel-heading -->
            <!-- <div class="panel-body"> -->
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Payed</th>
                        <th>Remaining</th>
                        <th>Payable Date</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
$rem;
if (isset($_POST["type"])) {
    $query = "Select Distinct(i.id),i.name,i.total,i.payed,i.st_date,i.status from invoice i, invoiceproducts ip, products p where ip.invoiceid=i.id and ip.productid=p.id and p.type=? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_POST["type"]);
    $stmt->execute();
    $stmt->bind_result($id, $name, $tot, $payd, $tdate, $status);
    while ($stmt->fetch()) {
        $s = "";
        $d = "";
        $rem = ($tot - $payd);
        if ($status == 0) {
            $s = "<a class='btn btn-primary' href='payrem.php?id=$id'>Pay Remaining</a>";
            $d = "<a class='btn btn-primary' href='clearbill.php?id=$id'>Clear Bill</a>";
        } else {
            if ($rem <= 0) {
                $s = "Fully Paid";
            } else {
                $s = "Partial payment";
            }

            $d = '<form id="myForm" action="billdetails.php" method="post">'.
            "<input type=\"hidden\" name=\"id\" value=\"$id\">".
            '<button type="submit" class="btn btn-primary">Details</button>
            </form>'."<p class='alert alert-success'> Cleared</p>";
        }
        echo "<tr>
        <td>$id</td>
        <td>$name</td>
        <td>$tot</td>
        <td>$payd</td>
        <td>$rem</td>
        <td>$tdate</td>
        <td>$s</td>
        <td>$d</td></tr>";
    }
} else {
    $query = "Select  Distinct(id),name,total,payed,st_date,status from invoice ";
    if (isset($_GET["deliveries"])) {
        $query .= " where due_date= '" . date('Y-m-d') . "'";
    } else if (isset($_GET["status"])) {
        $query .= " where status = 0 ";
    }
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->bind_result($id, $name, $tot, $payd, $tdate, $status);
    while ($stmt->fetch()) {
        $s = "";
        $d = "";
        $rem = ($tot - $payd);
        if ($status == 0) {
            $s = "<a class='btn btn-primary' href='payrem.php?id=$id'>Pay Remaining</a>";
            $d = "<a class='btn btn-primary' href='clearbill.php?id=$id'>Clear Bill</a>";
        } else {
            if ($rem <= 0) {
                $s = "Fully Paid";
            } else {
                $s = "Partial payment";
            }
            $d = '<form id="myForm" action="billdetails.php" method="post">'.
            "<input type=\"hidden\" name=\"id\" value=\"$id\">".
            '<button type="submit" class="btn btn-primary">Details</button>
            </form>'."<p class='alert alert-success'> Cleared</p>";
        }
        echo "<tr>
        <td>$id</td>
        <td>$name</td>
        <td>$tot</td>
        <td>$payd</td>
        <td>$rem</td>
        <td>$tdate</td>
        <td>$s</td>
        <td>$d</td></tr>";
    }
}
?>
            </table>
            <!-- </div> -->
            <!-- /.panel-body -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>


<!-- /#wrapper -->
<?php include 'footer.php'?>