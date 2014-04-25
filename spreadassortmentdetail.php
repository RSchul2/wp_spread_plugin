
<form id="test">
<input  type="button" id="addtobasket" />
<input id="shopID" value="500316" />
</form>

<form id="test2">
<input  type="button" id="viewbasket" name="viewbasket"/>
<input id="shopID" value="500316" />
</form>

<?php
include('datahandler.php');
include('basket.php');

if (isset($_GET['produktid']))
	{
	$producttype_id=$_GET['produktid'];
	$producttype =  get_producttype_data($producttype_id);
	$arr_params = array( "producttype" => (string)$producttype_id,"name" => (string)$producttype->name);
	$permalink = get_permalink( get_option('spreadshop_designer_page') );
    write_producttype($producttype_id, $producttype,$arr_params,$permalink);
	}
else
	{
	echo '<p>No Producctype defined</p>';
	break;
	}

function write_producttype($producttype_id, $producttype,$arr_params,$permalink)
{
echo '<div class="producttype_data">';
echo '<div>'.$producttype->name.'</div>';
echo '<div><img src="'.$producttype->resources->resource->attributes('http://www.w3.org/1999/xlink').',width=280,height=280" \></div>';
echo '<div><a title="'.$producttype->name.' von '.$producttype->brand.' selbst gestalten und bedrucken lassen" href="'.add_query_arg( $arr_params,$permalink ).'">Produkt gestalten</a></div>';
echo '<div>'.$producttype->name.'</div>';
echo '<div>'.$producttype->brand.'</div>';
echo '<div>'.$producttype->description.'</div>';
echo '<div><ul>';
foreach ($producttype->appearances->appearance as $appearance)
	{
	echo '<li><div id="'.$appearance->attributes()->id.'">'.$appearance->colors->color.'</div></li>';
	}
echo '</ul></div>';
echo '<div>';
echo '<img style="float:left" src="http://image.spreadshirt.net/image-server/image/producttype/'.$producttype->attributes()->id.'/size/"/></li>';		
echo '<ul>';
foreach ($producttype->sizes->size as $size)
	{
	echo '<li class="size">'.$size->name.'</li>';
	echo '<ul>';
	foreach ($size->measures->measure as $measure)
		{
		echo '<li>'.$measure->name.'-'.$measure->value.$measure->value->attributes()->unit.'</li>';
		}
	echo '</ul>';			
	}
echo '</ul></div>';
}
?>