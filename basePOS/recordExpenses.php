<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit'])){	
	$expdate=$_POST['expdate'];//same
    $expacctname=$_POST['expacctname'];//same
	$payee=$_POST['payee'];//same
	$payeetype=$_POST['payeetype'];//same
	$paymentype=$_POST['paymentype'];//same
	$notes=$_POST['notes'];//same
	//$image=$_POST['image'];//same
	$createdby = $_POST['createdby'];
	$amount = $_POST['amount'];//same
			

//$image =base64_encode($image);	
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
		
	} else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
	
	$voucherid ="";
	$prefix = "VOU#-";
	
	//Generating VoucherIDS
	$sql="SELECT MAX(id) as latest_id FROM recordexpense ORDER BY id DESC";
	if($result = mysqli_query($dbcon,$sql)){
		$row   = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$maxid = $row['latest_id'];
			$maxid+=1;			
			$voucherid = $prefix.$maxid;
		}else{
			$maxid = 0;
			$maxid+=1;
			$voucherid = $prefix.$maxid;
		}
	}

	$sql="INSERT INTO recordexpense(`voucherid`, 	
									`date`, 	
									`accountname`, 	
									`payee`, 	
									`payeetype`, 	
									`paymentype`,
									`amount`,														
									`notes`, 	
									`image`,
									`createdby`)
							VALUES ('$voucherid',
									'$expdate',
									'$expacctname',
									'$payee',
									'$payeetype',
									'$paymentype',
									'$amount',
									'$notes',
									'$target_file',
									'$createdby')";													    
					
	//echo "$insert_recordexpense";
	// Inserting Log details into ExpenseNoteslog
	$sql1= "INSERT into expensenoteslog(`voucherid`,
										`notes`,
										`createdby`,
										`createdon`)
								  VALUES('$voucherid',
								         '$notes',
										 '$createdby',
										 '$expdate')";
										
	if(mysqli_query($dbcon,$sql)&& mysqli_query($dbcon,$sql1))
	{
		echo "<script>alert('Expense Master creation Successful ')</script>";
		header("location:listExpenses.php");
    } else {
		die('Error: ' . mysqli_error($dbcon));
		exit;
		echo "<script>alert('Transport Master creation  unsuccessful ')</script>";
	}
	
}
?>
<?php include('header.php');?>
<div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
				<div class="row">
					<div class="col-xl-12">
							<div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">Expense Entry Screen</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Expense Entry Screen</li>
                                    </ol>
                                    <div class="clearfix"></div>
                            </div>
					</div>
			</div>
            <!-- end row -->


            <div class="row">					
					<div class="col-xs-12 col-sm-12 col-md-120 col-lg-12 col-xl-12">						
						<div class="card mb-3">
							<div class="card-header">
								<!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
								 <h3>
								 Record Expense</h3>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action=""  enctype="multipart/form-data" method="post" accept-charset="utf-8">
								
								
								
								<div class="form-row">
									<div class="form-group col-md-6">
									   <label for="datepicker1">Date</label><span class="text-danger">*</span>
									  <!--input type="date" class="form-control" name="date" value="<?php echo date("d/m/Y") ?>"/-->
									  <input type="date" class="form-control form-control-sm"  name="expdate" value="<?php echo date("Y-m-d");?>">									
									</div>
									</div>
									
									<!--<div class="form-row">										
										 <div class="form-group col-md-6">
									  <label for="inputState">Expense Account</label>
									
										<select name="expaccount" class="form-control expaccount" onchange="rowitem.set_itemrow(this,'purchase');" id="item_select">
                                                <option value="" name="expaccount" selected>--Select Expense Account--</option>
                                                <?php $qr  = "SELECT id,accountname FROM expenseacctmaster ";
                                                $exc = mysqli_query($dbcon,$qr)or die();
                                                while($r = mysqli_fetch_array($exc)){ ?>
                                                <option value="<?php echo $r['id']; ?>"><?php echo  $r['accountname']; ?></option>
                                                <?php
                                                                                    }
                                                ?>
                                            </select>
											</div>
									 
									</div>-->
									
									 
									
								<!--	 <div class="form-row">
									<div class="form-group col-md-2">
									 Tax<label ></label><span class="text-danger">%</span>
									  <input type="text" class="form-control form-control-sm" name="taxrate" placeholder="Ex 18,6,12,28" autocomplete="off" required>
									</div>
										 <div class="form-group col-md-2">
									 Tax amount<label ></label><span class="text-danger"></span>
									  <input type="text" class="form-control form-control-sm" name="taxamount" placeholder="Enter Tax Amt" autocomplete="off" required>
									</div>
										 <div class="form-group col-md-2">
									 Enter Amount<label ></label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="amount" placeholder="Enter Total Amt" autocomplete="off" required>
									</div>
									</div>-->
									
									
									<div class="form-row">
									<div class="form-group col-md-6">
									  <label >Paid Through</label>
									 <select required id="paymentype" data-parsley-trigger="change"  class="form-control form-control-sm"  name="paymentype" >
										<option value="">--Select Paid Through--</option>
										<option value="Cash">Petty Cash</option>
										<option value="Cheque">Prepaid Expenses</option>
										<option value="Neft">Construction Loans</option>
										<option value="Neft">Undeposited Funds</option>
										 <option value="Cheque">Employee Advance</option>
										 <option value="Cheque">Mortgages</option>
										  <option value="Cheque">Others</option>
									</select>
									</div>
									</div>	
									 
								 
									
									<div class="form-row">
									<div class="form-group col-md-6">
									 <label >Payee type</label><span class="text-danger">*</span>
									 <select required id="payeetype" data-parsley-trigger="change"  class="form-control form-control-sm"  name="payeetype" >
										<option value="">Choose Type</option>
										<option value="Vendor">Vendor</option>
										<option value="Customer">Customer</option>
										<option value="Employee">Employee</option>
										<option value="Others">Others</option>									
									</select>
									</div>
									</div>
										
									<div class="form-row">
									<div class="form-group col-md-6">
									 <label >Payee</label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="payee" placeholder="Enter Name of Supplier/Employee/Customer/Others" autocomplete="off" required>
									</div>
									</div>
																	
											


								    <div class="form-row">
									<div class="form-group col-md-6">
									<label > Invoice#</label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="invoiceno" placeholder="Bill nos,..." autocomplete="off" required>
									</div>
									</div>									
									
									
									
									<div class="form-row">
									  <div class="form-group col-md-6">
									  <label for="inputState">Created By</label>
									  <?php 
														//session_start();
														include("database/db_conection.php");
														$userid = $_SESSION['userid'];
														$sq = "select username from userprofile where id='$userid'";
														$result = mysqli_query($dbcon, $sq) or die(mysqli_error($dbcon));
														//$count = mysqli_num_rows($result);
														$rs = mysqli_fetch_assoc($result);
													?>
									   <input type="text" class="form-control form-control-sm" name="createdby" readonly class="form-control form-control-sm" value="<?php echo $rs['username']; ?>" />
									
									 </div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-6">
                                        <textarea rows="3" class="form-control" name="exp_notes"  id="exp_notes" required placeholder="Add Expense  Notes"></textarea>
                                    </div>
									</div>
									
									
									<div class="form-row">
                                    <div class="col-md-12 float-right text-right">		
                                        <div class="btn-group" role="group">
                                            <!--a id="btnGroupDrop1" role="button" href="#" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"-->
                                            <a id="btnGroupDrop1" role="button" href="#" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Choose Tax Method
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item" id="inclusive" >Inclusive of Tax</a>
                                                <a class="dropdown-item" id="exclusive" >Exclusive of Tax</a>
												<a class="dropdown-item" id="outofscopeoftax" >Out of Scope of Tax</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
				
									 
