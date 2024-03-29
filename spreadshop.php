<?php
/**
 * Plugin Name: spreadshop
 * Plugin URI:
 * Description:
 * Version: 
 * Author: 
 * Author 
 * License:
 */
//Hooks
// Hook to register plugin deactivation
register_deactivation_hook(__FILE__, 'spreadshop_deactivation');
// Hook to register plugin activation
register_activation_hook(__FILE__, 'spreadshop_activation');
add_action('admin_menu', 'spreadshop_admin_menu_entry');
add_shortcode( 'spreadshop_assortment', 'spreadshop_assortment' );
add_shortcode( 'spreadshop_assortment_detail', 'spreadshop_assortment_detail' );
add_shortcode( 'spreadshop_article', 'spreadshop_article_list' );
add_shortcode( 'spreadshop_article_detail', 'spreadshop_article_detail' );
add_shortcode( 'spreadshop_designer', 'spreadshop_designer' );
add_shortcode( 'spreadshop_checkout', 'spreadshop_checkout' );
add_shortcode( 'spreadshop_imprint', 'spreadshop_imprint' );
add_action( 'admin_init', 'register_mysettings' );
add_filter( 'wp_nav_menu_args', 'modify_nav_menu_args' );
add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );
add_action( 'wp_ajax_add_to_basket', 'add_to_basket' );
add_action( 'wp_ajax_nopriv_add_to_basket', 'add_to_basket' );
add_action( 'wp_ajax_get_basket', 'get_basket' );
add_action( 'wp_ajax_nopriv_get_basket', 'get_basket' );
add_action( 'wp_ajax_add_producttype_to_basket', 'add_producttype_to_basket' );
add_action( 'wp_ajax_nopriv_add_producttype_to_basket', 'add_producttype_to_basket' );


//function to exclude specific pages from showing up in the navigation
function modify_nav_menu_args( $args )
{
$args['exclude'] = get_option('spreadshop_product_detail_page').','.get_option('spreadshop_article_detail_page');
return $args;
}



// function to register settings
function register_mysettings()
{
register_setting( 'spreadshop-settings-shop', 'spreadshop_shop_id' );
register_setting( 'spreadshop-settings-shop', 'spreadshop_api_key' );
register_setting( 'spreadshop-settings-shop', 'spreadshop_api_secret' );
register_setting( 'spreadshop-settings-shop', 'spreadshop_product_detail_page' );
register_setting( 'spreadshop-settings-shop', 'spreadshop_product_list_page' );
register_setting( 'spreadshop-settings-shop', 'spreadshop_designer_page' );
register_setting( 'spreadshop-settings-shop', 'spreadshop_article_list_page' );
register_setting( 'spreadshop-settings-shop', 'spreadshop_article_detail_page' );
register_setting( 'spreadshop-settings-shop', 'spreadshop_items_per_page' );
register_setting( 'spreadshop-settings-shop', 'spreadshop_language' );
register_setting( 'spreadshop-settings-shop', 'spreadshop_locale' );
register_setting( 'spreadshop-settings-shop', 'spreadshop_domain' );
}



