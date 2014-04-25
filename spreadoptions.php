<?php
// create custom plugin settings menu
spreadshop_settings_page();
function spreadshop_settings_page() {
?>
<div class="wrap">
<h2>Spreadshop Plugin</h2>

<form method="post" action="options.php">

    <?php settings_fields( 'spreadshop-settings-shop' ); ?>
    <?php do_settings_sections( 'spreadshop-settings-shop' ); ?>
	
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Items per page</th>
        <td><input type="text" name="spreadshop_items_per_page" value="<?php echo get_option('spreadshop_items_per_page'); ?>" /></td>
        </tr>
		<tr valign="top">
        <th scope="row">pageID Designer</th>
        <td><input type="text" name="spreadshop_designer_page" value="<?php echo get_option('spreadshop_designer_page'); ?>" /></td>
        </tr>
	    <tr valign="top">
        <th scope="row">pageID Product List</th>
        <td><input type="text" name="spreadshop_product_list_page" value="<?php echo get_option('spreadshop_product_list_page'); ?>" /></td>
        </tr>
		<tr valign="top">
        <th scope="row">pageID Product Detail</th>
        <td><input type="text" name="spreadshop_product_detail_page" value="<?php echo get_option('spreadshop_product_detail_page'); ?>" /></td>
        </tr>
		
		<tr valign="top">
        <th scope="row">pageID Article List</th>
        <td><input type="text" name="spreadshop_article_list_page" value="<?php echo get_option('spreadshop_article_list_page'); ?>" /></td>
        </tr>
		<tr valign="top">
        <th scope="row">pageID Article Detail</th>
        <td><input type="text" name="spreadshop_article_detail_page" value="<?php echo get_option('spreadshop_article_detail_page'); ?>" /></td>
        </tr>
		
	    <tr valign="top">
        <th scope="row">Shop Id</th>
        <td><input type="text" name="spreadshop_shop_id" value="<?php echo get_option('spreadshop_shop_id'); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Shop Key</th>
        <td><input type="text" name="spreadshop_api_key" value="<?php echo get_option('spreadshop_api_key'); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Shop Secret</th>
        <td><input type="text" name="spreadshop_api_secret" value="<?php echo get_option('spreadshop_api_secret'); ?>" /></td>
        </tr>
		 <tr valign="top">
        <th scope="row">Shop Language</th>
        <td><input type="text" name="spreadshop_language" value="<?php echo get_option('spreadshop_language'); ?>" /></td>
        </tr>
		 <tr valign="top">
        <th scope="row">Shop Locale</th>
        <td><input type="text" name="spreadshop_locale" value="<?php echo get_option('spreadshop_locale'); ?>" /></td>
        </tr>
		<tr valign="top">
        <th scope="row">Shop Domain</th>
        <td><input type="text" name="spreadshop_domain" value="<?php echo get_option('spreadshop_domain'); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php }
?>