<!--link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" /-->
<table  class="table table-hover small-text" id="tb">
<tr class="tr-header">
<th width="30%">Category</th>
<th width="25%">Description</th>
<th width="10%">Qty</th>
<th width="15%"><i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Rate</i></th>
<th width="15%" > <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Amount</b></i></th>
<!-- <th width="8%"> <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Discount</b></i></th>-->
<th width="20%"> GST@%</th> 
<!--th width="20%"> <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Total</b></i></th-->
<th><a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Person">
<span class="glyphicon glyphicon-plus"></span>+</a></th>

</tr>
<tr>
	<td>
		<select name="accountname" class="form-control itemcode">
			<option value="" name="accountname" selected>-Select Category--</option>
			<?php $qr  = "SELECT * FROM expenseacctmaster ";
				  $exc = mysqli_query($dbcon,$qr)or die();
				  while($r = mysqli_fetch_array($exc)){ ?>
				  <option value="<?php echo $r['accountname']; ?>"><?php echo $r['accountname']; ?></option>
			<?php
				}
			?>
			
			<option value="Sticker">Sticker</option>
		</select>
	</td>
								
									  
								  
	<!--td><input type="text" name="description" placeholder="Item Name" class="form-control"></td
	<td><input type="text" name="itemcode" placeholder="Item Details" class="form-control"></td>-->
	<td><input type="text" name="desc[]" placeholder="Description"    data-id="" class="form-control hsncode"></td>
	<td><input type="text" name="qty[]"   placeholder="Qty" data-id="" class="form-control qty"></td>
	<td><input type="text" name="price[]" placeholder="Rate/Qty"    data-id="" class="form-control price"></td>
	<td><input type="text" name="amount[]" placeholder="qtyXRate" data-id="" class="form-control amount"></td>
	
	<td>                       
                                            <select class="form-control amount" id="taxname"  onchange="rowitem.update_math_vals('po');"; name="taxname" style="line-height:1.5;">
                                                <option data-type="single" value="0" selected>Open Taxrate</option>
                                                <?php 

                                                $sql = mysqli_query($dbcon, "SELECT id,taxname,taxrate,taxtype FROM taxmaster ");
                                                while ($row = $sql->fetch_assoc()){	
                                                    $taxname=$row['taxname'];
                                                    $taxrate=$row['taxrate'];
                                                    $taxtype=$row['taxtype'];
                                                    $taxid=$row['id'];
                                                    echo '<option data-type="'.$taxtype.'"  data-rate="'.$taxrate.'" value="'.$taxid.'" >'.$taxname.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
	
	<!-- <td><input type="text" name="discount[]" class="form-control discount" placeholder="Itm wise Disc"></td> -->
	<!--<td><input type="text" name="gst[]" placeholder="GST Rate%" data-id=""  class="form-control gst" ></td>
	<!--td><input type="text" name="total[]" class="form-control total" data-id="" placeholder="Item Total"></td-->
	<td><a href='javascript:void(0);'  class='remove'><span class='glyphicon glyphicon-remove'></span>-</a></td>
</tr>
</table>

<hr>
                                <div class="row">
                                    <div class="col-md-7"></div>
                                    
									<div class="col-md-5">

                                        <div class="col-md-12">
                                            <div class="row"><div class="col-md-8"><p class="h6">Sub Total: </p>
											</div>
												
                                                <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger" id="posubtotal">--</span>
												</div>	
												
                                            </div>

                                        </div>
									</div>
									
										
									<div class="col-md-7"></div>
                                    
                                    <div class="col-md-5">

                                        <div class="col-md-12">
                                            <div class="row"><div class="col-md-8"><p class="h6">Total Tax: </p>
                                             </div>
                                                
                                                <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger" id="tottax">--</span></div>	
                                            </div>

                                        </div>
									</div>
									
									<div class="col-md-7"></div>
                                    
                                    <div class="col-md-5">

                                        <div class="col-md-12">
                                            <div class="row"><div class="col-md-8"><p class="h6">Grand Total(Round off): </p>
                                             </div>
                                                
                                                <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger" id="grandtotal">--</span></div>	
                                            </div>

                                        </div>
									</div>
									
									</div>
									
								<br><br><br><br><br><br><br>
								
									
									
										<div class="form-row">
										<div class="form-group col-md-6">
                                        <label> <div class="fa-hover col-md-12 col-sm-12">
                                           <span class="text-danger"><i class="fa fa-paperclip bigfonts" aria-hidden="true"></span></i>&nbsp;Attach Receipt<span class="text-danger">(not more than 1MB)</span></div>
                                        </label> 
                                        &nbsp;&nbsp;<input type="file" name="image" class="form-control">
                                    </div>										
                                </div>
									
									
									
							                      <div class="form-row">
                                                    <div class="form-group text-right m-b-0">
                                                       &nbsp;&nbsp;&nbsp;&nbsp; <button class="btn btn-primary" name="submit" type="submit">
                                                            Submit
                                                        </button>
                                                        <button type="reset" name="cancel" class="btn btn-secondary m-l-5">
                                                            Cancel
                                                        </button>
                                                    </div>
												</div>
												
													
													
													
								</form>
								</div>
								</div>
								</div>
								
								
								
		      </div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

    </div>
	<!-- END content-page -->
	
	
<!--?php include('footer.php');?-->
<footer class="footer">
		<span class="text-right">
		Copyright@<a target="_blank" href="#">Dhiraj Agro Products Pvt. Ltd.,</a>
		</span>
		<span class="float-right">
		Powered by <a target="_blank" href=""><span>e-Schoolz</span> </a>
		</span>
	</footer>

</div>
<!-- END main -->

<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/moment.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>

<!-- App js -->
<script src="assets/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->

<!-- END Java Script for this page -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
<script>
$(function(){
    $('#addMore').on('click', function() {
              var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
              data.find("input").val('');
     });
     $(document).on('click', '.remove', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>1) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
});      
</script>
