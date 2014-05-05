
<?php
/*
//section to get the basket
//To DO: Clean up that mess!

if ($_GET["action"]=="getBasket")
	{
//check if basket exists
	if (isset($_COOKIE["basket"]))
		{
		//To DO: DRY!
		$basketURL=$_COOKIE["basket"];
		$header[] = createSprdAuthHeader("Get", $basketURL);
		$header[] = "Content-Type: application/xml";
		$ch = curl_init($basketURL);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		$result = curl_exec($ch);
		curl_close($ch);
		$result=new SimpleXMLElement($result);
		}
//if no basket exists, do not load it...
	else
		{
		$result= "";
		}
// return result to requesting entity	
//echo $result->asXML();
$url=$result->links->link->attributes('http://www.w3.org/1999/xlink');
$total=$result->priceTotal->vatIncluded;
echo '{"total":"'.$total.'","url":"'.$url.'"}'; 
}

if ($_GET["action"]=="add")
{
//check if basket exists
// if basket exists,  add item

if (isset($_COOKIE["basket"]))
{
$basketURL=$_COOKIE["basket"];
}
//if no basket exists, create one
else
{
$basketURL=createBasket();
}

$basketItemsURL = $basketURL . "/items";

			$basketItem = new SimpleXmlElement('<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
					<basketItem xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://api.spreadshirt.net">
					<quantity>1</quantity>
					<element id="26620609" type="sprd:article" xlink:href="http://api.spreadshirt.de/api/v1/shops/'.get_option('spreadshop_api_key').'/articles/26620609">
					<properties>
					<property key="appearance">2</property>
					<property key="size">2</property>
					</properties>
					</element>
					<links>
					<link type="edit" xlink:href="http://'.get_option('spreadshop_shop_id').'.spreadshirt.de/-A26620609"/>
					<link type="continueShopping" xlink:href="http://'.get_option('spreadshop_shop_id').'.spreadshirt.de"/>
					</links>
					</basketItem>');
					$header = array();
			$header[] = createSprdAuthHeader("POST", $basketItemsURL);
			$header[] = "Content-Type: application/xml";
	
$ch = curl_init($basketItemsURL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $basketItem->asXML());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	
	$data=$basketURL;
	//$data["basketItemsURL"]=$basketItemsURL;
    //$data["result"]=$result;
    echo $data;

}
*/
?>
