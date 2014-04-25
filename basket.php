<?php
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
echo json_encode($result);
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
					<element id="26620609" type="sprd:article" xlink:href="http://api.spreadshirt.de/api/v1/shops/500316/articles/26620609">
					<properties>
					<property key="appearance">2</property>
					<property key="size">2</property>
					</properties>
					</element>
					<links>
					<link type="edit" xlink:href="http://500316.spreadshirt.de/-A26620609"/>
					<link type="continueShopping" xlink:href="http://500316.spreadshirt.de"/>
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

 function parseHttpHeaders($header, $headername) {

			$retVal = array();
			$fields = explode("\r\n", preg_replace('/\x0D\x0A[\x09\x20]+/', ' ', $header));

			foreach($fields as $field) {
				if (preg_match('/(' . $headername . '): (.+)/m', $field, $match)) {
					return $match[2];
				}
			}

			return $retVal;
		}
		
function createSprdAuthHeader($method, $url) 
	{
    $apiKey = 'e497b77b-24fe-4781-85d6-ab5b5039f116';
    $secret = 'a1c3d25e-47fc-4c92-af1a-297040946382';
    $time = time()*1000;
    $data = "$method $url $time";
    $sig = sha1("$data $secret");
	
    //return 'Authorization: SprdAuth apiKey='.$apiKey.', data='.$data.', sig='.$sig;
	return "Authorization: SprdAuth apiKey=\"".$apiKey."\", data=\"$data\", sig=\"$sig\"";
	}
	
function createBasket()
{
$basketURL="http://api.spreadshirt.net/api/v1/baskets";
$basket = new SimpleXmlElement('<basket xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://api.spreadshirt.net">
					<shop id="500316"/>
					</basket>');

$header = array();
$header[] = createSprdAuthHeader("POST", "http://api.spreadshirt.net/api/v1/baskets/items");
$header[] = "Content-Type: application/xml";

    $ch = curl_init($basketURL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $basket->asXML());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $result = parseHttpHeaders(curl_exec($ch),"Location");
	curl_close($ch);
	return $result;


}
?>
