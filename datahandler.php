<?php
$shopID=get_option('spreadshop_shop_id');
$platform=get_option('spreadshop_platform');
$language=get_option('spreadshop_language');
$locale=get_option('spreadshop_locale');
$baseURL='http://api.spreadshirt.'.$platform.'/api/v1/shops/'.$shopID.'/';
global $baseURL;

// function to create filename from url
function createFilename($targetURL) {
   $string = str_replace(' ', '-', $targetURL);
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}

// function to get data
function get_data($targetURL)
{
$cacheTime=3600;
$cacheFile = 'cache/'.createFilename($targetURL);
if (is_cached($cacheFile) &&(time() - $cacheTime < filemtime($cacheFile))) 
	{
	@$data=new SimpleXMLElement(read_cache($cacheFile));	
	} 
else 
	{
	$data= simplexml_load_file($targetURL);
	write_cache($cacheFile,$data->asXML());
	}
return $data->asXML();
} 


// check if file exists
function is_cached($cacheFile) 
	{
 	$cacheFile_created = (file_exists($cacheFile)) ;
 	return $cacheFile_created;
}
 

// write cache file if not existend
function write_cache($cacheFile,$cacheData)
	{
	$fp = fopen($cacheFile, 'w');
	fwrite($fp, $cacheData);
	fclose($fp);
	}

// read from cache
function read_cache($cacheFile) {
return file_get_contents($cacheFile);
}

// actual functions to define urls to call



function get_producttype_list($currentpage)
{
$limit=get_option('spreadshop_items_per_page');
$offset=($currentpage-1)*$limit;
$targetURL='http://api.spreadshirt.net/api/v1/shops/'.get_option('spreadshop_shop_id').'/productTypes?locale=de_DE&fullData=true&limit='.$limit.'&offset='.$offset.'#0';
$data= new SimpleXMLElement(get_data($targetURL)) ;
return $data;
}

function get_producttype_list_by_department($assortment_department_id)
{
$targetURL='http://api.spreadshirt.net/api/v1/shops/'.get_option('spreadshop_shop_id').'/productTypeDepartments/'.$assortment_department_id.'?locale=de_DE&fullData=true#0';
echo $targetURL;
$data= new SimpleXMLElement(get_data($targetURL)) ;
return $data;
}

function get_department_data($departmentID)
{
$targetURL='http://api.spreadshirt.net/api/v1/shops/'.get_option('spreadshop_shop_id').'/productTypeDepartments/'.$departmentID.'?locale=de_DE&fullData=true#0';
$data= new SimpleXMLElement(get_data($targetURL)) ;

return $data;
}

function get_department_list()
{
$targetURL='http://api.spreadshirt.net/api/v1/shops/'.get_option('spreadshop_shop_id').'/productTypeDepartments?locale=de_DE&fullData=true#0';
$data= new SimpleXMLElement(get_data($targetURL)) ;
return $data;
}

function get_producttype_data($producttype_id)
{
$targetURL='http://api.spreadshirt.net/api/v1/shops/'.get_option('spreadshop_shop_id').'/productTypes/'.$producttype_id.'?locale=de_DE&fullData=true';
$data= new SimpleXMLElement(get_data($targetURL)) ;
return $data;
}

function get_product_data($product_id)
{
$targetURL='http://api.spreadshirt.net/api/v1/shops/'.get_option('spreadshop_shop_id').'/product/'.$product_id.'?locale=de_DE&fullData=true#0';
$data= new SimpleXMLElement(get_data($targetURL)) ;
return $data;

}

function get_article_list_data()
{
$limit=get_option('spreadshop_items_per_page');
$targetURL='http://api.spreadshirt.net/api/v1/shops/'.get_option('spreadshop_shop_id').'/articles?locale=de_DE&fullData=true&limit='.$limit.'&offset=0#0';
$data= new SimpleXMLElement(get_data($targetURL)) ;
return $data;
}



function get_article_data($article_id)
{
$targetURL='http://api.spreadshirt.net/api/v1/shops/'.get_option('spreadshop_shop_id').'/articles/'.$article_id.'?locale=de_DE&fullData=true&limit=100&offset=0#0';
$data= new SimpleXMLElement(get_data($targetURL)) ;
return $data;
}

function get_article_navi_data()
{
$targetURL='http://api.spreadshirt.net/api/v1/shops/'.get_option('spreadshop_shop_id').'//articles?locale=de_DE&fullData=true#0';
$data= new SimpleXMLElement(get_data($targetURL)) ;
return $data;
}

function read_basket()
{echo 'read the basket';}

function _create_basket()
{$basket= new SimpleXMLElementecho ('<basket xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://api.spreadshirt.net"></basket>');
		}

function update_basket()
{echo 'update the basket';}


?>

