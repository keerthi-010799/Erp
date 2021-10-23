<?php
include('header.php');
include('workers/getters/functions.php');
include('generic_modal.php');


function payment_status($payment_status,$newdate,$po_payterm,$grn_date){
    $curdate=strtotime($newdate);
    $mydate=strtotime('+'.$po_payterm.' day', strtotime($grn_date));

    if($curdate > $mydate)
    {
        return 'Overdue';
    }
}
?>

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left"> Inventory(Sales) Report</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Stock  Report</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card mb-3">
                        <div class="card-header">


                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>&nbsp;Stock  Report </b></h3>
                        </div>
                        <div class="form-group row">
                        <div class="form-group col-sm-3">
                                    <select id="itemwise" class="form-control form-control-sm" name="itemwise">
                                        <option selected value="">--Select Item--</option>
                                        <?php
                                        $sql = mysqli_query($dbcon,"SELECT distinct itemname FROM salesitemaster2");
                                        while ($row = $sql->fetch_assoc()){	
                                            $itemname=$row['itemname'];
                                            echo '<option  value="'.$itemname.'" >'.$itemname.'</option>';

                                        }
                                        ?>
                                    </select>

                                </div>
                        <div class="form-group col-sm-3">
                                    <select id="brandwise" class="form-control form-control-sm" name="brandwise">
                                        <option selected value="">--Select Brand--</option>
                                        <?php
                                        $sql = mysqli_query($dbcon,"SELECT * FROM brandmaster");
                                        while ($row = $sql->fetch_assoc()){	
                                            $brandname=$row['brand'];
                                            echo '<option  value="'.$brandname.'" >'.$brandname.' </option>';

                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="filter_table();">Run Filter</button>
                                </div>
 
                                    </div>

                        <div class="card-body">

                            <!-- Start coding here -->
                            <div class="row">
                                <div class="col-md-12">
                                    <span id="po_reports_div"></span>
                                    <table id="po_reports" class="table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Item Code</th>												
                                                <th>Item Name</th>												
                                                <th>Item Cost</th>
                                                <th>Taxrate</th>												
                                                <th>Sales rate</th>												
                                                <th>Stock On Hand</th>												
                                                <th>Stock Value</th>												
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                                if((isset($_GET['itemwise']) && $_GET['itemwise']!=='')||(isset($_GET['brandwise'])&&$_GET['brandwise']!='')){
                                                    $itemwise = $_GET['itemwise'];
                                                    $brandwise = $_GET['brandwise'];


                                                $sql = "SELECT * from salesitemaster2 s where 1=1";
                                                if(isset($_GET['itemwise'])&&$_GET['itemwise']!=''){

                                                    $sql.=" and s.itemname='".$_GET['itemwise']."'";    
                                                }
                                                if(isset($_GET['brandwise'])&&$_GET['brandwise']!=''){

                                                    $sql.=" and s.brand='".$_GET['brandwise']."'";    
                                                }

                                                }else{
                                        //  $sql = "SELECT * from salesitemaster2";    
                                                
                                            $sql = "SELECT * from salesitemaster2 ORDER BY id DESC;";    
                                                }

                                            $result = mysqli_query($dbcon,$sql);
                                            if ($result->num_rows > 0){
                                                while ($row =$result-> fetch_assoc()){
                                                    echo '<tr>';
                                                    echo '<td>' .$row['itemcode'] . '</td>';
                                                    echo '<td>'.$row['itemname'].' </td>';
                                                    echo '<td>'.($row['sales_priceperqty']-$row['sales_taxamount']).' </td>';
                                                    echo '<td>'.$row['sales_taxrate'].' </td>';
                                                    echo '<td>'.$row['sales_priceperqty'].' </td>';
                                                    echo '<td>'.$row['stockinqty'].' </td>';
                                                    echo '<td>'.$row['stockinqty']*$row['sales_priceperqty'].' </td>';

                                                    echo ' </tr>';  
                                                }
                                            }
                                            ?>


                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div><!-- end card-->

                </div>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
     var page_itemwise = "<?php if(isset($_GET['itemwise'])){ echo $_GET['itemwise']; } ?>";
       var page_brandwise = "<?php if(isset($_GET['brandwise'])){ echo $_GET['brandwise']; } ?>";


    $(document).ready(function() {
        $('#itemwise').val(page_itemwise);
        $('#brandwise').val(page_brandwise);

        //var printhead = 'Stock Inward';
        //var excel_printhead = 'Stock Inward';
        var table = $('#po_reports').DataTable( {
            lengthChange: false,
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
                };
                var grossval = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);

                var grossvalStockQty = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);



                $( api.column( 0 ).footer() ).html('Total');
                $( api.column( 6 ).footer() ).html(grossval);
                $( api.column( 5 ).footer() ).html(grossvalStockQty);

            },
            buttons: [
                {
                    extend: 'print',
                    title: '',
                    text: '<span class="fa fa-print"></span>',
                    footer: true ,
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' )
                            .prepend(
                            '<p><img src="<?php echo $baseurl;?>assets/images/dhirajLogo.png" style="width:50px;height:50px;" /></p><p class="lead text-center"><b>Stock Outward</b><br/></p></div>'
                        );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                }, 
                {
                    extend: 'excel',
                    text:'<span class="fa fa-file-excel-o"></span>',
                    title:'Stock Outward', footer: true,
                    messageTop: ''   

                },
                {
                    extend: 'pdf',
                    text:'<span class="fa fa-file-pdf-o"></span>',
                    title:'Stock Outward', footer: true,
                    messageTop: ''   

                },
                {
                    extend: 'colvis',
                    text:'Show/Hide', footer: true 
                }
            ]
        } );


        table.buttons().container()
            .appendTo( '#po_reports_div');


    });
    function filter_table(){
        var itemwise = $('#itemwise').val();
        var brandwise = $('#brandwise').val();
        location.href="StockOutwardReports.php?itemwise="+itemwise+"&brandwise="+brandwise;
    }

</script>
<?php
include('footer.php');
?>
