<?php
if (session_id() == "") session_start(); 

// Compute the absolute path to this host
$host = 'http://' . $_SERVER['SERVER_NAME'];
if ( $_SERVER['SERVER_PORT'] != 80 ) $host .= ':' . $_SERVER['SERVER_PORT'];
$parts = split('/',$_SERVER['REQUEST_URI']);
for($i=1; $i<count($parts)-1; ++$i ) {
	$host .= '/' . $parts[$i];
}
	require_once("common.php");

    TraceMsg("---- payment.php ----");

// Get all the data into the session
	require_once ("paypalfunctions.php");
	// ==================================
	// PayPal Express Checkout Module
	// ==================================

	$data = array();
	if (IsSet($_SESSION['ShirtData'])) { $data = $_SESSION['ShirtData']; }

    // lets store all the data in the session
	$data = array();
	foreach( $_POST as $key => $value ) {
		$data[$key] = $value;
	}


	$currencyCodeType = "USD";
	$paymentType = "Sale";
	$returnURL = "$host/PaypalInvoice.php";
	$cancelURL = "$host/shirts.php";
	$paymentAmount = 60;
	$resArray = CallShortcutExpressCheckout ( $currencyCodeType, $paymentAmount, $paymentType, $returnURL, $cancelURL, $data);
	$ack = strtoupper($resArray["ACK"]);
	if ($ack=="SUCCESS")
	{
		RedirectToPayPal ( $resArray['TOKEN'] );
        $data['TOKEN'] = $regArray['TOKEN'];
        $_SESSION['ShirtData'] = $data;
	} 
	else  
	{
		//Display a user friendly Error on the page using any of the following error information returned by PayPal
		$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
		$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
		$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
		$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);

        TraceMsg("SetExpressCheckout failed $ErrorShortMsg");
		
		echo "SetExpressCheckout API call failed.<br>";
		echo "Detailed Error Message: " . $ErrorLongMsg . "<br>";
		echo "Short Error Message: " . $ErrorShortMsg . "<br>";
		echo "Error Code: " . $ErrorCode . "<br>";
		echo "Error Severity Code: " . $ErrorSeverityCode . "<br>";
	}
?>
