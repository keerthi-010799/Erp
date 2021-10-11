<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit'])){	
	$createdon=$_POST['createdon'];//same
	$payee=$_POST['payee'];
    $category=$_POST['category'];//same
	$description=$_POST['description'];//same
	
	$payeetype=$_POST['payeetype'];//same
	$paymentmode=$_POST['paymentmode'];//same
	$notes=$_POST['notes'];//same
	//$image=$_POST['image'];//same
	$createdby = $_POST['createdby'];
	$amount = $_POST['amount'];//same
	
	
	//$payeename = $_POST['payeename'];//same
	//$id = $_POST['id'];
			
			
 //$image = file_get_contents($image
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
	$prefix = "VOUID-";
	
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
	`payee`,
	`payeetype`,
	`createdon`, 	
	`category`, 
	`description`, 
	`amount`,
	`paymentmode`,
	`notes`, 	
	`createdby`,									
	`image`)
VALUES ('$voucherid',
	'$payee',
	'$payeetype',
	'$createdon',
	'$category',
	'$description',
	'$amount',
	'$paymentmode',
	'$notes',									
	'$createdby',									
	'$target_file'
)";		

		
//$sql3 = "UPDATE payeemaster set amount = amount- $amount  WHERE payeeid = $payeeid";
//echo $sql3;			
			
	
	//echo "$insert_recordexpense";
	// Inserting Log details into ExpenseNoteslog
	 $sql1= "INSERT into expensenoteslog(`voucherid`,										
										`payee`,
										`amount`,
										`notes`,
										`createdby`,
										`createdon`)
								  VALUES('$voucherid',
										  '$payee',										
										  '$amount',
								          '$notes',
										  '$createdby',
										  '$createdon')";
										  
	//Updating paymaster table's amount 								  
	// $updateamount = "UPDATE payeemaster SET amount = amount - '".$amount."' WHERE payeeid='$payeeid'";
		//echo $updateamount;
	//	$result=mysqli_query($dbcon,$updateamount);
	//	if (!$result)
	//	{
	//		die('Error: '. mysqli_error($dbcon));

	//	}

	if(mysqli_query($dbcon,$sql)&& mysqli_query($dbcon,$sql1))
	{
		echo "<script>alert('Expense Master creation Successful ')</script>";
		header("location:listVouchers2.php");
    } else {
		die('Error: ' . mysqli_error($dbcon));
		exit;
		echo "<script>alert('Transport Master creation  unsuccessful ')</script>";
	}
	
}
?>
<?php include('header.php'); ?>

<!-- Category Modal -->
<div class="modal fade custom-modal" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" enctype="multipart/form-data" method="post">

                    <div class="form-group">
                        <input type="text" class="form-control" name="addcategory1"  id="addcategory1"  placeholder="Add Category">
                    </div>		
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" name="submitcategory1" id="submitcategory1" class="btn btn-primary">Save and Associate</button>
            </div>
        </div>
    </div>
</div>

