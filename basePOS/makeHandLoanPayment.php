<?php 
include("database/db_conection.php");//make connection here

if(isset($_POST['makePayment']))
{ 
	var_dump($_POST);
	extract($_POST);
    $sql= "UPDATE `payeemaster` SET `createdon` = '".$createdon."', `payeename` = '".$payeename."',
										`payeetype` = '".$payeetype."',`description` = '".$description."',
										`amount` = `amount` - '".$amountPaid."',
										`mobile` = '".$mobile."',`location` = '".$location."',`status` = '".$status."',
										`notes` = '".$notes."',
										`createdby` = '".$createdby."'
										 WHERE `id` =".$PayID;
										 
	//echo $sql;
    //exit;
										 
	$sql1= "INSERT into payeemasterlog(`payeeid`,
	`payee`,
	`amount`,
	`notes`,	
	`createdon`,								
	`updatedby`,
	`updatedon`)
VALUES('$payeeid',
	 '$payeename',
	 '$amountPaid',
	 '$notes',	
	 '$createdon',
	 '$createdby',
	 '$createdon')";		

echo $sql1;

if(mysqli_query($dbcon,$sql)&& mysqli_query($dbcon,$sql1))
   {
		echo "<script>alert('Type Details Successfully updated')</script>";
		header("location:listPayeeMaster.php");
		} else {
     die('Error: ' . mysqli_error($dbcon));
		exit;
	echo 'Failed to update user group';
	exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
}
?>
<?php include('header.php'); ?>


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
										<div class="row">
					<div class="col-xl-12">
							<div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">Make Loan Payments </h1>
                                    <ol class="breadcrumb float-right">
										<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">Loan Repayments </li>
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
								 <h3><div> Edit Payee 
								 </div></h3>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action="makeHandLoanPayment.php"  enctype="multipart/form-data" method="post" 	accept-charset="utf-8" >
								
								<?php
											include("database/db_conection.php");//make connection here
 
											if(isset($_GET['id']))
											{
												$id=$_GET['id'];
											  
												//selecting data associated with this particular id
												$result = mysqli_query($dbcon, "SELECT * FROM payeemaster WHERE id=$id");
									 
												while($res = mysqli_fetch_array($result))
												{
													$payeeid = $res['payeeid'];
													$createdon = $res['createdon'];
													$payeename = $res['payeename'];
													$payeetype = $res['payeetype'];
													$description = $res['description'];
													$amount = $res['amount'];
													$mobile = $res['mobile'];
													$location = $res['location'];
													$createdby = $res['createdby'];
													$status = $res['status'];
													$notes = $res['notes'];
													$location = $res['location'];
												}
											}
												
											?>			
								
						
								

								<div class="form-row">
									<div class="form-group col-md-10">
									  <label >Date<span class="text-danger"></span></label>
									  <input type="date" class="form-control" name="createdon"   value="<?php echo $createdon;?>" />
									  </div>
									</div>
											
								<div class="form-row">
									<div class="form-group col-md-10">
									  <label >Payee ID<span class="text-danger"></span></label>
									  <input type="text" class="form-control" name="payeeid"   readonly value="<?php echo $payeeid;?>" />
									  </div>
									</div>
									
								
									<div class="form-row">		
										<div class="form-group col-md-10">
											<label >Payee<span class="text-danger">*</span></label>
											<input type="text" class="form-control form-control-sm" readonly name="payeename"  value="<?php echo $payeename;?>" />
										</div>
									</div>	
									
								 <!--div class="form-row">
                                <div class="form-group col-md-10">
                                    <label >Payee Type<span class="text-danger">*</span></label>
                                    <select required id="inputState" data-parsley-trigger="change"  class="form-control form-control-sm"  name="payeetype" >                                        
										<option <?php if ($payeetype == "Money Lender" ) echo 'selected="selected"' ; ?> value="Money Lender">Money Lender</option>
								        <option <?php if ($payeetype == "Friends/Relatives" ) echo 'selected="selected"' ; ?> value="Friends/Relatives">Friends/Relatives</option>										
								        <option <?php if ($payeetype == "Others" ) echo 'selected="selected"' ; ?> value="Others">Others</option>
								
										
										</select>
                                </div>
                            </div-->
							
								<!--div class="form-row">		
										<div class="form-group col-md-10">
											<label >Description<span class="text-danger"></span></label>
											<textarea rows="2" class="form-control" name="description" ><?php echo $description;?></textarea>
										</div>
									</div-->	

								
								<div class="form-row">
                                	<div class="form-group col-md-5">	
										<label>Amount Payable</label>												
											 <input type="text" name="amount" class="form-control" id="amount" readonly value="<?php echo $amount;?>" data-default="<?php echo $amount;?>" />
										</div>										
										<div class="form-group col-md-5">	
												<label>Enter Amount </label><br />
												<input type="text" name="amountPaid" class="form-control form-control-sm " placeholder="Enter Amount you wish to Pay">
												</div>

										</div>

										<!--div class="form-group col-md-5" >
														
									 <input type="number" step="any" onkeypress="update_math_vals1();"   onkeyup="update_math_vals1();"   id="adjust_amount" name="adjust_amount" class="form-control" placeholder="Adjust Amount" />
									<span class="text-danger">you can deduct or add amount using - and + e.g -100 for deducting and for adding +not required</span></label> 
									</div>										
								</div>
								
								 <script>
									 function update_math_vals1(){
										
										 var adj = $('#adjust_amount').val();

										 var amt = $('#amount').attr("data-default");
                                          var fin = +adj + +amt;
										 // console.log(fin,adj,amt,"test")
											$('#amount').val(fin);
								
										// $('#amount').val(fin);
										 //$('#product_price').val();										 
									 }
									</script-->
									
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
											
											<!--div class="form-group col-md-5">	
												<label>Reference</label><br />
												<input type="text" name="reference" class="form-control form-control-sm " placeholder="Cheque No/Payment Transaction Ref No..">
												</div>
									</div-->
									</div>
									<div class="form-row">
									<div class="form-group col-md-5">
									  <label >Mobile<span class="text-danger"></span></label>
									  <input type="text" class="form-control" readonly name="mobile"   value="<?php echo $mobile;?>" />
									  </div>
									
									<div class="form-group col-md-5">
									  <label >Location<span class="text-danger"></span></label>
									  <input type="text" class="form-control" readonly name="location"   value="<?php echo $location;?>" />
									  </div>
									</div>
								

											
									<div class="form-row">
									<div class="form-group col-md-10">	
												<label>Notes</label><br />												
												<textarea id='notes' name="notes" rows="3" cols="92"><?php echo $notes; ?></textarea>

										</div>
									</div>
								
									
									<div class="form-row">	
									<div class="form-group col-md-10">	
										<label>Update Status *</label>						   
								 <select id="groupname" required onchange="ongroup(this)" required class="form-control form-control-sm" name="status">
								<option <?php if ($status == "0" ) echo 'selected="selected"' ; ?> value="0">UNPAID</option>
								<option <?php if ($status == "1" ) echo 'selected="selected"' ; ?> value="1">PAID</option>
								<option <?php if ($status == "2" ) echo 'selected="selected"' ; ?> value="2">PARTIALLY PAID</option>
								</select>
							</div>
							</div>
											
								<div class="form-row">
                                    <div class="form-group col-md-10">
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
                                        <input type="text" class="form-control form-control-sm" name="createdby" readonly class="form-control form-control-sm" value="<?php echo $rs['username']; ?>" required />
                                    </div>
                                </div>											
									
								    <div class="form-row">
								    <div class="form-group text-right m-b-10">
                                                       <input type="hidden" name="PayID" value="<?=$_GET['id']?>" />
													<button type="submit" name="makePayment" value="makePayment" class="btn btn-primary">Update</button>
													</button>
														<button type="button" name="cancel" class="btn btn-secondary m-l-5" onclick="window.history.back();">Cancel</button>
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
	
<?php include('footer.php'); ?>