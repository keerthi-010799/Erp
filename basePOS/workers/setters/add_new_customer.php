<?php
include("../../database/db_conection.php");//make connection here

$custnameFound = '';
$return=array();
if(isset($_POST['form_data']))
{
//here getting result from the post array after submitting the form.
$form_data = $_POST['form_data']; 
$custname 	 =	$form_data['custname'];	
$title  = $form_data['title'];
$custype =	$form_data['custype'];	    
$blocation 	 =	$form_data['blocation'];	
$address  =	$form_data['address'];		
$city 	 =	$form_data['city'];	
$country  =	$form_data['country'];		
$state  =	$form_data['state'];		
$zip  =	$form_data['zip'];		
$workphone 	 =	$form_data['workphone'];	
$mobile 	 =	$form_data['mobile'];	
$email 	 =	$form_data['email'];	
$web 	 =	$form_data['web'];	
$gstin 	 =	$form_data['gstin'];	
$custid ="";
$prefix = "CUSTID-";
 $sql="SELECT MAX(id) as latest_id FROM customerprofile ORDER BY id DESC";
	if($result = mysqli_query($dbcon,$sql)){
		$row   = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$maxid = $row['latest_id'];
			$maxid+=1;
			
			$custid = $prefix.$maxid;
		}else{
			$maxid = 0;
			$maxid+=1;
			$custid = $prefix.$maxid;
		}
	}	
	 
	$check_custname_query="select custname from customerprofile WHERE custname='$custname'";
    $run_query=mysqli_query($dbcon,$check_custname_query);
	if(mysqli_num_rows($run_query)>0)
    {
        $custnameFound = "Customername: $custname is already exist, Please try another one!";
        //exit;
        $return['status'] = false;
        $return['error'] = $custnameFound;
    }
    else{
	$insert_customerProfile="INSERT INTO customerprofile(custid,title,custname,custype,blocation,address,city,state,country,zip,workphone,mobile,email,web,gstin) 
	VALUES('$custid','$title','$custname','$custype','$blocation','$address','$city','$state','$country','$zip','$workphone','$mobile','$email','$web','$gstin')";

	//echo "$insert_customerProfile";
	
	if(mysqli_query($dbcon,$insert_customerProfile))
	{
   
        $return['status'] = true;
        $return['data'] = $custname;
        //echo "<script>alert('Customer Profile creation Successful ')</script>";
		//header("location:listCustomerProfile.php");
    } else { die('Error: ' . mysqli_error($dbcon));
		$return['status'] = false;
        $return['error'] = "Customer profile not created";
	}
}
}
echo json_encode($return);
?>