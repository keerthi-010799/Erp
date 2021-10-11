<?php
include("../database/db_conection.php");//make connection here
include("../workers/getters/functions.php");//make connection here

if(isset($_POST['cust_payment_id']))
{
    $cust_payment_id = $_POST['cust_payment_id'];
    $cust_type = $_POST['type'];
}
//and i.inv_comp_code=cr.custid
if($cust_type == "auto"){
    $sql = "SELECT i.*,c.*,cr.* from  invoices i , customer_payments c , customerprofile cr where c.cust_payment_id='$cust_payment_id' and i.inv_code=c.cust_payment_invoice_no  ;";

}else{
    $sql = "SELECT i.*,c.*,cr.* from  invoicesacc i , customer_paymentsacc c , customerprofile cr where c.cust_payment_id='$cust_payment_id' and i.inv_code=c.cust_payment_invoice_no  ;";
}
//echo $sql;
$result = mysqli_query($dbcon,$sql);
$row =$result-> fetch_assoc();
$inv_comp_code = $row['inv_comp_code'];

$grn_po_items_arr = json_decode($row['inv_items'],false);
$po_items_arr = json_decode($row['inv_items'],false);
$sql1 = "SELECT * from comprofile where orgid='$inv_comp_code' limit 1 ";
$result1 = mysqli_query($dbcon,$sql1);
$row1 =$result1-> fetch_assoc();
function get_itemDetails($dbcon,$code){
    $sql = "SELECT * from salesitemaster2 where id='$code' ";
    $result = mysqli_query($dbcon,$sql);
    $row =$result-> fetch_assoc();

    $ret = "[".$row['itemcode']."]  ".$row['itemname']."&nbsp;|&nbsp; HSN : ".$row['hsncode']."&nbsp;|&nbsp; ";
    $ret.=  "GST@".($row['sales_taxrate']/1)."%";
    return $ret;
}


?> 

