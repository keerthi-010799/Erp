<?php 
include('header.php');
?>

<!-- End Sidebar -->
<!-- modal addnew customer-->
<div class="modal fade custom-modal" id="newcustomermodal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Add New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">   
            <form autocomplete="off" id="new_customer_form" action="#" enctype="multipart/form-data" method="post">								
				<div class="form-row">
					<div class="form-group col-md-3">
							<label for="inputState">Title</label>
							<select required id="inputState" class="form-control form-control-sm"  name="title">
								<span class="text-muted"> 
								<option value="" >Salutation</option></span>
								<option value="M/S.">MS.</option>
								<option value="Mr.">Mr.</option>
								<option value="Mrs.">Mrs.</option>
								<option value="Mrs.">Dr.</option>
							</select>
                    </div>
                    <div class="form-group col-md-8">
						 <label >Name<span class="text-danger">*</span></label>
		    			  <input type="text" class="form-control form-control-sm" name="custname" placeholder="Customer Full Name/Display Name" required class="form-control" autocomplete="off">
				    </div>
				</div>
                <div class="form-row">
                    <div class="form-group col-md-11">
                        <label for="inputState">Customer Type</label>
                        <select required id="custype" onchange="onlocode(this)"  class="form-control form-control-sm" name="custype">
                            <option value="">Open Customer Type</option>
                                <?php 
                                 include("database/db_conection.php");//make connection here
                                 $sql = mysqli_query($dbcon, "SELECT custype FROM custype");
                                 while ($row = $sql->fetch_assoc()){	
                                 echo $custype=$row['custype'];
                                 echo '<option onchange="'.$row[''].'" value="'.$custype.'" >'.$custype.'</option>';
                                }
                                ?>
                        </select>
								
					</div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-11">
                        <label for="inputState">Business Location</label>
                        <select id="locname" onchange="onlocode(this)" class="form-control form-control-sm" name="blocation">
                            <option value="">Open Location</option>                        
							<?php 
                                include("database/db_conection.php");//make connection here
                                $sql = mysqli_query($dbcon, "SELECT code,description FROM state");
                                while ($row = $sql->fetch_assoc()){	
								 $code=$row['code'];
                                 $description=$row['description'];
                                 echo '<option  value="'.$description.'" >'.$description.'</option>';                                                      
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
					<div class="form-group col-md-9">
					  <h4 class="col-md-12 text-muted"><b>Customer Address &nbsp;</b></h4>
					</div>
				</div>				
				<div class="form-group row">
					<div class="col-md-11"> 
						<input type="text" placeholder="No,Street " name="address" class="form-control form-control-sm"> 
					</div>
				</div>
                <div class="form-row">
					<div class="form-group col-md-11">
					   <input type="text" class="form-control form-control-sm" required name="city"  placeholder="City/town/village *">
					</div>
				</div>
                <div class="form-row">
			        <div class="form-group col-md-4">
                        <select required id="inputState" onchange="onlocode(this)"  class="form-control form-control-sm" name="state">
                            <span class="text-muted">  <option value="">State/Union Territory *</option> </span>
                            <?php 
                              include("database/db_conection.php");//make connection here
                              $sql = mysqli_query($dbcon, "SELECT code,description FROM state");
                              while ($row = $sql->fetch_assoc()){	
								$code=$row['code'];
                                $description=$row['description'];
                                echo '<option  value="'.$code.'" >'.$description.'</option>';                                                      
                              }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <select required id="inputState" onchange="onlocode(this)"  class="form-control form-control-sm" name="country">
                            <span class="text-muted"> <option value="">Country *</option> </span>
                            <?php 
                                include("database/db_conection.php");//make connection here
                                $sql = mysqli_query($dbcon, "SELECT code,description FROM country");
                                while ($row = $sql->fetch_assoc()){	
                                    $code=$row['code'];
                                    $description=$row['description'];
                                    echo '<option  value="'.$code.'" >'.$description.'</option>';        
                                }
                            ?>
                        </select>
					</div>				
					<div class="form-group col-md-3">
						<input type="text" class="form-control form-control-sm" name="zip"  placeholder="Zip/Postal Code ">
					</div>				
				</div>					
				<div class="form-row">
					<div class="form-group col-md-9">
						<h4 class="col-md-12 text-muted">Contact Details</h4>
					</div>
				</div>					
				<div class="form-row">
					<div class="form-group col-md-3">
						<label> Work Phone</label>
						<input type="text" class="form-control form-control-sm" name="workphone"  placeholder="Landline">
					</div>			
					<div class="form-group col-md-3">
						<label> Mobile <span class="text-danger">*</span></label>
						<input type="text" class="form-control form-control-sm" name="mobile"  required placeholder="9677573737">
					</div>				
					<div class="form-group col-md-5">
						<label> Email<span class="text-danger"></span></label>
						<input type="email" class="form-control form-control-sm" name="email"   placeholder="Optional" autocomplete="off">
						</div>
				</div>					
				<div class="form-row">
					<div class="form-group col-md-11">									
						<input type="text" class="form-control form-control-sm" name="web"  placeholder="Website(Optional)">
					</div>
				</div>
                <div class="form-row">
					<div class="form-group col-md-9">
						<h4 class="col-md-12 text-muted">Tax Details</h4>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-11">
						<label>GSTIN<span class="text-danger"></span></label>
						<input type="text" class="form-control form-control-sm" name="gstin"  placeholder="Maximum 15 Digits">
					</div>
				</div>
                <div class="form-row">
				    <div class="col-md-12 col-md-offset-12">
						<div class="checkbox"><label>
							<input type="checkbox" name="primaryflag" value="0" class="ember-checkbox ember-view">Make this profile as primary for all correspondence</label>
						</div>
					</div>
				</div>											
            </form>
          </div>
    
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" id="newcustomer"  class="btn btn-primary">Save and Associate</button>
            </div>
        </div>
    </div>
</div>
</div>

<!--modal add item-->
<div class="modal fade custom-modal" id="additemModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Add New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--?php include('addSalesItemMaster.php'); ?-->
                <form id="salesitemform" autocomplete="off" action="#" enctype="multipart/form-data" method="post">			

								<div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="brand">Brand</label>
                                        <select id="brand" onchange="" class="form-control form-control-sm select2"
                                         name="brand"  autocomplete="off">
                                         
                                            <option selected>Select Brand</option>
                                            <?php 
                                            include("database/db_conection.php");//make connection here
                                            $sql = mysqli_query($dbcon,"SELECT id,brand FROM brandmaster
																			ORDER BY id ASC
																			");
                                            while ($row = $sql->fetch_assoc()){	
                                                echo $brand_id=$row['id'];
                                                echo $brand=$row['brand'];
                                              //  echo '<option onchange="'.$row[''].'" value="'.$brand_id.'" >'.$brand_id.'-'.$brand.'</option>';
                                                echo '<option onchange="'.$row[''].'" value="'.$brand.'" >'.$brand.'</option>';

                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Item Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="itemname" id="itemname" placeholder="Product Name" required class="form-control" autocomplete="off" />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Category</label>
                                        <select id="category" onchange="" class="form-control form-control-sm" name="category" id="category" autocomplete="off">
                                            <option selected>Select Category</option>
                                            <?php 
                                            include("database/db_conection.php");//make connection here
                                            $sql = mysqli_query($dbcon,"SELECT code,category FROM itemcategory
																			ORDER BY id ASC
																			");
                                            while ($row = $sql->fetch_assoc()){	
                                                echo $category_code=$row['code'];
                                                echo $category=$row['category'];
                                                echo '<option onchange="'.$row[''].'" value="'.$category.'" >'.$category.'</option>';

                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
								

								<div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Size</label>
                                        <input type="text" name="size" id="size" class="form-control form-control-sm"  placeholder="Size 40,39,L,M"  >
                                    </div>
                                </div>	

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>HSN Code</label>
                                        <input type="text" name="hsncode" id="hsncode" class="form-control form-control-sm"  placeholder="Enter a valid HSN Code.."  >
                                    </div>
                                </div>	


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5>Sales Price Information</h5>
                                    </div>
                                </div>
                                <div id="sales_div">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                            <label>Sales Rate/Price<span class="text-danger">*</span></label>
                                            <input type="text" onchange="gettaxrate('sales_div');" name="sales_priceperqty" id="sales_priceperqty" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" />
                                        </div>
                                        <div class="form-group col-md-2" id="adjust_price" style="display:none">
                                            <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                            <label>Adjust Price</label>
                                            <input type="number" step="any" onkeypress="adjustprice('sales');"  onkeyup="adjustprice('sales');" id="sales_adjpriceperqty" name="sales_adjpriceperqty" class="form-control form-control-sm"   />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>UOM&nbsp;<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                               data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this UNIT(e.g.:Kgs,dozen,box"></i>
                                                <span class="text-danger">*</span></label>
                                            <select id="sales_uom" onchange="gettaxrate('sales_div');" required class="form-control form-control-sm" name="sales_uom">
                                                <option value="0" selected>Select UOM</option>
                                                <?php 
                                                include("database/db_conection.php");//make connection here

                                                $sql = mysqli_query($dbcon, "SELECT code,description FROM uom_lookups ");
                                                while ($row = $sql->fetch_assoc()){	
                                                    $description=$row['description'];
                                                    $code=$row['code'];
                                                    echo '<option  value="'.$code.'" >'.$description.'</option>';
                                                }
                                                ?>
                                            </select>	
                                        </div>							
                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>As of Date<span class="text-danger">*</span></label>
                                            <i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                               data-trigger="focus" data-placement="top" title="As of Date is price as on date"></i>
                                            <input type="date" class="form-control form-control-sm"  name="sales_pricedatefrom" id="sales_pricedatefrom" value="<?php echo date("Y-m-d");?>">					  
                                        </div>
                                    </div>											


                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputState">Tax Method
                                            </label>
                                            <select id="sales_taxmethod" name="sales_taxmethod" onchange="gettaxrate('sales_div')" class="form-control form-control-sm" name="taxmethod">
                                                <option selected>Select Tax Method</option>
                                                <option value="1">Inclusive</option>
                                                <option value="0">Exclusive</option>
                                            </select>
                                        </div>



                                        <div class="form-group col-md-3">
                                            <label for="inputState">Tax Name</label>
                                            <select id="sales_taxid" onchange="gettaxrate('sales_div');" required class="form-control form-control-sm" name="sales_taxid">
                                                <option value="0" selected>Open Taxrate</option>
                                                <?php 

                                                $sql = mysqli_query($dbcon, "SELECT id,taxtype,taxname,taxrate FROM taxmaster ");
                                                while ($row = $sql->fetch_assoc()){	
                                                $taxname=$row['taxname'];
                                                $taxrate=$row['taxrate'];
                                                $taxtype=$row['taxtype'];
                                                $taxid=$row['id'];
                                                echo '<option  data-name="'.$taxname.'" data-type="'.$taxtype.'" data-rate="'.$taxrate.'" value="'.$taxid.'" >'.$taxname.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    <div class="form-group" style="display:none;">
                                        <input type="text" name="sales_taxtype" id="sales_taxtype" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" readonly>
                                    </div> 
                                    <div class="form-group" style="display:none;">
                                        <input type="text" name="sales_taxname" id="sales_taxname" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" readonly>
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <input type="text" name="itemcost" id="itemcost" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" readonly>
                                    </div>
                                    </div>




                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <!-- <i class="fa fa-rupee fonts" aria-hidden="true"></i> -->
                                            <label>Tax Rate %<span class="text-danger">*</span></label>
                                            <input type="text" name="sales_taxrate" id="sales_taxrate" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" readonly>
                                        </div>

                                        <div class="form-group col-md-3">									
                                            <label>Tax Amount&nbsp;<span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                                                                data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
                                                </span></label>
                                            <input type="text" name="sales_taxamount" id="sales_taxamount" class="form-control form-control-sm" autocomplete="off" placeholder="Tax Amount" required readonly />
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                            <label>Actual Product Price<span class="text-danger">*</span></label>
                                            <input type="text" name="sales_product_price" id="sales_product_price" class="form-control form-control-sm"  required placeholder="Actual Product price" autocomplete="off" readonly />
                                        </div>

                                        <div class="form-group col-md-3">									
                                            <label>Final Price&nbsp;<span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                                                                 data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
                                                </span></label>
                                            <input type="text" name="sales_final_price" id="sales_final_price" class="form-control form-control-sm" autocomplete="off" placeholder="Price Including Tax" required readonly>
                                        </div>
                                    </div>
                                </div>											


                                <div class="form-row" style="display:none">
                                    <div class="form-group col-md-6">
                                        <h5>Purchase Price Information</h5>
                                    </div>
                                </div>
                                <div id="purchase_div" style="display:none">
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                            <label>Cost<span class="text-danger"></span></label>
                                            <input type="text" onchange="gettaxrate('purchase_div');" name="priceperqty" id="priceperqty" class="form-control form-control-sm"  placeholder="Price Per Qty" autocomplete="off" />
                                        </div>
                                        <div class="form-group col-md-2" id="adjust_cost" style="display:none">
                                            <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                            <label>Adjust Price</label>
                                            <input type="number" step="any" onkeypress="adjustprice('purchase');"  onkeyup="adjustprice('purchase');" id="adjpriceperqty" name="adjpriceperqty" class="form-control form-control-sm"   />
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>UOM&nbsp;<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                               data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this UNIT(e.g.:Kgs,dozen,box"></i>
                                                <span class="text-danger">*</span></label>
                                            <select id="uom" onchange="gettaxrate('purchase_div');"  class="form-control form-control-sm" name="uom">
                                                <option value="0" selected>Select UOM</option>
                                                <?php 

                                                $sql = mysqli_query($dbcon, "SELECT code,description FROM uom_lookups ");
                                                while ($row = $sql->fetch_assoc()){	
                                                    $description=$row['description'];
                                                    $code=$row['code'];
                                                    echo '<option  value="'.$code.'" >'.$description.'</option>';
                                                }
                                                ?>
                                            </select>	
                                        </div>	

                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>As of Date<span class="text-danger">*</span></label>
                                            <i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                               data-trigger="focus" data-placement="top" title="As of Date is price as on date"></i>
                                            <input type="date" class="form-control form-control-sm"  name="pricedatefrom" id="pricedatefrom" value="<?php echo date("Y-m-d");?>">					  
                                        </div>
                                    </div>											


                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputState">Tax Method
                                            </label>
                                            <select id="taxmethod" onchange="gettaxrate('purchase_div');" class="form-control form-control-sm" name="taxmethod">
                                                <option value=''>Select Tax Method</option>
                                                <option value="1">Inclusive</option>
                                                <option value="0">Exclusive</option>
                                            </select>
                                        </div>



                                        <div class="form-group col-md-3">
                                            <label for="inputState">Tax Name</label>
                                            <select id="taxid" onchange="gettaxrate('purchase_div');"  class="form-control form-control-sm" name="taxid">
                                                <option value="0" selected>Open Taxrate</option>
                                                <?php 
                                                include("database/db_conection.php");//make connection here
                                                $sql = mysqli_query($dbcon, "SELECT id,taxtype,taxname,taxrate FROM taxmaster ");
                                                while ($row = $sql->fetch_assoc()){	
                                                $taxname=$row['taxname'];
                                                $taxrate=$row['taxrate'];
                                                $taxtype=$row['taxtype'];
                                                $taxid=$row['id'];
                                                echo '<option  data-name="'.$taxname.'" data-type="'.$taxtype.'" data-rate="'.$taxrate.'" value="'.$taxid.'" >'.$taxname.'</option>';
                                                }
                                                ?>
                                            </select>	
                                        </div>
                                    <div class="form-group" style="display:none;">
                                        <input type="text" name="taxtype" id="taxtype" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" readonly>
                                    </div> 
                                    <div class="form-group" style="display:none;">
                                        <input type="text" name="taxname" id="taxname" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" readonly>
                                    </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <!-- <i class="fa fa-rupee fonts" aria-hidden="true"></i> -->
                                            <label>Tax Rate %<span class="text-danger">*</span></label>
                                            <input type="text" name="taxrate" id="taxrate" class="form-control form-control-sm"   placeholder="Price Per Qty" autocomplete="off" readonly>
                                        </div>

                                        <div class="form-group col-md-3">									
                                            <label>Tax Amount&nbsp;<span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                                                                data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
                                                </span></label>
                                            <input type="text" name="taxamount" id="taxamount" class="form-control form-control-sm" autocomplete="off" placeholder="Tax Amount"  readonly />
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                            <label>Actual Product Price<span class="text-danger">*</span></label>
                                            <input type="text" name="product_price" id="product_price" class="form-control form-control-sm"   placeholder="Actual Product price" autocomplete="off" readonly />
                                        </div>

                                        <div class="form-group col-md-3">									
                                            <label>Final Price&nbsp;<span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                                                                 data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
                                                </span></label>
                                            <input type="text" name="final_price" id="final_price" class="form-control form-control-sm" autocomplete="off" placeholder="Price Including Tax"  readonly>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5>Stock Information</h5>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Stock Qty on Hand<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="stockinqty" id="stockinqty" placeholder="Current Stock in quantity" required autocomplete="off">
                                    </div>		 					
                                    <div class="form-group col-md-3" id="adjust_stock" style="display:none">
                                        <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                        <label>Adjust Stock</label>
                                        <input type="number" step="any" onkeypress="adjustprice('stock');"  onkeyup="adjustprice('stock');" id="adjuststk" name="adjuststk" class="form-control form-control-sm"   />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputState">As of Date</label>									
                                        <input type="date" class="form-control form-control-sm"  name="stockinqty_date" id="stockinqty_date" value="<?php echo date("Y-m-d");?>">		
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">									  
                                        <label>Low Stock Alert</label>
                                        <input type="text" class="form-control form-control-sm" name="lowstockalert" id="lowstockalert" placeholder="eg., 5  or 10 "  required class="form-control" autocomplete="off">
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Prefered Supplier Name</label>
                                        <select id="sales_vendorid" onchange="" class="form-control form-control-sm"  required name="sales_vendorid" autocomplete="off">
                                            <option selected>Open Vendors</option>
                                            <?php 
                                            include("database/db_conection.php");//make connection here
                                            $sql = mysqli_query($dbcon,"SELECT vendorid,concat(title,' ',supname) as vendorname FROM vendorprofile
																			ORDER BY id ASC
																			");
                                            while ($row = $sql->fetch_assoc()){	
                                                echo $vendorid=$row['vendorid'];
                                                echo $vendorname=$row['vendorname'];
                                                echo '<option onchange="'.$row[''].'" value="'.$vendorid.'" >'.$vendorname.'</option>';

                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Handler</label>
                                        <?php 
                                        //session_start();
                                        include("database/db_conection.php");
                                        $userid = $_SESSION['userid'];
                                        $sq = "select username from userprofile where id='$userid'";
                                        $result = mysqli_query($dbcon, $sq) or die(mysqli_error($dbcon));
                                        //$count = mysqli_num_rows($result);
                                        $rs = mysqli_fetch_assoc($result);
                                        ?>
                                        <input type="text" class="form-control form-control-sm" name="handler" id="handler" readonly class="form-control form-control-sm" value="<?php echo $rs['username']; ?>" required />

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5>Notes Information</h5>
                                    </div>
                                </div>




                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Add Notes</label>
                                        <textarea rows="2" class="form-control editor" id="notes" name="notes" placeholder="add product/price/stock related notes here"></textarea>
                                    </div> 
                                </div>
                                        </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" name="submitnewitem" id="submitnewitem" class="btn btn-primary">Save and Associate</button>
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
                        <h1 class="main-title float-left">Invoice</h1>
                        <ol class="breadcrumb float-right">
                            <li><a  href="index.php"><li class="breadcrumb-item">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
                    <div class="card mb-3">
                        <div class="card-header">
                            <!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
                            <h5><div class="text-muted font-light"><i class="fa fa-shopping-cart bigfonts" aria-hidden="true">
                                </i>&nbsp;New Invoice<span class="text-muted"></span></div></h5>

                            <div class="text-muted font-light">Create New Invoice</div>

                        </div>

                        <div class="card-body">

                            <form id="add_inv_form" autocomplete="off" action="#">

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Sales Person</label>
                                        <input type="text" class="form-control form-control-sm"  id="inv_owner" name="inv_owner" value="<?php echo $session_user; ?>" readonly class="form-control form-control-sm"  required />

                                    </div>
                                </div>



                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Company Name<span class="text-danger">*</span></label>
                                        <select id="inv_comp_code"  class="form-control form-control-sm" name="inv_comp_code">
                                            <!--option selected>--Select Company--</option-->
                                            <?php
                                            $sql = mysqli_query($dbcon,"SELECT * FROM comprofile");
                                            while ($row = $sql->fetch_assoc()){	
                                                $orgid=$row['orgid'];
                                                $orgname=$row['orgname'];
                                                echo '<option  value="'.$orgid.'" >'.$orgid.' '.$orgname.'</option>';

                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inv_customer"><span class="text-danger">Customer Name*</span></label>
                                        <select id="inv_customer" onchange="post_address(this.value);" class="form-control select2" name="inv_customer" required>
                                            <option selected>--Select Customer--</option>
                                            <?php
                                            $sql = mysqli_query($dbcon,"SELECT * FROM customerprofile");
                                            while ($row = $sql->fetch_assoc()){	
                                                $custid=$row['custid'];
                                                $custname=$row['custname'];
                                                echo '<option  value="'.$custid.'" >'.$custid ." ".$custname.'</option>';
                                            }
                                            ?>
                                        </select>
                                        <a href="#" data-target="#newcustomermodal" data-toggle="modal">
								<i class="fa fa-user-plus" aria-hidden="true"></i>Add New Customer</a><br>

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <!--label for="inputState">Order#</label-->
                                        <input type="text" placeholder="Sales Order No" hidden name="inv_so_code" id="inv_so_code" class="form-control form-control-sm"> 

                                    </div>
                                </div>

                                <div class="form-row" id="inv_code_row" style="display:none;">
                                    <div class="form-group col-md-8">
                                        <!--label for="inputState">Invoice#</label-->
                                        <input type="text" placeholder="Invoice No" hidden name="inv_code" id="inv_code" class="form-control form-control-sm"> 
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">									
                                        <label><span class="text-danger">Invoice Date*</span></label>
                                        <input type="date" class="form-control form-control-sm" id="inv_date" name="inv_date" value="<?php echo date("Y-m-d");?>" required autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-4">									
                                        <label>Due Date</label>
                                        <input type="date" class="form-control form-control-sm" id="inv_duedate" name="inv_duedate" value="<?php echo date("Y-m-d");?>" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-row">                                
                                    <div class="form-group col-md-4">											
                                        <label for="inputState">Payment Term</label>
                                        <select id="inv_payterm" onchange="ongroup(this)" class="form-control"  name="inv_payterm">
                                            <option selected>Open Payment Term</option>
                                        </select>



                                        <!-- <a href="#modal" data-target="#customModal" data-toggle="modal">
                                            <i class="fa fa-user-plus" aria-hidden="true"></i>Add New Pay Term</a><br> -->


                                    </div>




                                    <div class="form-group col-md-4">											
                                        <label for="inputState">Place of Supply</label>
                                        <?php           
                                        $req = $json_data['supplyPlace']['required'];
                                            if($req === true){
                                        echo '<select id="inv_deliveryat" required class="form-control form-control-sm" name="inv_deliveryat">';
                                    }else{
                                        echo '<select id="inv_deliveryat"  class="form-control form-control-sm" name="inv_deliveryat">';
                                    }
                                        ?>
                                            <option selected>--Open State--</option>
                                        </select>	
                                        <!--a href="addSupplierCodeMaster.php">add supplier type</a-->												
                                    </div>
                                </div>

                                <div class="form-row">  
                                    <div class="form-group col-md-8" >
                                        <label for="inputState"><span class="text-danger">Status*</span></label>
                                        <select class="form-control form-control-sm" required readonly name="inv_status"  id="inv_status">
                                            <option value="Created">Created</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Closed">Closed</option>
                                        </select>											
                                    </div>
                                </div>
                                
                                <!-- truck no and driver name --->
                                <div class="form-row">	
                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Truck no." readonly name="inv_truck_no" id="inv_truck_no" required class="form-control form-control-sm" > 
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Driver Name" readonly name="inv_driver_name" id="inv_driver_name" required class="form-control form-control-sm"  > 
                                    </div>
                                </div>



                                <!--div class="form-row">
<div class="form-group col-md-8">									
<label>Freight<span class="text-danger">*</span></label>
<select class="form-control form-control-sm" required name="inv_freight"  id="inv_freight">
<option value="to-pay">To-Pay</option>
<option value="paid">Paid</option>
</select>	
</div>
</div-->

                                <div class="form-row">								
                                    <h4 class="col-md-8 text-muted">Address Information &nbsp;</h4>
                                    <div class="col-md-8 float-right text-right">		
                                        <div class="btn-group" role="group">
                                            <!--a id="btnGroupDrop1" role="button" href="#" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"-->
                                            <a id="btnGroupDrop1" role="button" href="#" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Copy Address
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item" id="billing_to_shipping" >Billing to Shipping</a>
                                                <a class="dropdown-item" id="shipping_to_billing" >Shipping to Billing</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                 <?php           
                                $req = $json_data['shipping']['required'];
                                ?>
                                <div class="form-row">	
                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Billing Street"  name="inv_billing_street" id="inv_billing_street"  class="form-control form-control-sm" > 
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Shipping Street" name="inv_shipping_street" id="inv_shipping_street"  class="form-control form-control-sm"  > 
                                    </div>
                                </div>

                                            
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" required name="inv_billing_city" id="inv_billing_city"  placeholder=" Billing City" >
                                    </div>
                                    <div class="form-group col-md-4">
                                    <?php if($req === true){
                                        echo '<input type="text" placeholder="Shipping City" name="inv_shipping_city" id="inv_shipping_city"  class="form-control form-control-sm" required>';
                                    }else{
                                        echo '<input type="text" placeholder="Shipping City" name="inv_shipping_city" id="inv_shipping_city"  class="form-control form-control-sm">';
                                    } 
                                    ?>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <select id="inv_billing_state" class="form-control form-control-sm billstate" name="inv_billing_state">
                                            <span class="text-muted"><option value="">Billing State</option> </span>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">											
                                    <?php if($req === true){
                                        echo '<select id="inv_shipping_state" class="form-control form-control-sm" name="inv_shipping_state" required>';
                                    }else{
                                        echo '<select id="inv_shipping_state" class="form-control form-control-sm" name="inv_shipping_state">';
                                    }
                                    ?>
                                            <span class="text-muted">  <option selected value="">Shipping State</option> </span>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <select class="form-control form-control-sm" id="inv_billing_country"  name="inv_billing_country"> 
                                            <span class="text-muted">  
                                                <option value="" >Billing Country</option> </span>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <?php 
                                        if($req === true){
                                            echo'<select class="form-control form-control-sm" id="inv_shipping_country" required name="inv_shipping_country">'; 
                                        }else{
                                            echo'<select class="form-control form-control-sm" id="inv_shipping_country" name="inv_shipping_country">'; 
                                        } ?>
                                            <span class="text-muted">  
                                                <option value="" selected>Shipping Country</option> </span>

                                        </select>								  
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="inv_billing_zip" id="inv_billing_zip"   placeholder="Billing Zip/Postal Code" value="">
                                    </div>	


                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="inv_shipping_zip" id="inv_shipping_zip"   placeholder="Shipping Zip/Postal Code">
                                    </div>									  
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="inv_billing_phone" id="inv_billing_phone"   placeholder="Billing Phone" value="">
                                    </div>	

                                    <div class="form-group col-md-4">
                                    <?php 
                                        if($req === true){    
                                    echo '<input type="text" class="form-control form-control-sm" name="inv_shipping_phone"  id="inv_shipping_phone"  required placeholder="Shipping Phone">';
                                        }else{
                                        echo '<input type="text" class="form-control form-control-sm" name="inv_shipping_phone"  id="inv_shipping_phone" placeholder="Shipping Phone">';
                                    }
                                    ?>
                                    </div>									  
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="inv_billing_gstin" id="inv_billing_gstin"   placeholder="Billing GSTIN No" value="" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="inv_shipping_gstin" id="inv_shipping_gstin"  req placeholder="Shipping GSTIN No">
                                    </div>									  
                                </div>

                                <div class="form-row">	
                                    <div class="form-group col-md-8" id="show_errors" style="display:none;font-weight:bold;">

                                    </div>
                                </div>


                                <!--link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" /-->
                                <table  class="table table-hover small-text" id="tb">
                                    <tr class="tr-header">
                                        <th width="20%">Item Details</th>
                                        <!-- <th width="12%">HSN/SAC</th> -->
                                        <th width="11%">Qty</th>
                                        <th width="12%">Unit</th>
                                        <th width="15%"><i class="fa fa-rupee fonts" aria-hidden="true"></i>&nbsp;Rate</th>
                                        <th width="15%" > <i class="fa fa-rupee fonts" aria-hidden="true"></i>&nbsp;Amount</th>
                                        <!-- <th width="8%"> <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Discount</b></i></th>-->
                                        <th width="15%"> GST@%</th> 
                                        <!--th width="20%"> <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Total</b></i></th-->
                                        <th><a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Person">
                                            <span class="fa fa-plus-circle"></span></a></th>

                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="itemcode" class="form-control form-control-sm itemcode" onchange="sales_rowitem.set_itemrow(this,'sales');" id="item_select">
                                                <option value="" name="itemcode" selected>Item Code</option>
                                                <?php $qr  = "select * from salesitemaster2;";
                                                $exc = mysqli_query($dbcon,$qr)or die();
                                                while($r = mysqli_fetch_array($exc)){ ?>
                                                <option value="<?php echo $r['id']; ?>"><?php echo substr($r['brand'],0,5)."-".$r['itemcode']."-".$r['itemname']."-".substr($r['size'],0,5) ?></option>
                                                <?php
                                                                                    }
                                                ?>
                                            </select>
                                            <a href="#" data-target="#additemModal" data-toggle="modal">
								<i class="fa fa-user-plus" aria-hidden="true"></i>Add item </a><br>

                                        </td>
                                        <!--td><input type="text" name="description" placeholder="Item Name" class="form-control"></td
                                            <td><input type="text" name="itemcode" placeholder="Item Details" class="form-control"></td>-->
                                        <!-- <td><input id="hsncode" type="text" name="hsncode" placeholder="hsncode"    data-id="" class="form-control form-control-sm hsncode"></td> -->
                                        <td><input id="qty" type="text" name="qty" onkeypress="sales_rowitem.update_math_vals();sales_rowitem.stkalert(this);"   onkeyup="sales_rowitem.update_math_vals();sales_rowitem.stkalert(this);" placeholder="Qty" data-id="" class="form-control form-control-sm  qty"></td>                                        <td>
                                        <select class="form-control form-control-sm amount" id="uom"  onchange="sales_rowitem.update_math_vals();"; name="uom" style="line-height:1.5;">
                                            <option value="" selected>Open Unit</option>
                                            <?php 
                                            $sql = mysqli_query($dbcon, "SELECT * FROM uom ");
                                            while ($row = $sql->fetch_assoc()){	

                                                echo '<option  value="'.$row['code'].'">'.$row['description'].'</option>';
                                            }
                                            ?>
                                        </select>
                                        </td>
                                        <td><input id="price" type="text" name="price" placeholder="Rate/Qty" onkeypress="sales_rowitem.update_math_vals();"   onkeyup="sales_rowitem.update_math_vals();"   data-id="" class="form-control form-control-sm  price"></td>
                                        <td><input id="amount" type="text" name="amount" placeholder="qtyXprice" data-id="" class="form-control form-control-sm amount"></td>
                                        <!-- <td><input type="text" name="discount[]" class="form-control discount" placeholder="Itm wise Disc"></td> -->
                                        <td>             
                                                  <select class="form-control form-control-sm  amount" id="taxname"  onchange="sales_rowitem.update_math_vals();"; name="taxname" style="line-height:1.5;">
                                            <option data-type="single" value="0" selected>Open Taxrate</option>
                                            <?php 

                                            $sql = mysqli_query($dbcon, "SELECT id,taxname,taxrate,taxtype FROM taxmaster ");
                                            while ($row = $sql->fetch_assoc()){	
                                                $taxname=$row['taxname'];
                                                $taxrate=$row['taxrate'];
                                                $taxtype=$row['taxtype'];
                                                $taxid=$row['id'];

                                                echo '<option data-type="'.$taxtype.'" data-rate="'.$taxrate.'" value="'.$taxid.'" >'.$taxname.'</option>';
                                            }
                                            ?>
                                            </select></td>
                                        <!--td><input type="text" name="total[]" class="form-control total" data-id="" placeholder="Item Total"></td-->
                                        <td><a href='javascript:void(0);'  class='remove'><span class='fa fa-trash'></span><b></b></a></td>
                                    </tr>
                                </table>
                                <!---subtotal , dicount , tax etc-->
                                <hr>
                                <div class="row">
                                    <div class="col-md-7"></div>
                                    <div class="col-md-5">

                                        <div class="col-md-12">
                                            <div class="row"><div class="col-md-8"><p class="h6">Sub Total: </p></div>
                                                <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger" id="posubtotal">--</span></div>	
                                            </div>

                                        </div>
                                        <div class="col-md-12" id="discountcol">
                                            <div class="row">
                                                <div class="col-md-8">

                                                    <div id="ember1600" class="input-group ember-view col-md-7" style="padding-left:0px;">
                                                        <input type="text" class="form-control text-right ember-text-field text-right ember-view" id="podiscount" style=".375rem .75rem;" onkeypress="sales_rowitem.update_math_vals();"   onkeyup="sales_rowitem.update_math_vals();" placeholder="Discount"> 
                                                        <!----> <div class="input-group-btn" style="width:20%;"><button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle discount-btn" data-meth="flat" id="discoutTypeTextbutton">
                                                        <span id="discoutTypeText">₹</span>  <span class="caret"></span></button> <ul class="dropdown-menu pull-right text-center" style="min-width:4rem;" id="discoutType">
                                                        <li onclick="chgdiscount_tupe(this);" data-meth="percent"><a data-ember-action="" data-ember-action-1602="1602"  >%</a></li> 
                                                        <li onclick="chgdiscount_tupe(this);"  data-meth="flat"><a data-ember-action="" data-ember-action-1603="1603" >₹</a></li></ul></div></div>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <span style="font-weight:600;"  class="lead text-danger" id="podiscountText">--</span>
                                                </div>	

                                            </div> 
                                        </div>
                                        <div id="taxdiv"></div>
                                        <br/>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-8"><p class="h6">Grand Total(Round off): </p></div>
                                                <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger" id="pograndtotal">--</span></div>	
                                            </div>

                                        </div>     
                                        <div class="col-md-12">										
                                            <div class="row">
                                                <div class="col-md-8">												
                                                    <div class="form-group col-8" style="padding-left:0px;">



                                                        <input class="form-control" onkeypress="sales_rowitem.update_math_vals();"   onkeyup="sales_rowitem.update_math_vals();" id="poadjustmentval" type="number" step="any" placeholder="Adjustment ">
                                                        <i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                           data-trigger="focus" data-placement="top" title="Add any other +ve or -ve charges that need to be appliedto adjust the total amount of the transaction Eg. +10 or -10."></i>
                                                    </div>

                                                </div>

                                                <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger" id="poadjustment">--</span></div>	


                                            </div>

                                        </div>  
                                        <div class="col-md-12">
                                            <div class="row"><div class="col-md-8"><p class="h6">Balance Due: </p></div>
                                                <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger" id="pobaltotal">--</span></div>	
                                            </div>

                                        </div>


                                    </div>
                                </div>
                                <hr>

                                <br>

                                <div class="form-row col-md-12">
                                    <!-- <div class="form-group col-md-8">
                                        <textarea rows="2" class="form-control" name="inv_tc"  id="inv_tc" required placeholder="add Invoice Terms & Conditions "></textarea>

                                    </div> -->

                                    <div class="form-row col-md-12">
                                        <div class="form-group col-md-8">
                                            <textarea rows="2" class="form-control" name="inv_notes"  id="inv_notes"  placeholder="add Invoice notes[optional] "></textarea>
                                        </div>
                                    </div>




                                    <div class="form-row">
                                        <div class="form-group text-right m-b-0">
                                            &nbsp;&nbsp;&nbsp;&nbsp; <button class="btn btn-primary" type="submit" >
                                            Submit
                                            </button>
                                            <button type="reset" name="cancel" class="btn btn-secondary m-l-5" onclick="window.history.back();">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>




                                </div>

                            </form>
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
    <style>
        #discoutType li {

            cursor: pointer;
        }
        #discoutType li:hover {

            background-color:#007BFF;
            color: #ffffff;
        }
    </style>

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
        var page_action = "<?php if(isset($_GET['action'])){ echo $_GET['action']; } ?>";
        var page_table = "<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>";
        var page_inv_code = "<?php if(isset($_GET['inv_code'])){ echo $_GET['inv_code']; } ?>";
        var page_so_code = "<?php if(isset($_GET['so_code'])){ echo $_GET['so_code']; } ?>";
        var page_est_code = "<?php if(isset($_GET['est_code'])){ echo $_GET['est_code']; } ?>";

        var rowarray = [];

        $(function(){


            ////set select options
            var user_params = [];
            var comp_params = [];
            var vendor_params = [];
            var paymentterm_params = [];
            var shippingvia_params = [];
            var loction_params = [];

            comp_params[0]={"primaryflag":"1"}; 

            $('#inv_owner').val('<?php echo $session_user; ?>');
            //                    $('#inv_tc').val(<?php 
            //                        $sql = mysqli_query($dbcon, "SELECT inv_tc from invoices order by id desc");
            //                        while ($row = $sql->fetch_assoc()){	
            //                            $inv_tc=$row['inv_tc'];
            //
            //                            if($inv_tc==''||$inv_tc==null){
            //                                echo "''";
            //                            }else{
            //                                echo "'".$inv_tc."'";
            //
            //                            }
            //                        }?>);
            // Page.load_select_options('inv_comp_code',comp_params,'comprofile','Company Code','orgid','orgname');
            Page.load_select_options('inv_vendor',vendor_params,'vendorprofile','Vendor Code','vendorid','supname');
            Page.load_select_options('inv_shippingvia',shippingvia_params,'transportmaster','Shipping Via','transname',null);  
            Page.load_select_options('inv_payterm',paymentterm_params,'paymentterm','Payment  Term','noofdays','paymentterm');
            Page.load_select_options('inv_deliveryat',loction_params,'location','Deivery at','locname',null);
            Page.load_select_options('inv_deliveryat',loction_params,'state','Place of Supply','code','description',3);
            Page.load_select_options('inv_billing_state',loction_params,'state','Billing State','code','description',3);           
             Page.load_select_options('inv_shipping_state',loction_params,'state','Shipping State','code','description',3);
            Page.load_select_options('inv_shipping_country',loction_params,'country','Shipping Country','code','description',3);
            Page.load_select_options('inv_billing_country',loction_params,'country','Billing Country','code','description',3);

            $('#addMore').on('click', function() {
                var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                data.attr("id",);
                data.find("input").val('');
            });

            $(document).on('click', '.remove', function() {
                var trIndex = $(this).closest("tr").index();
                if(trIndex>1) {
                    $(this).closest("tr").remove();
                    sales_rowitem.update_math_vals();
                } else {
                    alert("Sorry!! Can't remove first row!");
                }
            });

            //addGroupnames_ajax.php
            $('#submitpaymentterm').click(function(){
                var description = $('#adddescription').val();
                var paymentterm = $('#addpaymentterm').val();
                //alert(groupname+description);
                $.ajax ({
                    url: 'addPaymentTermModal.php',
                    type: 'post',
                    data: {
                        paymentterm:paymentterm,
                        description:description
                    },
                    //dataType: 'json',
                    success:function(response){
                        if(response!=0 || response!=""){
                            var new_option ="<option value="+response+">"+response+"</option>";
                            $('#paymentterm').append(new_option);
                            $('#customModal').modal('toggle');
                        }else{
                            alert('Error in inserting new Payment Term,try another Payment Term');
                        }
                    }

                });

            });

            $('#billing_to_shipping').click(function(){
                $('#inv_shipping_street').val($('#inv_billing_street').val());
                $('#inv_shipping_city').val($('#inv_billing_city').val());
                $('#inv_shipping_state').val($('#inv_billing_state').val());
                $('#inv_shipping_country').val($('#inv_billing_country').val());
                $('#inv_shipping_zip').val($('#inv_billing_zip').val());
                $('#inv_shipping_phone').val($('#inv_billing_phone').val());
                $('#inv_shipping_gstin').val($('#inv_billing_gstin').val());
            });


            $('#shipping_to_billing').click(function(){
                $('#inv_billing_street').val($('#inv_shipping_street').val());
                $('#inv_billing_city').val($('#inv_shipping_city').val());
                $('#inv_billing_state').val($('#inv_shipping_state').val());
                $('#inv_billing_country').val($('#inv_shipping_country').val());
                $('#inv_billing_zip').val($('#inv_shipping_zip').val());
                $('#inv_billing_phone').val($('#inv_shipping_phone').val());
                $('#inv_billing_gstin').val($('#inv_shipping_gstin').val());
            });

            //code updated by jayaprakash -- 08042019
            $('#inv_code_row').show();


            if(page_action!=""){
                if(page_inv_code!=""&&page_action=="edit"){
                    var edit_data = Page.get_edit_vals(page_inv_code,page_table,"inv_code");
                    set_form_data(edit_data);
                    console.log(edit_data);
                    $('#inv_code_row #inv_code').val(edit_data.inv_code);
                }else if(page_so_code!=""&&page_action=="add"){
                    var edit_data2 = Page.get_edit_vals(page_so_code,"salesorders","so_code");
                    $('#inv_so_code').val(edit_data2.so_code);
                    $('#inv_customer').val(edit_data2.so_customer);
                    $('#inv_payterm').val(edit_data2.so_payterm);
                    $('#inv_comp_code').val(edit_data2.so_comp_code);
                    $('#inv_deliveryat').val(edit_data2.so_deliveryat);
                    post_address(edit_data2.so_customer);
                    set_math_vals(JSON.parse(edit_data2.so_items));
                }else if(page_est_code!=""&&page_action=="add"){
                    var edit_data3 = Page.get_edit_vals(page_est_code,"estimates","est_code");
                    $('#inv_so_code').val(edit_data3.est_code);
                    $('#inv_customer').val(edit_data3.est_customer);
                    $('#inv_comp_code').val(edit_data3.est_comp_code);
                    post_address(edit_data3.est_customer);
                    set_math_vals(JSON.parse(edit_data3.est_items));
                }
            }


            function set_form_data(data){
                // console.log(data.inv_owner);
                //// $('#inv_owner').val(data.inv_owner);
                $.each(data, function(index, value) {

                    if(index=="id"||index=="inv_code"){


                    }else if(index=="inv_items"){
                        set_math_vals(JSON.parse(value));

                    }else{

                        $('#'+index).val(value);
                    }

                }); 


            }
        });      

        function post_address(custid){
            var vals = Page.get_edit_vals(custid,"customerprofile","custid");
            $('#inv_billing_street').val(vals.address);
            $('#inv_billing_city').val(vals.city);
            $('#inv_billing_state').val(vals.state);
            $('#inv_billing_country').val(vals.country);
            $('#inv_billing_zip').val(vals.zip);
            $('#inv_billing_phone').val(vals.mobile);
            $('#inv_billing_gstin').val(vals.gstin); 

        }


        function set_math_vals(inv_items_json){
           // console.log(inv_items_json);
            var itemrowCount = inv_items_json.length;
            var rowCount = $('#tb tr').length;
            var totalamt = 0;

            for(r=0;r<itemrowCount;r++){

                if(r<itemrowCount-1){
                    var dataRow = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                }

                $('#tb tr').eq(r+1).find('#item_select').val(inv_items_json[r].itemcode);
                $('#tb tr').eq(r+1).find('#hsncode').val(inv_items_json[r].hsncode);
                $('#tb tr').eq(r+1).find('#price').val(inv_items_json[r].rwprice);
                $('#tb tr').eq(r+1).find('#price').attr('data-price',inv_items_json[r].tax_method==1?inv_items_json[r].rwprice_org:inv_items_json[r].rwprice);
                $('#tb tr').eq(r+1).find('#qty').val(inv_items_json[r].rwqty);
                rowarray[r] = inv_items_json[r].rwqty

                $('#tb tr').eq(r+1).find('#taxname').val(inv_items_json[r].tax_id);
                $('#tb tr').eq(r+1).find('#taxname').attr('data-taxmethod',inv_items_json[r].tax_method);
                $('#tb tr').eq(r+1).find('#uom').val(inv_items_json[r].uom);
                totalamt+=$('#tb tr').eq(r+1).find('#price').val()*$('#tb tr').eq(r+1).find('#qty').val();

            }


            if(itemrowCount>0){
                var podiscount = inv_items_json[0].podiscount;
                var poadjustmentval = inv_items_json[0].poadjustmentval;    
                var podiscount_method = inv_items_json[0].podiscount_method; 
                if(podiscount_method=='flat'){
                    $('#podiscount').val(podiscount);
                    $('#discoutTypeTextbutton #discoutTypeText').html('₹');
                    $('#discoutTypeTextbutton').attr('data-meth','flat');
                }else{
                    var tt = (eval(podiscount/totalamt)*100).toFixed(2);
                    $('#podiscount').val(tt);
                    $('#discoutTypeTextbutton #discoutTypeText').html('%');
                    $('#discoutTypeTextbutton').attr('data-meth','percent');
                }
                $('#poadjustmentval').val(poadjustmentval);

            }

            sales_rowitem.update_math_vals();
        }


        function chgdiscount_tupe(x){
            var discountMeth = $(x).attr('data-meth');
            if(discountMeth=="flat"){
                $('#discoutTypeTextbutton #discoutTypeText').html('₹');
                $('#discoutTypeTextbutton').attr('data-meth','flat');
            }else{
                $('#discoutTypeTextbutton #discoutTypeText').html('%');
                $('#discoutTypeTextbutton').attr('data-meth','percent');

            }
            sales_rowitem.update_math_vals();

        }

        $("form#add_inv_form").submit(function(e){
            e.preventDefault();

            var rowCount = $('#tb tr').length;
            var inv_items = [];
            var changed_row_qty = false
            var  changed_item_select =[];

            for(i=1;i<rowCount;i++){ 
                var item_select = $('#tb tr').eq(i).find('#item_select').val();
                var item_details = $('#tb tr').eq(i).find('#item_select option:selected').text();
                var hsncode = $('#tb tr').eq(i).find('#hsncode').val();
                var rwqty = $('#tb tr').eq(i).find('#qty').val();

                //code edited by jp for INV to invent report
               // console.log("current "+rwqty+" past"+rowarray[i-1])
               if(rwqty != rowarray[i-1])
                 {
                     var item_code_row = {
                        itemcode :  item_select,
                        rwqty   : rowarray[i-1]
                      } ;
                      changed_item_select[i-1] = item_code_row
                      changed_row_qty = true
                 }

                var tax_id = $('#tb tr').eq(i).find('#taxname').val();
                var tax_val = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-rate');
                var tax_method = $('#tb tr').eq(i).find('#taxname').attr('data-taxmethod');
                var tax_type = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-type');
                var rwprice_org = $('#tb tr').eq(i).find('#price').attr('data-price');
                var rwprice = $('#tb tr').eq(i).find('#price').val();
                var rwamt = $('#tb tr').eq(i).find('#amount').val();
                var uom = $('#tb tr').eq(i).find('#uom').val();
                var poadjustmentval = $('#poadjustmentval').val();
                var podiscount_method = $('#discoutTypeTextbutton').attr('data-meth');
                var podiscount_value = $('#podiscount').val();
                var podiscount_value = $('#podiscount').val();
                var podiscount = 0;
                var subtotal = $('#posubtotal').text();
                subtotal = eval(subtotal).toFixed(2)
                if(podiscount_value!='')
                {
                    if(podiscount_method=="flat"){
                        podiscount = podiscount_value;
                    }else{
                        podiscount = subtotal*(podiscount_value/100);

                    }
                }

                var inv_items_ele = {
                    itemdetails : item_details,
                    itemcode : item_select,
                    hsncode : hsncode,
                    rwqty : rwqty,
                    tax_val : tax_val,
                    tax_id : tax_id,
                    tax_type : tax_type,
                    tax_method : tax_method,
                    rwprice : rwprice,
                    rwprice_org : rwprice_org,
                    rwamt : rwamt,
                    podiscount : podiscount,
                    poadjustmentval:poadjustmentval,
                    podiscount_method:podiscount_method,
                    uom : uom
                };

                inv_items[i-1]=inv_items_ele;

            }

            var $form = $("#add_inv_form");
            var data = getFormData($form);
            function getFormData($form){
                var unindexed_array = $form.serializeArray();
                var indexed_array = {};

                $.map(unindexed_array, function(n, i){
                    if(n['name']=="itemcode"||n['name']=="inv_code"||n['name']=="hsncode"||n['name']=="qty"||n['name']=="unit"||n['name']=="price"||n['name']=="amount"||n['name']=="taxname"||n['name']=="uom"){

                    }else{
                        indexed_array[n['name']] = n['value'];
                    }
                });

                return indexed_array;
            }

            var today = new Date();
            var yy = today.getFullYear().toString();
            var mm = today.getMonth() + 1;

            mm = mm < 10 ? '0' + mm : '' + mm;
            //  console.log(mm+""+yy.slice(-2)) 
            var dateValue = mm+"/"+yy
            data.table = "invoices";
            data.inv_items = JSON.stringify(inv_items);
            data.inv_value = $('#pobaltotal').text(); 
            data.inv_balance_amt = $('#pobaltotal').text(); 
            data.inv_payment_status = "Unpaid"; 
            data.inv_type = "Credit Invoice"; 
            data.inv_payterm_desc =  $('#inv_payterm option:selected').attr('data-val');
            //console.log(data,"jp")
            var newinvcode_val = $('#inv_code_row #inv_code').val();
            var inv_code_changed = "";
            var inv_action = "";
            if(page_action=='edit'){
                if(newinvcode_val!=page_inv_code){
                inv_code_changed = newinvcode_val;
                inv_action = 'add';
                }else{
                    inv_code_changed = page_inv_code;
                    inv_action = 'edit';
                }

            }else{
                inv_code_changed = newinvcode_val;
                inv_action = "add";
            }

            if (sales_rowitem.sales_entry){

                $.ajax ({
                    url: 'workers/setters/save_inv.php',
                    type: 'post',
                    data: {
                        array : JSON.stringify(data),
                        inv_code    : inv_code_changed,
                        action  :   inv_action,
                        table:"invoices",                    
                        changed_row_qty     : changed_row_qty,
                        prefix      :   dateValue,
                        changed_item_select : JSON.stringify(changed_item_select)
                    },
                    dataType: 'json',
                    success:function(response){
                        location.href="listInvoices.php";
                    }


                });
            }else{
                return false;
            }

        });


            $('#newcustomer').click(function(e){
                e.preventDefault();
                var $form = $("#new_customer_form");
                 var data = getFormData($form);
                var unidexed_array = $form.serializeArray();

            function getFormData($form){
                var unindexed_array = $form.serializeArray();
                var indexed_array = {};

                $.map(unindexed_array, function(n, i){
                        indexed_array[n['name']] = n['value'];
                });

                return indexed_array;
            }
                
                //console.log(unidexed_array);

                $.ajax ({
                    url: 'workers/setters/add_new_customer.php',
                    type: 'post',
                    data: {
                          form_data:data
                    },
                    //dataType: 'json',
                    success:function(response){
                        console.log(response);

                        if(typeof(response) === "string"){
                        var res_data = JSON.parse(response);
                        }else{
                         var res_data = response;
                        }
                        if(res_data.status){
                             console.log(res_data.data);
                            var new_option ='<option selected value="'+res_data.value+'">'+res_data.label+'</option>';
                            $('#inv_customer').append(new_option);
                            post_address(res_data.value);
                             $('#newcustomermodal').modal("hide");
                             $('.modal-backdrop').remove();
                             $(document.body).removeClass("modal-open");



                        }else{
                            alert(res_data.error)
                        }
                        
                    }

                });
            });
                 
    </script>	
    <script>
        var page_action = "<?php if(isset($_GET['action'])){ echo $_GET['action']; } ?>";
        var page_table = "<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>";
        var page_item_code = "<?php if(isset($_GET['itemcode'])){ echo $_GET['itemcode']; } ?>";
        var page_sales_priceperqty = 0;
        var page_priceperqty = 0;
        var page_stockinqty = 0;


        $('document').ready(function(){	
            console.log("jp")
            
            if(page_action=="edit"){
                var edit_data = Page.get_edit_vals(page_item_code,page_table,"itemcode");
                page_sales_priceperqty = edit_data.sales_priceperqty;
                page_priceperqty = edit_data.priceperqty;
                page_stockinqty = edit_data.stockinqty;
                set_form_data(edit_data);
                $('#adjust_price').show();
                $('#adjust_cost').show();
                $('#adjust_stock').show();
                $('#sales_priceperqty').attr('readonly',true);
                $('#sales_uom').attr('readonly',true);
                $('#priceperqty').attr('readonly',true);
                $('#uom').attr('readonly',true);
                $('#stockinqty').attr('readonly',true);
            }
            function set_form_data(data){
                $.each(data, function(index, value) {

                    if(index=="id"||index=="po_code"){


                    }else{
                        $('#'+index).val(value);
                    }

                }); 


            }

            gettaxrate('sales_div');
            gettaxrate('purchase_div');

        });
        function gettaxrate(id){
            var ele = document.getElementById(id);
            var taxrate = "";
            var taxmethod = "";
            var price   = "";
            var taxtype = "";
            var taxname = "";
            if(id=="sales_div"){
                taxid = $('#sales_taxid',ele).val();
                taxtype = $('#sales_taxid option:selected').attr('data-type');
                taxrate = $('#sales_taxid option:selected').attr('data-rate');
                taxname = $('#sales_taxid option:selected').attr('data-name');
                taxmethod = $('#sales_taxmethod',ele).val();
                price   = $('#sales_priceperqty',ele).val();
            }else{
                taxid = $('#taxid',ele).val();
                taxtype = $('#taxid option:selected').attr('data-type');
                taxrate = $('#taxid option:selected').attr('data-rate');
                taxname = $('#taxid option:selected').attr('data-name');
                taxmethod = $('#taxmethod',ele).val();
                price   = $('#priceperqty',ele).val();
            }
            var product_price = 0;
            if(taxrate == "" || taxrate == null){
                taxrate = 0;
            }
            if(price == "" || price == null ){
                price = 0;
            }

            calcPrice   = (price - ( price * taxrate / 100 )).toFixed(2);
            percentagedval = (parseFloat(price)-parseFloat(calcPrice)).toFixed(2);

            if(taxmethod=='1'){
                product_price = price-percentagedval;

            }else{
                product_price = price;
                price = parseFloat(price)+parseFloat(percentagedval);
            }
                $('#itemcost',ele).val(product_price);

            if(id=="sales_div"){
                $('#sales_taxrate',ele).val(taxrate);
                $('#sales_taxtype',ele).val(taxtype);
                $('#sales_taxname',ele).val(taxname);
                $('#sales_taxamount',ele).val(percentagedval);

                $('#sales_final_price',ele).val(price);
                $('#sales_product_price',ele).val(product_price);
            }else{
                $('#taxrate',ele).val(taxrate);
                $('#taxtype',ele).val(taxtype);
                $('#taxname',ele).val(taxname);
                $('#taxamount',ele).val(percentagedval);

                $('#final_price',ele).val(price);
                $('#product_price',ele).val(product_price);
            }

        }

        function adjustprice(type){
            if(type=="sales"){
                $('#sales_priceperqty').val(page_sales_priceperqty);
                var adj = $('#sales_adjpriceperqty').val();
                var pri = $('#sales_priceperqty').val();
                var fin = +adj + +pri;
                $('#sales_priceperqty').val(fin);
                gettaxrate('sales_div');
                //  $('#final_price').val(fin);
            }else if(type=="purchase"){
                $('#priceperqty').val(page_priceperqty);
                var adj = $('#adjpriceperqty').val();
                var pri = $('#priceperqty').val();
                var fin = +adj + +pri;
                $('#priceperqty').val(fin);
                gettaxrate('purchase_div');
            }else{
                $('#stockinqty').val(page_stockinqty);
                var adjstk = $('#adjuststk').val();
                var stk = $('#stockinqty').val();
                var fin = +adjstk + +stk;
                $('#stockinqty').val(fin);
            }
        }

        $("#submitnewitem").click(function(e){
            e.preventDefault();
            var $form = $("#salesitemform");
            var data = getFormData($form);
            console.log(data);
            console.log(page_item_code);
            console.log(page_action);
            function getFormData($form){
                var unindexed_array = $form.serializeArray();
                var indexed_array = {};

                $.map(unindexed_array, function(n, i){
                    if(n['name']=="id"||n['name']=="product_price"||n['name']=="final_price"||n['name']=="sales_product_price"||n['name']=="sales_final_price"||n['name']=="sales_adjpriceperqty"||n['name']=="adjpriceperqty"||n['name']=="adjuststk"){

                    }else{
                        indexed_array[n['name']] = n['value'];
                    }
                });

                return indexed_array;
            }
            var adjstk = $('#adjuststk').val();

            $.ajax ({
                url: 'workers/setters/save_salesitem.php',
                type: 'post',
                data: {array : JSON.stringify(data),itemcode:page_item_code,action:page_action?page_action:"add",table:"salesitemaster2",adjstk : adjstk },
                dataType: 'json',
                success:function(response){
                    if(typeof(response) === "string"){
                        var res_data = JSON.parse(response);
                        }else{
                         var res_data = response;
                        }
                        console.log(res_data,res_data.data);
                        if(res_data.status){
                        var new_option ="<option selected>"+res_data.data+"</option>";
                          $('#item_select').append(new_option);
                          sales_rowitem.set_itemrow('#item_select','sales');
                          $('#additemModal').modal("hide");
                          $('.modal-backdrop').remove();
                          $(document.body).removeClass("modal-open");
                    }else{
                        alert(res_data.error)
                    }
                }
            });

        });

    </script>


    <script>

        $('document').ready(function(){
            $('#submittax').click(function(){
                var taxname=$('#addtaxname').val();
                var description=$('#adddescription').val();//same
                var taxtype=$('#addtaxtype').val();
                var taxrate=$('#addtaxrate').val();
                //alert(groupname+description);
                $.ajax ({
                    url: 'addTaxModal.php',
                    type: 'post',
                    data: {
                        taxname:taxname,
                        description:description,
                        taxtype:taxtype,
                        taxrate:taxrate
                    },
                    //dataType: 'json',
                    success:function(response){
                        if(response!=0 || response!=""){
                            var new_option ="<option>"+response+"</option>";
                            $('#taxname').append(new_option);
                            $('#customModal7').modal('toggle');
                            window.location.reload(true);

                        }else{
                            alert('Error in inserting taxname type,try another one');
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
</body>
</ht