// definition of default pages 
function spreadshop_activation() {

$post = array(
 'post_name'      => "T-Shirt-Shop",
 'post_type'      => "page",
 'post_title' =>"T-Shirt-Shop",
 'post_status' =>"publish",
 'tags_input' => 'spreadshop' );
$post_id=wp_insert_post( $post, $wp_error );


$post = array(
 'post_name'      => "Produkte",
 'post_type'      => "page",
 'post_title' =>"Produkte",
 'post_status' =>"publish",
  'post_parent' =>$post_id,
 'tags_input' => 'spreadshop',
 'post_content' => '<?php echo do_shortcode( "[spreadshop_assortment]" ) ?>
<script src="lazyload.js" type="text/javascript"></script>
<script>
jQuery(function() {
    jQuery("img.lazy").lazyload();
});
</script>'
 );
$spreadshop_product_list_page=wp_insert_post( $post, $wp_error );
update_option( 'spreadshop_product_list_page',$spreadshop_product_list_page ); 


$post = array(
 'post_name'      => "T-Shirt-Details",
 'post_type'      => "page",
 'post_title' =>"T-Shirt-Details",
 'post_status' =>"publish",
 'tags_input' => 'spreadshop',
 'post_parent' =>$post_id,
 'post_content' => '<?php echo do_shortcode( "[spreadshop_assortment_detail]" ) ?>
<script src="lazyload.js" type="text/javascript"></script>
<script>
jQuery(function() {
    jQuery("img.lazy").lazyload();
});
</script>' );
$spreadshop_product_detail_page=wp_insert_post( $post, $wp_error );
update_option( 'spreadshop_product_detail_page',$spreadshop_product_detail_page ); 


$post = array(
 'post_name'      => "Artikel",
 'post_type'      => "page",
 'post_title' =>"Artikel",
 'post_status' =>"publish",
  'post_parent' =>$post_id,
 'tags_input' => 'spreadshop',
 'post_content' => '<?php echo do_shortcode( "[spreadshop_article]" ) ?>
<script src="lazyload.js" type="text/javascript"></script>
<script>
jQuery(function() {
    jQuery("img.lazy").lazyload();
});
</script>'
 );
$spreadshop_article_list_page=wp_insert_post( $post, $wp_error );
update_option( 'spreadshop_article_list_page',$spreadshop_article_list_page ); 

$post = array(
 'post_name'      => "Artikeldetails",
 'post_type'      => "page",
 'post_title' =>"Artikeldetails",
 'post_status' =>"publish",
  'post_parent' =>$post_id,
 'tags_input' => 'spreadshop',
 'post_content' => '<?php echo do_shortcode( "[spreadshop_article_detail]" ) ?>
<script src="lazyload.js" type="text/javascript"></script>
<script>
jQuery(function() {
    jQuery("img.lazy").lazyload();
});
</script>'
 );
$spreadshop_article_detail_page=wp_insert_post( $post, $wp_error );
update_option( 'spreadshop_article_detail_page',$spreadshop_article_detail_page ); 



$post = array(
 'post_name'      => "Designer",
 'post_type'      => "page",
 'post_title' =>"Designer",
 'post_status' =>"publish",
  'post_parent' =>$post_id,
 'tags_input' => 'spreadshop',
 'post_content' => '<?php echo do_shortcode( "[spreadshop_designer]" ) ?>
<script src="lazyload.js" type="text/javascript"></script>
<script>
jQuery(function() {
    jQuery("img.lazy").lazyload();
});
</script>'
 );
$spreadshop_designer_page=wp_insert_post( $post, $wp_error );
update_option( 'spreadshop_designer_page',$spreadshop_designer_page ); 


$post = array(
 'post_name'      => "Impressum",
 'post_type'      => "page",
 'post_title' =>"Impressum",
 'post_status' =>"publish",
  'post_parent' =>$post_id,
 'tags_input' => 'spreadshop',
 'post_content' => '<?php echo do_shortcode( "[spreadshop_imprint]" ) ?>
<script src="lazyload.js" type="text/javascript"></script>
<script>
jQuery(function() {
    jQuery("img.lazy").lazyload();
});
</script>'
 );
wp_insert_post( $post, $wp_error );

$post = array(
 'post_name'      => "Checkout",
 'post_type'      => "page",
 'post_title' =>"Checkout",
 'post_status' =>"publish",
  'post_parent' =>$post_id,
 'tags_input' => 'spreadshop',
 'post_content' => '<?php echo do_shortcode( "[spreadshop_checkout]" ) ?>
<script src="lazyload.js" type="text/javascript"></script>
<script>
jQuery(function() {
    jQuery("img.lazy").lazyload();
});
</script>'
 );
wp_insert_post( $post, $wp_error );


}
function spreadshop_deactivation() {
$args = array(
'tag'=>'spreadshop');
$posts_array = get_posts( $args ); 
foreach ( $posts_array as $post )
{
wp_delete_post( $post->id, $force_delete );
};
}

// function to create menu entry 
function spreadshop_admin_menu_entry($content) 
	{
    add_menu_page("Spreadshop Admin", "Spreadshop", 1, "Spreadshop_Admin", "spreadshop_admin");  
	}
	
//function to include spreadoptions page	
function spreadshop_admin(){
if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	include(plugin_dir_path(__FILE__).'/spreadoptions.php');
	
}

//function to include assortment
function spreadshop_assortment()
{
include(plugin_dir_path(__FILE__).'/spreadassortment.php');
add_filter('wp_head', 'sources');
}


//function to include assortment detail pages
function spreadshop_assortment_detail()
{
include(plugin_dir_path(__FILE__).'/spreadassortmentdetail.php');
add_filter('wp_head', 'sources');
}

//function to include designer

function spreadshop_designer()
{
include(plugin_dir_path(__FILE__).'/spreaddesigner.php');
add_filter('wp_head', 'sources');
}


//function to include imprint

function spreadshop_imprint()
{
include(plugin_dir_path(__FILE__).'/imprint.php');
add_filter('wp_head', 'sources');
}

//function to include imprint

function spreadshop_checkout()
{
include(plugin_dir_path(__FILE__).'/checkout.php');
add_filter('wp_head', 'sources');
}


//function to include article detail page

function spreadshop_article_detail()
{
include(plugin_dir_path(__FILE__).'/spreadarticledetail.php');
}


//function to include article list page

function spreadshop_article_list()
{
include(plugin_dir_path(__FILE__).'/spreadarticlelist.php');
}



// Register style and script
function register_plugin_styles() {
	wp_register_style( 'spreadshop_style', plugins_url( 'spreadshop/style/style.css' ) );
	wp_register_script( 'spreadshop_script', plugins_url( 'spreadshop/js/spreadshop.js' ) );
	wp_enqueue_style( 'spreadshop_style' );
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'spreadshop_script' );
}

