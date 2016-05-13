<?php
	session_start();
	include_once("common.php");
	require_once ("paypalfunctions.php");

    TraceMsg("----- PaypalInvoice Called -----");

	if (!IsSet($_SESSION['ShirtData'])) {
        TraceMsg("PaypalInvoice: Can't find ShirtData in the session");
		echo "<span style=\"color:red\">Can't find the information in the session</span>";
        exit;
    }


    /*  Just a dump of the Request block
    echo "PaypalInvoice: Dump of \$_REQUEST<br>";
	foreach( $_REQUEST as $key => $value ) {
		//$data[$key] = $value;
        echo "$key=>$value<br>";
    }
    */



	$data = $_SESSION['ShirtData'];
	if (isset($_REQUEST['token']))
	{
		$_SESSION['token'] = $_REQUEST['token'];
		$_SESSION['payer_id'] =	$_REQUEST['PayerID'];
	}

    /*
     * Get Shipping Details and log to disk
     */

    $shippingDetails = GetShippingDetails($_REQUEST['token']);
    $_SESSION['shippingDetails'] = $shippingDetails;


    $msg="[Shipping]:";
	foreach( $shippingDetails as $key => $value ) { $msg .= "$key=>$value;"; }

    /* This is just an echo of the invoice data - write this to disk */
    $msg .= "[Data]:";
	foreach( $data as $key => $value ) { $msg .= "$key=>$value;"; }

    TraceMsg($msg);


?>
<html>
<head>
	<title>CWPN Shirt Sale - Invoice</title>
	<script>
	function submit() {
		document.location = "PayPalPayment.php";
	}
	</script>
</head>
<body>
<img src="header.jpg" width="600" height="150">
<div id="confirm">
Name: <?php echo $shippingDetails['FIRSTNAME'] . ' ' . $shippingDetails['LASTNAME'] ?><br>
Email: <?php echo $shippingDetails['EMAIL'];?><br>
Address: <?php echo $shippingDetails['SHIPTOSTREET'] . ';' . $shippingDetails['SHIPTOCITY'] . ' ' . $shippingDetails['SHIPTOSTATE'] . ' ' . $shippingDetails['SHIPTOZIP']?><br>

<table border="1">
<tr><th>Desc</th><th>Price</th><th>Count</th><th>Extended Price</th></tr>
<?php
    $shipToHome = isset($data['shiphome']) ? $data['shiphome']=='on' : false;
    TraceMsg("shipToHome=$shipToHome shiphome=" . $data['shiphome']);
$itemCnt = 0;
$totalPrice = 0;
foreach($productCatalog as $saleItem)
{
    list($desc, $itemCode, $itemCost ) = $saleItem;
    $cnt = isset($data[$itemCode]) ? $data[$itemCode] : 0;
    if ($cnt > 0) 
    {
        $itemPrice = $itemCost * $cnt;
        echo "<tr><td>$desc</td><td>\$$itemCost</td><td>$cnt</td><td>\$$itemPrice</td></tr>";
        $itemCnt += $cnt;
        $totalPrice += $itemPrice;
    }
    $shippingCost = $itemCnt * 10;
}
    if ($shipToHome)
    {
        // include shipping amount
        echo "<tr><td colspan=\"2\">Sub Total</td><td>$itemCnt</td><td>\$$totalPrice</td></tr>";
        echo "<tr><td colspan=\"3\">Shipping</td><td>\$$shippingCost</td></tr>";
        $totalPrice += $shippingCost;
        echo "<tr><td colspan=\"3\">Total</td><td>\$$totalPrice</td></tr>";
    }
    else 
    {
        // no shipping
        echo "<tr><td colspan=\"2\">Total</td><td>$itemCnt</td><td>\$$totalPrice</td></tr>";
    }
?>
</table>

Ready to bill your PayPal account.
<br>
You will be charged <?php echo '$' . number_format($shippingDetails['AMT'],2); ?><br>
<input type="button" value="Complete my Order" onClick="submit()">
</div>
</body>
    </html>