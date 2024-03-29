<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['expenseEdit']))
{ 
	var_dump($_POST);
	extract($_POST);
	
	
	
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
	
    $sql = "UPDATE `recordexpense` set 	
										`updatedon` = '".$updatedon."',
	                                    `category` = '".$expacctname."',
			     						 `payee` = '".$payee."',
										 `payeetype`= '".$payeetype."',
										 `amount` = '".$amount."',
										 `paymentmode` = '".$paymentmode."',
										 `updatedby` = '".$updatedby."',
										 `image` = '".$target_file."',
										 `notes` = '".$notes."'	
				         				WHERE `id` =".$expID;
										echo  $sql;
										
	// Inserting Log details into ExpenseNoteslog
	$sql1= "INSERT into expensenoteslog(`voucherid`,
										`notes`,
										`amount`,
										`updatedby`,
										`updatedon`)
								  VALUES('$voucherid',
								         '$notes',
										 '$amount',
										 '$updatedby',
										 '$updatedon')";									
	//echo $sql1 ;
   if(mysqli_query($dbcon,$sql)&& mysqli_query($dbcon,$sql1))
	{
		echo "<script>alert('Expense Successfully updated')</script>";
		header("location:listVouchers2.php");
    } else { 
	die('Error: ' . mysqli_error($dbcon));
		exit;
	echo 'Failed to update user group';
	exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
}
?>
<?php include('header.php');?>
	<!-- End Sidebar -->

    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
										<div class="row">
					<div class="col-xl-12">
							<div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">Edit Expense</h1>
                                    <ol class="breadcrumb float-right">
									<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">Edit Expense</li>
                                    </ol>
                                    <div class="clearfix"></div>
                            </div>
					</div>
			</div>


			
			<div class="row">
			
			
                    

					
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">						
						<div class="card mb-3">
							<div class="card-header">
								<!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
								 <h3><div class="fa-hover col-md-8 col-sm-8"><i class="fa fa-inr bigfonts" aria-hidden="true">
								 </i>Edit Expense </div></h3>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
																
									<form method="post" action="editExpenses.php"  enctype="multipart/form-data">
											<?php
											include("database/db_conection.php");//make connection here
											if(isset($_GET['id']))
											{
												$id=$_GET['id'];
												//selecting data associated with this particular id
												$result = mysqli_query($dbcon, "SELECT * FROM recordexpense  WHERE id=$id");
												while($res = mysqli_fetch_array($result))
												{
													$voucherid = $res['voucherid'];
													$updatedon = $res['createdon'];
													$expacctname= $res['category'];
													$payee = $res['payee'];
													$payeetype= $res['payeetype'];
													$amount = $res['amount'];
													$paymentmode= $res['paymentmode'];
													$image= $res['image'];
													$notes= $res['notes'];
													
												}
											}
											?>
											
								<div class="form-row">
									<div class="form-group col-md-12">
									  <label></i>Voucher ID</label>
									  <input type="text" class="form-control form-control-sm" name="voucherid" readonly value="<?php echo $voucherid;?>" />
									  </div>
									  </div>
									  
											<div class="form-row">
									<div class="form-group col-md-12">
									   <label for="datepicker1">Date</label><span class="text-danger">*</span>
									   <input type="date" class="form-control form-control-sm"  name="updatedon" value="<?php echo $updatedon;?>"/>	
									</div>
									</div>
									
								
								<div class="form-row">
									       <div class="form-group col-md-12">
                                                <label for="inputState">Expense Account</label><span class="text-danger">*</span>
                                                <select id="expacctname" onchange="onload(this)" class="form-control select2" name="expacctname" required>
                                                 <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT accountname FROM expenseacctmaster");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $acctname_get=$row['accountname'];
                                                         if($acctname_get==$accountname){
                                                            echo '<option value="'.$acctname_get.'" selected>'.$acctname_get.'</option>';

                                                        }else{
                                                            echo '<option value="'.$acctname_get.'" >'.$acctname_get.'</option>';

                                                        }
													}
													?>
                                                </select>
                                            </div>
                                        </div>								  
									 
								    <div class="form-row">
									<div class="form-group col-md-12">
									 Payee<label ></label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="payee" value="<?php echo $payee;?>"/>	
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-12">
									  <label >Payee Type</label>
									 <select required id="payeetype" name="payeetype" data-parsley-trigger="change"  class="form-control form-control-sm"  >	
									    <option <?php if ($payeetype == "Supplier" ) echo 'selected="selected"' ; ?> value="Supplier">Supplier</option>
										<option <?php if ($payeetype == "Customer" ) echo 'selected="selected"' ; ?> value="Customer">Customer</option>
										<option <?php if ($payeetype == "Employee" ) echo 'selected="selected"' ; ?> value="Employee">Employee</option>
										<option <?php if ($payeetype == "Others" ) echo 'selected="selected"' ; ?> value="Others">Others</option>
										
									</select>
									</div>
									</div>
									
									<div class="form-row">
								 <span class="text-danger"> Amount<label >*</span></label>
									<form class="form-inline">	
								  <div class="input-group mb-2 mr-sm-2 mb-sm-0">								  								  
									<div class="input-group-addon">INR</div>
									<input type="text" name="amount" class="form-control form-control-sm" id="inlineFormInputGroupUsername2" value="<?php echo $amount;?>"/>	
									</div>										
									</div><br/>
									
									<div class="form-row">
									<div class="form-group col-md-12">
									  <label >Payment mode</label>
									 <select required id="paymentmode" name="paymentmode" data-parsley-trigger="change"  class="form-control form-control-sm" >	
										<option <?php if ($paymentmode == "Cash" ) echo 'selected="selected"' ; ?> value="Cash">Cash</option>
										<option <?php if ($paymentmode == "Cheque" ) echo 'selected="selected"' ; ?> value="Cheque">Cheque</option>
										<option <?php if ($paymentmode == "Credit Card" ) echo 'selected="selected"' ; ?> value="Credit Card">Credit Card</option>
										<option <?php if ($paymentmode == "Bank Transfer" ) echo 'selected="selected"' ; ?> value="Bank Transfer">Bank Transfer</option>
										<option <?php if ($paymentmode == "PhonePe" ) echo 'selected="selected"' ; ?> value="PhonePe">PhonePe</option>
										<option <?php if ($paymentmode == "GPay" ) echo 'selected="selected"' ; ?> value="GPay">GPay</option>
									
									</select>
									</div>
									</div>	

									<div class="form-row">
									<div class="form-group col-md-12">
									 <label>Notes</label></span>									  
									  <textarea id='notes' name="notes" rows="2" cols="83"><?php echo $notes; ?></textarea>
									</div> 
								</div>	
									
								<!--div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>
                                            <div class="fa-hover col-md-12 col-sm-12">
                                           <span class="text-danger"><i class="fa fa-paperclip bigfonts" aria-hidden="true"></span></i>&nbsp;Attach updated Receipt<span class="text-danger">(not more than 1MB)</span></div>
                                        </label> 
                                        &nbsp;&nbsp;<input type="file" name="image" class="form-control">
                                    </div>
								</div-->
								
								<div class="form-row">
                                   <div class="form-group col-md-11">
                                        <label>
                                            <div class="fa-hover col-md-12 col-sm-12">
                                              <span class="text-danger"><i class="fa fa-paperclip bigfonts" aria-hidden="true"></span></i>&nbsp;Attach updated Receipt<span class="text-danger">(not more than 1MB)</span></div>
                                        </label> 
                                        <img src="<?php echo $image;?>" width="350px" class="rounded float-left" alt="...">

                                        &nbsp;&nbsp;<input type="file" name="image" class="form-control form-control-sm">
                                    </div>
                                </div>

								<div class="form-row">
									  <div class="form-group col-md-12">
									  <label for="inputState">Updated By</label>
									  <?php 
														//session_start();
														include("database/db_conection.php");
														$userid = $_SESSION['userid'];
														$sq = "select username from userprofile where id='$userid'";
														$result = mysqli_query($dbcon, $sq) or die(mysqli_error($dbcon));
														//$count = mysqli_num_rows($result);
														$rs = mysqli_fetch_assoc($result);
													?>
									   <input type="text" class="form-control form-control-sm" name="updatedby" readonly class="form-control form-control-sm" value="<?php echo $rs['username']; ?>" />
									
									 </div>
									 </div>			
								
								
										<div class="form-row">
								     <div class="modal-footer">
										<input type="hidden" name="expID" value="<?=$_GET['id']?>">
										<button type="submit" name="expenseEdit" value="expenseEdit" class="btn btn-primary">Update</button>
									</div>
									</div>
								
													
								</form>
							
		      </div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

    </div>
	<!-- END content-page -->
	
    
	<footer class="footer">
		<span class="text-right">
		Copyright@2021<a target="_blank" href="#">POS</a>
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
<script>
                function onlocode(){

                    console.log(this);
                }
            </script>
<!-- END Java Script for this page -->

<!-- BEGIN Java Script for this page -->
<script src="assets/plugins/select2/js/select2.min.js"></script>
<script>                                
$(document).ready(function() {
    $('.select2').select2();
});
</script>
<!-- END Java Script for this page -->


</body>
</html>