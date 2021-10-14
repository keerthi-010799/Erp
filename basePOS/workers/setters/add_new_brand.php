<?php
include("../../database/db_conection.php");//make connection here

if(isset($_POST['brand']))
{
	$return=array();
    $brand=$_POST['brand'];//same
	
    $check_suptype_query="select brand from brandmaster WHERE brand='$brand'";
    $run_query=mysqli_query($dbcon,$check_suptype_query);
	if(mysqli_num_rows($run_query)>0)
    {
		$return['status'] = false;
        $return['error'] = 'Error in inserting new brand, try another unique brand';
    }else{  
	 $insert_brand="insert into brandmaster(`brand`,`description`) 
	VALUES ('$brand','$brand')";													    
	
	if(mysqli_query($dbcon,$insert_brand))
	{
        $return['status'] = true;
        $return['data']=$brand;
    } else {
		$return['error'] = 'Error in creating brand';
	}
 }
}
echo json_encode($return);
?>