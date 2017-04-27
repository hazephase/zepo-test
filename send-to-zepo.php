<?php 

error_reporting( E_ALL );
ini_set( 'display_errors', 'On' );
require_once "../class-wc-api-client.php";
$consumer_key = 'ck_fcedaba8f0fcb0fb4ae4f1211a75da72'; // Add your own Consumer Key here
$consumer_secret = 'cs_9914968ae9adafd3741c818bf6d704c7'; // Add your own Consumer Secret here
$store_url = 'http://localhost/demo/'; // Add the home URL to the store you want to connect to here
// Initialize the class
$wc_api = new WC_API_Client( $consumer_key, $consumer_secret, $store_url );

print_r( $wc_api->get_orders( array( 'status' => 'completed' ) ) );
 


	// STORE REQUIRED DATA IN ARRAY

	$arr = array();

	$arr['pickup_pincode'] 	= '400071';

	$arr['delivery_pincode'] = '$postcode';

	$arr['order_number'] = '111110001';

	 $arr['payment_mode'] = 'Online';

	$arr['insurance'] = false;

	$arr['number_of_package'] = '1';

	$arr['package_details'] = array();

	$arr['package_details']['details'] = array();

	$arr['package_details']['details']['weight'] = '2';
	$arr['package_details']['details']['length'] = '3';
	$arr['package_details']['details']['height'] = '4';
	$arr['package_details']['details']['width']  = '2';

	$arr['package_details']['details']['invoice'] = round('123',0);

	$arr['package_details']['details']['packagedescription'] = 'Mobile Phone';

	$arr['delivery_address'] = array();

	$arr['delivery_address']['contact_name'] = 'ABC XYZ';
	$arr['delivery_address']['company_name'] = 'QWERTYU';
	$arr['delivery_address']['address'] = 'Buidling 1, Road No 1';
	$arr['delivery_address']['city'] = 'Mumbai';
	$arr['delivery_address']['state'] = 'Maharashtra';
	$arr['delivery_address']['pincode'] = '400077';
	$arr['delivery_address']['country'] = 'India';
	$arr['delivery_address']['contact_no'] = '9899989989';
	$arr['delivery_address']['email'] = 'support@gmail.in';

	$arr['success_callback_url'] = $_SERVER['SERVER_NAME'].'couriers/Callback';
	$arr['failure_callback_url'] = $_SERVER['SERVER_NAME'].'couriers/Fail';
	$arr['client_source'] = '';


	$data = json_encode($arr); // CONVER TO JSON


	$api_key	=	"5951dd5650982129b401946b87bc2ac7";		// ADD YOUR API KEY HERE
	
	$secret_key	=	"cb87c55d06506bd9ccd9ec866cac6ff3";		// ADD YOUR SECRET KEY HERE					
	
	$post_url	=	"http://api.couriers.vello.in/initiateShipmentRequest";	// SANDBOX URL
	
	//$post_url	=	"http://api.couriers.zepo.in/initiateShipmentRequest";	// PRODUCTION URL

	$strtoSign	=	"POST\n/initiateShipmentRequest";
	
	$strtoSign	=	urlencode($strtoSign);
		
	$my_sign = hash_hmac("sha1", $strtoSign, $secret_key);
	
	$my_sign = base64_encode($my_sign);
		
	$header	=	"Authorization:SHIPIT".' '.$api_key.':'.$my_sign;
		
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$post_url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data );  //Post Fields
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$headers = [
	    'Accept-Encoding: gzip, deflate',
	    'Accept-Language: en-US,en;q=0.5',
	    'Cache-Control: no-cache',
	    'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
	    'X-MicrosoftAjax: Delta=true',
	    $header,
	    'Content-Type:application/json',
	];
		
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$server_output = curl_exec ($ch);
	curl_close ($ch);

?>








<script type="text/javascript">
	var res = '<?php echo ($server_output); ?>';
	res = JSON.parse(res);
	if( res.success ) {
		window.location.href = res.redirectUrl;
	} else {
		var err = res.messages;
		console.log(res);
		alert(err.join('\n'));
		window.close();
	}
</script>
