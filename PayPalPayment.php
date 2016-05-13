<?php
	session_start();

	include_once("common.php");
	require_once ("paypalfunctions.php");
	if (IsSet($_SESSION['ShirtData'])) {
		$data = $_SESSION['ShirtData'];
	} else {
		echo "Can't find the information in the session";
		exit;
	}

    TraceMsg("----- PayPalPayment.php ------");

	$_SESSION['paymentType'] = 'Sale';
	$token = $_SESSION['token'];
	$finalPaymentAmount =  $data['amountDue'];
	/*
	'------------------------------------
	' Calls the DoExpressCheckoutPayment API call
	'
	' The ConfirmPayment function is defined in the file PayPalFunctions.jsp,
	' that is included at the top of this file.
	'-------------------------------------------------
	*/

	$resArray = ConfirmPayment ( $finalPaymentAmount );
	$ack = strtoupper($resArray["ACK"]);

	/*
	$ack = 'SUCCESS';
	$transactionId = '123456';
	$paypalAmount = 123;
	require_once("SubmitRegister.php");
	exit;
	*/


	if( $ack == "SUCCESS" )
    {
        TraceMsg("Payment Confirmed");
		try 
        {

            $shippingDetails = $_SESSION['shippingDetails'];
        	$export = "----- Order Complete : " . date('c') . "\nshippingDetails=" . var_export($shippingDetails,true) . "\n";
            $export .= "Data=" . var_export($data,true) . "\nResArray=" . var_export($resArray, true) . "\n";
    		file_put_contents("PayPalExport.log", $export, FILE_APPEND);
		}
		catch (Exception $e)
		{
			echo "Could not log this: " . $e->getMessage();
		}

		$transactionId		= $resArray["TRANSACTIONID"];
		$transactionType 	= $resArray["TRANSACTIONTYPE"];
		$paymentType		= $resArray["PAYMENTTYPE"];
		$orderTime 			= $resArray["ORDERTIME"];
		$paypalAmount		= $resArray["AMT"];
		$currencyCode		= $resArray["CURRENCYCODE"];
		$feeAmt				= $resArray["FEEAMT"];
		$settleAmt			= IsSet($resArray["SETTLEAMT"]) ? $resArray["SETTLEAMT"] : null;
		$taxAmt				= IsSet($resArray["TAXAMT"]) ? $resArray["TAXAMT"] : null;
		$exchangeRate		= IsSet($resArray["EXCHANGERATE"]) ? $resArray["EXCHANGERATE"] : null;
		$paymentStatus	    = IsSet($resArray["PAYMENTSTATUS"]) ? $resArray["PAYMENTSTATUS"] : null; 
		$pendingReason	    = IsSet($resArray["PENDINGREASON"]) ? $resArray["PENDINGREASON"] : null;  
		$reasonCode		    = IsSet($resArray["REASONCODE"]) ? $resArray["REASONCODE"] : null;   

		//require_once("SubmitRegister.php");
        TraceMsg("Order is complete");

        include "OrderComplete.html";



	}
	else  
	{
		//Display a user friendly Error on the page using any of the following error information returned by PayPal
		$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
		$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
		$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
		$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
		
        TraceMsg("ConfirmPayment Failed ShortMsg=$ErrorShortMsg ErrorCode=$ErrorCode");
		echo "Confirm Payment API call failed. <br>";
		echo "Detailed Error Message: " . $ErrorLongMsg . "<br>";
		echo "Short Error Message: " . $ErrorShortMsg . "<br>";
		echo "Error Code: " . $ErrorCode . "<br>";
		echo "Error Severity Code: " . $ErrorSeverityCode . "<br>";
	}
		
?>
