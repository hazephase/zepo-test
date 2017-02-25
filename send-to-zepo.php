<?php
$api_key	=	"5951dd5650982129b401946b87bc2ac7";		// ADD YOUR API KEY HERE

$secret_key	=	"cb87c55d06506bd9ccd9ec866cac6ff3";		// ADD YOUR SECRET KEY HERE

$post_url	=	"http://api.couriers.vello.in/initiateShipmentRequest";	// TESTING ENVIRONMENT

//$post_url	=	"http://api.couriers.zepo.in/initiateShipmentRequest";	// PRODUCTION ENVIRONMENT
$strtoSign	=	"POST\n/initiateShipmentRequest";

$strtoSign	=	urlencode($strtoSign);

$my_sign = hash_hmac("sha1", $strtoSign, $secret_key);

$my_sign = base64_encode($my_sign);

$header	=	"Authorization:SHIPIT".' '.$api_key.':'.$my_sign;

$data = json_encode($this->getRequestObject());

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