<?php
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
    $apiKey = get_option('spreadshop_api_key');
    $secret = get_option('spreadshop_api_secret');
    $time = time()*1000;
    $data = "$method $url $time";
    $sig = sha1("$data $secret");
	
    //return 'Authorization: SprdAuth apiKey='.$apiKey.', data='.$data.', sig='.$sig;
	return "Authorization: SprdAuth apiKey=\"".$apiKey."\", data=\"$data\", sig=\"$sig\"";
	}
	

?>