// function to get basket data and hand it over to client

function get_basket()
		{
		include("authheaders.php");
		$basketURL=$_COOKIE["basket"];
		$header[] = createSprdAuthHeader("Get", $basketURL);
		$header[] = "Content-Type: application/xml";
		$ch = curl_init($basketURL);
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		$result = curl_exec($ch);
		$result=new SimpleXMLElement($result);
		echo $result->asXML();
		curl_close($ch);
		die();
		}
		
function add_to_basket()
		{
		parse_str($_POST['data'], $article_data);
		include("authheaders.php");
		if (isset($_COOKIE["basket"]))
		{
		$basketURL=$_COOKIE["basket"];
		}
		else
		{$basketURL=create_Basket();
		}
		
		$basketItemsURL = $basketURL . "/items";
			$basketItem = new SimpleXmlElement('<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
					<basketItem xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://api.spreadshirt.net">
					<quantity>1</quantity>
					<element id="'.$article_data["articleID"].'" type="sprd:article" xlink:href="http://api.spreadshirt.de/api/v1/shops/'.get_option('spreadshop_shop_id').'/articles/'.$article_data["articleID"].'">
					<properties>
					<property key="appearance">'.$article_data["appearanceID"].'</property>
					<property key="size">'.$article_data["size"].'</property>
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
	echo $basketURL;		
	die();
	}
		
function create_Basket()
{
$basketURL="http://api.spreadshirt.net/api/v1/baskets";
$basket = new SimpleXmlElement('<basket xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://api.spreadshirt.net">
					<shop id="'.get_option('spreadshop_api_key').'"/>
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

function add_producttype_to_basket()
{

$productID=create_product();

		if (isset($_COOKIE["basket"]))
		{
		$basketURL=$_COOKIE["basket"];
		}
		else
		{$basketURL=create_Basket();
		}
		echo $basketURL;
		$basketItemsURL = $basketURL . "/items";
			$basketItem = new SimpleXmlElement('<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
					<basketItem xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://api.spreadshirt.net">
					<quantity>1</quantity>
					<element id="'.$productID.'" type="sprd:product" xlink:href="http://api.spreadshirt.de/api/v1/shops/'.get_option('spreadshop_shop_id').'/products/'.$productID.'">
					<properties>
					<property key="appearance">1</property>
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
//	return $basketURL;		
	die();
}



// function to create a product using the spreadshirt api. retunrs url to created product
//To Do: remove hardcoded producttype data
function create_product()
{
include("authheaders.php");
$createProductURL='http://api.spreadshirt.net/api/v1/shops/'.get_option('spreadshop_shop_id').'/products';
$productData = new SimpleXmlElement('<product xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://api.spreadshirt.net">
<productType id="6"/>
<appearance id="1"/>
<size id="12"/>
<restrictions>
<freeColorSelection>false</freeColorSelection>
<example>false</example>
</restrictions>
</product>');
	$header = array();
	$header[] = createSprdAuthHeader("POST", $createProductURL);
	$header[] = "Content-Type: application/xml";
	$ch = curl_init($createProductURL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $productData->asXML());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
	$result = parseHttpHeaders(curl_exec($ch),"Location");
	curl_close($ch);
	$result = explode('products/', $result);
	return $result[1];		
	die();
	}


?>



