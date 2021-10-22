
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $itemcode=$_POST['itemcode'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $table2 = "salesitemlognew";
    $return=array();
    if ($itemcode=="") {  
        $itemcode = get_id($dbcon,$table,"");
    }
    
    if($action=="add"){
        $sql2 = "INSERT INTO ".$table." (itemcode) VALUES ('$itemcode')";
            if (mysqli_query($dbcon,$sql2)) {
                $return = update_query($dbcon,$array,$itemcode,$table,"itemcode");
                $obj = json_decode($array,true);
                $sql4 = "INSERT INTO salesitemlognew (itemcode,itemname,qtyonhand,uom,adjustedon,handler,notes) VALUES ('$itemcode','".$obj['itemname']."','".$obj['stockinqty']."','".$obj['sales_uom']."','".$obj['stockinqty_date']."','".$obj['handler']."','".$obj['notes']."')";
                if(mysqli_query($dbcon,$sql4)){
                    $return['status']=true;
                    $return['data'] = $itemcode."-".substr($obj['brand'],0,5)."-".$obj['itemname']."-".substr($obj['size'],0,5);
                }else{
                    $return['status']=false;
                    $return['error']=mysqli_error($dbcon);
                }
            }else{
                $return['status']=false;
                $return['error']=mysqli_error($dbcon);
            }
    }else{
        $return = update_query($dbcon,$array,$itemcode,$table,"itemcode");
        $obj = json_decode($array,true);
        $adjstk=$_POST['adjstk'];
        $sql3 = "INSERT INTO salesitemlognew (itemcode,itemname,qtyonhand,qtyadjusted,
        uom,adjustedon,handler,notes) VALUES ('$itemcode','".$obj['itemname']."','".$obj['stockinqty']."','".$adjstk."','".$obj['sales_uom']."','".$obj['stockinqty_date']."','".$obj['handler']."','".$obj['notes']."')";
            if (mysqli_query($dbcon,$sql3) ) {  
                $return['status']=true;
                $return['data'] ="refddata";
            }
            else{
                $return['status']=false;
                $return['error']=mysqli_error($dbcon);
            }
    }

}
echo json_encode($return);
?>
