<?php
if (isset($_GET['articleid'])){$finaldeeplink='-A'.$_GET['articleid'];}
if (isset($_GET['product'])){$finaldeeplink='customize/product/'.$_GET['product'];} 
if (isset($_GET['design'] )) {$finaldeeplink='-T6I'.$_GET['design'];}
if (isset($_GET['producttypeid'])){$finaldeeplink='-T'.$_GET['producttypeid'];}
if (isset($_GET['design']) && isset($_GET['producttype'])) {$finaldeeplink='-T'.$_GET['producttype'].'I'.$_GET['design'];}
include('datahandler.php');
echo '<iframe   id="spreadshop" src="http://'.get_option('spreadshop_shop_id').'.spreadshirt.de/'.$finaldeeplink.'"></iframe>';
?>