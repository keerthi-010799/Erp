
<?php

if (isset($_POST['message'])) {

$agent= 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36';
    
$message = urlencode($_POST['message']);

/*echo $url = "http://textsms.eschoolserp.com/API/WebSMS/Http/v1.0a/index.php?username=sssbg&password=sssbg&sender=SSSBGS&to=9791129332,9677573737&message=".$message."&reqid=1";*/
    
/*$url = "http://textsms.eschoolserp.com/API/WebSMS/Http/v1.0a/index.php?username=dhirajagro&password=dhirajagro&sender=DHIRAJ&to=9791129332,9677573737,9010389944,9840820976&message=".$message."&reqid=1";
*/

//$url = "http://textsms.eschoolserp.com/API/WebSMS/Http/v1.0a/index.php?username=adhiyaman&adhiyaman=welcome&sender=AMSEYR&to=9791129332&message=".$message."&reqid=1";

    
//setting the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
// Following line is compulsary to add as it is:
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
$data = curl_exec($ch);
 curl_close($ch);


}

?>