<div class="content-page">

	<!-- Start content -->
	<div class="content">
		
		<div class="container-fluid">

				
									<div class="row">
				<div class="col-xl-12">
						<div class="breadcrumb-holder">
								<h1 class="main-title float-left">Expenses</h1>
								<ol class="breadcrumb float-right">
									<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
									<li class="breadcrumb-item active">Expenses</li>
								</ol>
								<div class="clearfix"></div>
						</div>
				</div>
		</div>
		<!-- end row -->

		
		<!--div class="alert alert-success" role="alert">
		
				  <h3 class="alert-heading"></h3>
				  <p></a></p>
		</div-->

		
				

				
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">						
					<div class="card mb-3">
						<div class="card-header">
							<!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
							 <h3><div> Add Expense  Entries
							 </div></h3>all * Marked are Mandatory
							 <!--p class="text-danger"><?php echo $payeeFound;?></p--> 
							
							<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
							</i>Add Transport Master Details
							</h3-->
							
						</div>
							
						<div class="card-body">
							
							<!--form autocomplete="off" action="#"-->
							<form action=""  enctype="multipart/form-data" method="post" 	accept-charset="utf-8" >

							<div class="form-row">
								<div class="form-group col-md-10">
								  <label >Date<span class="text-danger"></span></label>
								  <input type="date" class="form-control" name="createdon"  value="<?php print(date("Y-m-d")); ?>"/>
								</div>
								</div>
								
							
								<div class="form-row">		
									<div class="form-group col-md-10">
										<label >Payee<span class="text-danger">*</span></label>
										<input type="text" class="form-control form-control-sm" name="payee"  required/>
									</div>
								</div>	
								
							 <div class="form-row">
							<div class="form-group col-md-10">
								<label >Payee Type<span class="text-danger">*</span></label>
								<select required id="inputState" data-parsley-trigger="change"  required class="form-control form-control-sm"  name="payeetype" >
									<option value="">-Select Payee Type</option>
									<option value="Supplier">Supplier</option>
									<option value="Employee">Em[ployee</option>
									<option value="Others">Others</option>
									</select>
							</div>
						</div>
						
							
								<div class="form-row">
								<div class="form-group col-md-10">
												<label for="category">Expense Category<span class="text-danger">*</span></label>
												<select required  id="category" class="form-control select2"  name="category" >
												<option value="">-Select Category-</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT accountname FROM expenseacctmaster");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $expensename=$row['accountname'];
                                                        echo '<option onchange="'.$row[''].'" value="'.$expensename.'" >'.$expensename.'</option>';
                                                    }
                                                    ?>
                                                </select>
												<a href="#custom-modal" data-target="#customModal" data-toggle="modal"> 
                                            <i class="fa fa-user-plus" aria-hidden="true"></i>Add New Category</a><br>

											</div>
										</div>

										<div class="form-row">		
									<div class="form-group col-md-10">
										<label >Description<span class="text-danger"></span></label>
										<textarea rows="1" class="form-control" name="description" placeholder="Enter Expense Description" ></textarea>
									</div>
								</div>

							
							<div class="form-row">
								<div class="form-group col-md-10">	
									<form class="form-inline">
									<label class="sr-only" for="inlineFormInputGroupUsername2">Amount</label>
									<div class="input-group mb-2 mr-sm-2">
										<div class="input-group-prepend">
											<div class="input-group-text">₹</div>
										</div>												
										 <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Amount " required>
									</div>
										
										<!--div class="form-group col-md-5">								
										<span class="input-group-text"><i class="fa fa-rupee bigfonts" aria-hidden="true"></i>
										  <input type="text" id="amount" class="form-control" data-inputmask="'alias': 'ip'" data-mask" name="amount" placeholder="You can Edit Your Own Amt" required  >
									</div-->
							</div>
							</div>

							<div class="form-row">
									<div class="form-group col-md-10">							
												<label >Payment Mode<span class="text-danger">*</span></label>
												<select required id="inputState" data-parsley-trigger="change"  class="form-control select2"  name="paymentmode" >
													<!--option value="">-Select Payment Mode-</option-->
														<option value="Cash">Cash</option>
														<option value="Cheque">Cheque</option>
														<option value="Credit Card">Credit Card</option>
														<option value="Bank Transfer">Bank Transfer</option>
														<option value="PhonePe">PhonePe</option>
														<option value="GPay">GPay</option>

												</select>
											</div>  
												</div>
											
													
									<div class="form-row">
									<div class="form-group col-md-10">	
												<label>Reference/Expense Notes</label><br />												
												<!--textarea id='notes' name="notes" rows="3" cols="92"><?php echo $notes; ?></textarea-->
													<textarea id='notes' name="notes" rows="3" cols="92" placeholder="Enter Expense notes such as Payment Transaction Details reference number and other details"></textarea>
										</div>
									</div>
						
							
								
								
								<!--div class="form-row">									
								 <div class="form-group col-md-10">
									  <label >Mobile<span class="text-danger">*</span></label>
											  <input data-parsley-type="number" type="text" name="mobile" class="form-control" required placeholder="Enter Money Lender's Mobile" />
										</div>
									</div-->
									
								<div class="form-row">									
									<div class="form-group col-md-10">
										<label>Place</label>                                          
											<input type="text" class="form-control form-control-sm" name="location" placeholder="Enter Place of the Payee" />
									</div>
								</div>

								<div class="form-row">
                                <div class="form-group col-md-9">
                                    <h4 class="col-md-12 text-muted">Attach Bill</h4>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-11">
                                    <label>
                                        <div class="fa-hover col-md-12 col-sm-12">
                                            &nbsp;<i class="fa fa-folder-open bigfonts" aria-hidden="true"></i>Upload image like JPG,GIF,PNG..</div>
                                    </label> 
                                    &nbsp;&nbsp;<input type="file" name="image" class="form-control"  required>
                                </div>
                            </div>
											
						<div class="form-row">
								<div class="form-group col-md-10">
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
								<div class="form-group text-right m-b-10">
												   &nbsp;<button class="btn btn-primary" name="submit" type="submit">
														Submit
													</button>
													</button>
<button type="button" name="cancel" class="btn btn-secondary m-l-5" onclick="window.history.back();">Cancel
													</button>
												</div>
												</div>
												</div>
											
												
											
							</form>
							</div>
							</div>
						
							
		<!-- END container-fluid -->

	</div>
	<!-- END content -->

</div>
<!-- END content-page -->

<script>
        $('document').ready(function(){	
            $('#submitcategory').click(function(){
                var category = $('#addcategory').val();
                //var suptype = $('#addsupptype').val();
                //alert(groupname+description);
                $.ajax ({
                    url: 'expenseCategoryModal.php',
                    type: 'post',
                    data: {
                        category:category,
                        // description:description
                    },
                    //dataType: 'json',
                    success:function(response){
                        if(response!=0 || response!=""){
                            var new_option ="<option>"+response+"</option>";
                            $('#category').append(new_option);
                            $('#customModal').modal('toggle');
                        }else{
                            alert('Error in inserting new Category,try another unique category');
                        }
                    }

                });

            });
        });

    </script>			

<!-- BEGIN Java Script for this page -->
<script src="assets/plugins/select2/js/select2.min.js"></script>
<script>                                
$(document).ready(function() {
    $('.select2').select2();
});
</script>
<!-- END Java Script for this page -->

<?php include('footer.php'); ?>