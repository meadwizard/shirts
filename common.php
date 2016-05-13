<?php

	$SandboxFlag = false;

class ProductCategory
{
}


$productCategory = array(
    array(name => 'T-Shirts', code => 'TS'),
    array(name => 'Pullover Hoddie Sweatshirts',  code =>'HS')
    );

$productSubCat = array(
    array('Men\'s $20 each', 'MTS', 'TS', 'cwpn_hg16_mens_tshirt_small.jpg'),
    array('Women\'s $20 each', 'WTS', 'TS'),
    array('$25 each', 'SHS', 'HS'),
    array('$30 each', 'LHS', 'HS')
    );

	$productCatalog = array(
		array('Mens t-shirt Small','MenSmall', 20, 'MTS' ),
		array('Mens t-shirt Medium','MenMedium', 20, 'MTS'),
		array('Mens t-shirt Large','MenLarge', 20, 'MTS'),
		array('Mens t-shirt XL','MenXL', 20, 'MTS'),
		array('Mens t-shirt XXL','MenXXL', 20, 'MTS'),
		array('Mens t-shirt XXXL','MenXXXL', 20, 'MTS'),
		array('Womens t-shirt Small','WomenSmall', 20, 'WTS'),
		array('Womens t-shirt Medium','WomenMedium', 20, 'WTS'),
		array('Womens t-shirt Large','WomenLarge', 20, 'WTS'),
		array('Womens t-shirt XL','WomenXL', 20, 'WTS'),
		array('Womens t-shirt XXL','WomenXXL', 20, 'WTS'),
		array('Womens t-shirt XXXL','WomenXXXL', 20, 'WTS'),
		array('Hoodies Small','HoodieSmall', 25, 'SHS'),
		array('Hoodie Medium','HoodieMedium', 25, 'SHS'),
		array('Hoodie Large','HoodieLarge', 25, 'SHS'),
		array('Hoodie XL','HoodieXL', 25, 'SHS'),
		array('Hoodie XXL','HoodieXXL', 25, 'SHS'),
		array('Hoodie XXXL','HoodieXXXL', 25, 'SHS'),
		array('Hoodie 4XL','Hoodie4XL', 30, 'LHS'),
		array('Hoodie 5XL','Hoodie5XL', 30, 'LHS'),
	);

	function TraceMsg($msg)
	{
		error_log( date('[ymd-His]') . ':' .$msg . "\n", 3, "trace.log"); 
	}

?>
