<script>
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>"
</script>
<?php
include('datahandler.php');
//include('basket.php');
echo '<div id="basket"></div>';
if (isset($_GET['articleid']))
	{
	$article_id=$_GET['articleid'];
	$article =  get_article_data($article_id);
	$arr_params = array( "article" => (string)$article_id,"name" => (string)$article->name);
	$permalink = get_permalink( get_option('spreadshop_designer_page') );
    write_article($article_id, $article,$arr_params,$permalink);
	}
else
	{
	echo '<p>No Article defined</p>';
	break;
	}

function write_article($article_id, $article,$arr_params,$permalink)
{
$producttype = get_producttype_data($article->product->productType->attributes()->id);
echo '<form action="/" id="'.$article->attributes()->id.'" class="article">';
echo '<div>'.$article->name.'</div>';
echo '<div><img src="'.$article->resources->resource->attributes('http://www.w3.org/1999/xlink').',width=280,height=280" \></div>';
echo '<div><a title="'.$article->name.' von '.$article->brand.' selbst gestalten und bedrucken lassen" href="'.add_query_arg( $arr_params,$permalink ).'">Produkt gestalten</a></div>';
echo '<div>'.$article->name.'</div>';
echo '<div>'.$article->brand.'</div>';
echo '<div>'.$article->description.'</div>';
echo '<div><ul>';
foreach ($producttype->appearances->appearance as $appearance)
	{
	echo '<li><div id="'.$appearance->attributes()->id.'">'.$appearance->colors->color.'</div></li>';
	}
echo '</ul></div>';

echo '<form id="'.$article->attributes()->id.'" class="article" action="">';
	
	
	echo   '<select name="size" ';
foreach ($producttype->sizes->size as $size)
	{
	echo '<option class="size" value="'.$size->attributes()->id.'">'.$size->name.'</option>';
		}
    echo '</select>';
	echo '<input name="articleID" value="'.$article->attributes()->id.'"></input>';
	echo '<input name="appearanceID" value="'.$article->product->appearance->attributes()->id.'"></input>';
    echo '<input  type="submit" class="addtobasket"/>';
	echo '</form>';
echo '<div>';
}
?>