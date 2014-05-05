<script>
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>"
</script>
<?php
include('datahandler.php');
//include('basket.php');

if (isset($_GET['producttypeid']))
	{
	$producttype_id=$_GET['producttypeid'];
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

echo '<form id="add_producttype_to_basket" class="article" action="">';
echo   '<select name="size" ';
foreach ($producttype->sizes->size as $size)
	{
	echo '<option class="size" value="'.$size->attributes()->id.'">'.$size->name.'</option>';
		}
    echo '</select>';
	echo '<input name="producttypeID" value="'.$producttype->attributes()->id.'"></input>';
	echo '<input name="appearanceID" value="'.$producttype->appearance->attributes()->id.'"></input>';
    echo '<input  type="submit" id="add_producttype_to_basket"/>';
	echo '</form>';


}
?>