<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <style type="text/css">
            .p_table{
                border:1px soid #000;
            }
        </style>
    </head>
    <body>
        
           
        
        <h5 > <div style="text-align:center">DHIRAJ AGRO PRIVATE LIMITED <br>
		(A Franchisee of Parle Agro Pvt Ltd)</div> </h5>
        <h3><div style="text-align:center">CUSTOMER PAYMENTS RECEIVED VOUCHER</div></h3> 

        <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
            <tbody>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">
                        <b>Customer Name & Address</b><br/>

                        <?php echo $row['custname']; ?>,<br/>
                        <?php echo $row['address']; ?>,<br/>
                        <?php echo $row['city']; ?>,- <?php echo $row['zip']; ?>&nbsp;<?php echo $row['country']; ?>,<?php echo $row['state']; ?><br/>
                        <b>Mob#:</b>&nbsp;<?php echo $row['mobile']; ?><br/>
                        <b>GSTIN</b> - <?php echo $row['gstin']; ?>
                    </td>
                    <td style="border:1px solid #000;padding:0px;">
                        <table width="100%">
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;"><b>Payment#:</b>&nbsp; <?php echo $cust_payment_id; ?></td> 
                            </tr> 
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">
                                   <b> Payment Dt.</b>&nbsp; <?php echo $row['cust_payment_date']; ?>
                                </td> 
                            </tr>   
                            
                            <tr>
                            <td style="border-bottom:1px solid #000;padding:5px;">
                                   <b>Received By</b>&nbsp; <?php echo $row['cust_payment_user']; ?>
                                </td> 
                            </tr>  
                            <tr>  
                            <td style="border-bottom:1px solid #000;padding:5px;">
                            <b>Payment Term: </b><?php echo $row['inv_payterm']>1?$row['inv_payterm'].' Day(s)':"Advance"; ?>
                                </td> 
                            </tr>    
                            <td style="padding:5px;">
                            <b>Due Date: </b><?php echo $row['inv_payterm']>1? Date('d/m/Y', strtotime("+".$row['inv_payterm']." days")) : date("d/m/Y")  ?>
                                </td> 
                            </tr>    

                        </table>

                    </td>
                </tr>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">

                    </td>
                    <td style="border:1px solid #000;padding:10px;">
                        <table style="">
                            <tbody>
                                <tr>
                                    <td width="40%">
                                        <b>Invoice No</b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['cust_payment_invoice_no'];?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <b>Payment Date</b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['cust_payment_date'];?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <b>Payment Mode </b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['cust_payment_mode'];?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <b>Reference No </b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['cust_payment_ref_no'];?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <b>Payment Made </b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['cust_payment_amount'];?></b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <table width="100%" style="">
                    <thead style="border:1px solid #000;text-align:center;">
                        <th style=" width:10%;padding:10px;border:1px solid #000;">Item No.</th>
                        <th style="width:50%;padding:10px;border:1px solid #000;">Item Details</th>
                        <th style="width:15%;padding:10px;border:1px solid #000;">Qty - Uom</th>
                        <th style="width:10%;padding:10px;border:1px solid #000;">Rate</th>
                        <th style="width:15%;padding:10px;border:1px solid #000;">Amount</th>
                    </thead>
                    <tbody>
                        <?php
                        for($i=0;$i<count($grn_po_items_arr);$i++){
                        ?>
                        <tr style="border-right:1px solid #000;border-left:1px solid #000;">
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo $i+1;?>
                            </td>     
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo get_itemDetails($dbcon,$grn_po_items_arr[$i]->itemcode);?>
                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo $grn_po_items_arr[$i]->rwqty." ".$po_items_arr[$i]->uom ;?>

                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo nf($grn_po_items_arr[$i]->rwprice);?>

                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo nf($grn_po_items_arr[$i]->rwamt);?>

                            </td>
                        </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;">
                    <tbody>
                        <tr>
                            <td width="60%" style="border:1px solid #000;padding:10px;">

                            </td>
                            <td style="border:1px solid #000;width:60%;">
                                <table width="100%" >
                                    <tbody>
                                        <tr>
                                            <td width="61%" style="text-align:center;border-bottom:1px solid #000;padding:10px;">
                                                <b>Total</b>
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php 
                                                echo $cust_type == "auto" ? nf(get_total_notax($grn_po_items_arr)) : ' - ';
                                                ?>
                                            </td>
                                        </tr>
                                        <?php 
                                        echo $cust_type == "auto" ? get_taxtype($grn_po_items_arr) : '';?>

                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                    <tbody>
                        <tr>
                            <td width="60%" style="border:1px solid #000;padding:10px;">

                            </td>
                            <td style="border:1px solid #000;padding:0px;">
                                <table width="100%" style="padding:0px;" >
                                    <tbody>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:0px;">
                                                <b>Sub Total</b>
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo $cust_type == "auto" ? get_total($grn_po_items_arr) : get_grandAmttotal($grn_po_items_arr) ; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:10px;">
                                                Discount
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo $po_items_arr[0]->podiscount;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:10px;">
                                                Adjustment
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo $po_items_arr[0]->poadjustmentval;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:0px;">
                                                Grand Total
                                            </td>
                                            <?php
                                            $po_discount = $po_items_arr[0]->podiscount==""?0:$po_items_arr[0]->podiscount;

                                            $poadjustmentval = $po_items_arr[0]->poadjustmentval==""?0:$po_items_arr[0]->poadjustmentval;
                                            ?>

                                            <td style="text-align:center;border-bottom:1px solid #000;padding:10px;"> 
                                                <?php echo (($cust_type == "auto" ? get_total($grn_po_items_arr)-($po_discount)+($poadjustmentval) : get_grandAmttotal($grn_po_items_arr))-$po_discount)+$poadjustmentval;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;padding:10px;">
                                               <b> Balance Due</b>
                                            </td>
                                            <td style="text-align:center;padding:10px;"> 
                                                <?php echo $row['inv_balance_amt']; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                    <tbody>
                        <tr>

                        </tr>
                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                    <tbody>
                        <tr>
                            <td width="70%" style="padding:10px;">


                            </td> 
                            <td width="200" style="padding:20px;">
                               <b>For Dhiraj Agro Pvt. Ltd <!--<?php echo $row1['orgname']; ?>--></b><br/><br><br>
                                &nbsp;&nbsp;<b>Authorized Signatory</b>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </tbody>
        </table>
    </body></html>