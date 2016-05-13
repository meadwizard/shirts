<?php
    session_start();
    include_once("common.php");
    TraceMsg("----- Shirts.php -----");
?>
<html>
<head>
    <title>CWPN Harvest Gathering T-Shirt Sales</title>
<style>
td.size { color: red; text-align:right; font-weight:bold; padding-right:10px }
</style>
<script>
function ResetQuantity()
{
	console.log("Reset Quantity");
<?php
            foreach($productCatalog as $saleItem)
            {
                list($desc, $itemCode, $itemCost, $category ) = $saleItem;
                echo "document.forms[0].$itemCode.value = 0;\n";
            }
?>
	CalcPrice();
	return false;
}
function CalcPrice()
{
	console.log('CalcPrice');

	var cost = 0

<?php
            foreach($productCatalog as $saleItem)
            {
                list($desc, $itemCode, $itemCost, $category ) = $saleItem;
    echo "+ document.forms[0].$itemCode.value * $itemCost \n";
            }
?>
            ;
	var itemCnt = Number('0')
<?php
            foreach($productCatalog as $saleItem)
            {
                list($desc, $itemCode, $itemCost, $category ) = $saleItem;
                echo "+ Number(document.forms[0].$itemCode.value)\n";
            }
?>
            ;


	console.log("Price =" + cost + " itemCnt=" + itemCnt);
    if (document.forms[0].shiphome.checked) { cost += itemCnt * 10 };
	document.getElementById('showcost').innerHTML = cost;
}
</script>
</head>
<body>
<img src="header.jpg" width="600" height="150">
<form action="payment.php" method="post">
Travel <i>The Path Home</i> in magickal comfort with these EXCLUSIVE Harvest Gathering 2016 ~ The Path Home T-shirts and hoodies!
<br/>Available ONLINE ONLY for a limited time!
<br />Order yours by July 1 before they disappear!
<br>
<ul>
	<li>Blended material, 50/50 cotton/polyester. Black with Green print.</li>
	<li>PAYMENT BY PAYPAL ONLY.</li>
	<li>Pick your shirts up at this year’s Harvest Gathering, or for an additional $10 per shirt we can mail your purchase to you.</li>
</ul>

Check here if you wish to have your shirts delivered. The cost is $10. <input type="checkbox" name="shiphome" onclick="CalcPrice()">

<?php
/* 
echo '<table border="1">';
foreach($productCategory as $catData)
{
    //list($catName, $catCode) = $catData;
    echo "<tr><th colspan=\"5\">$catData[name]</th></tr>";
    foreach($productSubCat as $subCatData)
    {
        list($subcatDesc, $subcatCode, $subcatCategory, $image) = $subCatData;
        if ( $subcatCategory == $catData[code] )
        {
            echo "<tr><td><img src=\"$image\"></td><th colspan=\"5\">$subcatDesc</th></tr>";
            foreach($productCatalog as $saleItem)
            {
                list($desc, $itemCode, $itemCost, $category ) = $saleItem;
                if ( $category == $subcatCode )
                {
                    echo "<tr><td></td><td></td><td>$desc</td></tr>";
                }
            }
        }
    }
}
echo '</table>';
 */ 
?>

<table border="1">
	<tr>
		<th colspan="5">T-Shirts</th>
	</tr>
	<tr>
		<th rowspan="6"><img src="cwpn_hg16_mens_tshirt_small.jpg"></th>
		<td rowspan="6">Men's $20.00 each</td>
		<td class="size">Small</td>
		<td>
				<select name="MenSmall" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
		</td>
	</tr>

				<tr><td class="size">Medium</td><td>
				<select name="MenMedium" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
<option>3</option>
					<option>4</option>
<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

				<tr><td class="size">Large</td><td>
				<select name="MenLarge" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

				<tr><td class="size">X-Large</td><td>
				<select name="MenXL" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

				<tr><td class="size">XX Large</td><td>
				<select name="MenXXL" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

				<tr><td class="size">XXX Large</td><td>
				<select name="MenXXXL" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>


	<tr>
		<th rowspan="6"><img src="cwpn_hg16_womens_tshirt_small.jpg"></th>
		<td rowspan="6">Women's $20.00 each</td>
				<td class="size">Small</td><td>
				<select name="WomenSmall" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

				<tr><td class="size">Medium</td><td>
				<select name="WomenMedium" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

				<tr><td class="size">Large</td><td>
				<select name="WomenLarge" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

				<tr><td class="size">X-Large</td><td>
				<select name="WomenXL" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

				<tr><td class="size">XX Large</td><td>
				<select name="WomenXXL" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

				<tr><td class="size">XXX Large</td><td>
				<select name="WomenXXXL" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

	<tr>
		<th colspan="5">Pullover Hoodie Sweatshirts</th>
	</tr>

	<tr>
		<th rowspan="8"><img src="cwpn_hg16_hoodie_small.jpg"></th>
		<td rowspan="6">$25.00 each</td>

				<td class="size">Small</td><td>
				<select name="HoodieSmall" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td>
	</tr>

				<tr><td class="size">Medium</td><td>
				<select name="HoodieMedium" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

				<tr><td class="size">Large</td><td>
				<select name="HoodieLarge" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

				<tr><td class="size">X-Large</td><td>
				<select name="HoodieXL" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

				<tr><td class="size">XX Large</td><td>
				<select name="HoodieXXL" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

				<tr><td class="size">XXX Large</td><td>
				<select name="HoodieXXXL" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

	<tr>
		<td rowspan="2">$30.00 each</td>
				<td class="size">4XL</td><td>
				<select name="Hoodie4XL" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td>
	</tr>

				<tr><td class="size">5XL</td><td>
				<select name="Hoodie5XL" onchange="CalcPrice()">
					<option value="0">quantity...</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</select>
				</td></tr>

</table>

Total Cost:$<div id="showcost" style="display:inline-block"></div>
<button type="submit">Submit Order</button>
<button onClick="return ResetQuantity()">Reset</button>


</form>
</body>
</html>
