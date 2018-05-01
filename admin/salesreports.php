<?php include 'header.php';?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Reports</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Total Sales
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="flot-chart">
                            <div class="flot-chart-content" id="flot-pie-chart"></div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="reportdetails.php" >See details</a>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
             <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        InHouse Sales
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="flot-chart">
                            <div class="flot-chart-content" id="flot-pie-chart1"></div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="reportdetails.php" >See details</a>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Outsource Sales
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="flot-chart">
                            <div class="flot-chart-content" id="flot-pie-chart2"></div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="reportdetails.php" >See details</a>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
                <!-- /.panel -->
            </div>
        <!-- </div> -->
        <!-- /.row -->
    </div>
  
    <!-- /#page-wrapper -->
    <!-- Flot Charts JavaScript -->
    <script src="../vendor/flot/excanvas.min.js"></script>
    <script src="../vendor/flot/jquery.flot.js"></script>
    <script src="../vendor/flot/jquery.flot.pie.js"></script>
    <script src="../vendor/flot/jquery.flot.resize.js"></script>
    <!-- <script src="../vendor/flot/jquery.flot.time.js"></script> -->
    <script src="../vendor/flot-tooltip/jquery.flot.tooltip.min.js"></script>
    <!-- <script src="../data/flot-data.js"></script> -->
    <script>
       

       var data = [{
           label: "Series 0",
           data: 1
       }, {
           label: "Series 1",
           data: 3
       }, {
           label: "Series 2",
           data: 9
       }, {
           label: "Series 3",
           data: 20
       }];
       var data2 = [{
           label: "S0",
           data: 11
       }, {
           label: "S1",
           data: 35
       }, {
           label: "S2",
           data: 12
       }, {
           label: "S3",
           data: 20
       }];
       var data1 = [{
           label: "p1",
           data: 2
       }, {
           label: "p21",
           data: 6
       }, {
           label: "p2",
           data: 9
       }, {
           label: "p3",
           data: 6
       }];
      $.plot('#flot-pie-chart', data2, {
       series: {
           pie: { 
               show: true,
               radius: 1,
               label: {
                   show: true,
                   radius: 3/4,
                   // formatter: labelFormatter,
                   background: { 
                       opacity: 0.5,
                       color: '#000'
                   }
               }
           }
       },
       legend: {
           show: false
       },
           grid: {
               hoverable: true
           },
           tooltip: true,
           tooltipOpts: {
               content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
               shifts: {
                   x: 20,
                   y: 0
               },
               defaultTheme: false
           }
   });  $.plot('#flot-pie-chart2', data1, {
       series: {
           pie: { 
               show: true,
               radius: 1,
               label: {
                   show: true,
                   radius: 3/4,
                   // formatter: labelFormatter,
                   background: { 
                       opacity: 0.5,
                       color: '#000'
                   }
               }
           }
       },
       legend: {
           show: false
       },
           grid: {
               hoverable: true
           },
           tooltip: true,
           tooltipOpts: {
               content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
               shifts: {
                   x: 20,
                   y: 0
               },
               defaultTheme: false
           }
   });$.plot('#flot-pie-chart1', data, {
       series: {
           pie: { 
               show: true,
               radius: 1,
               label: {
                   show: true,
                   radius: 3/4,
                   // formatter: labelFormatter,
                   background: { 
                       opacity: 0.5,
                       color: '#000'
                   }
               }
           }
       },
       legend: {
           show: false
       },
           grid: {
               hoverable: true
           },
           tooltip: true,
           tooltipOpts: {
               content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
               shifts: {
                   x: 20,
                   y: 0
               },
               defaultTheme: false
           }
   });
           </script>
<!-- /#wrapper -->
<?php include 'footer.php'?>