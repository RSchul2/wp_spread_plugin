<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<script>
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>"
</script>
<?php
include('datahandler.php');
//include('basket.php');
echo '<div id="basket"></div>';
$currentpage=(isset($_GET['pageid'])?$_GET['pageid']:1);
$article_department_id=(isset($_GET['did'])?$_GET['did']:false);  
$article_category_id=(isset($_GET['cid'])?$_GET['cid']:false);  
$article_list_data =  get_article_list_data($currentpage,$article_department_id,$article_category_id);
write_article_list($article_list_data);

function write_article_list($article_list_data)
{
echo '<div id="spreadshop">';
echo '<ul class="articlelist">';
foreach ($article_list_data->article as $article)
	{
	$producttypeID= $article->product->productType->attributes()->id;
 	$producttype = get_producttype_data($producttypeID);
	$arr_params_designer = array( "articleid" => (string)$article->attributes()->id,"name" => (string)$article->name.'-'.$producttype->name);
	$permalink_designer = get_permalink( get_option('spreadshop_designer_page') );
	$arr_params_articledetail = array( "articleid" => (string)$article->attributes()->id,"name" => (string)$article->name.'-'.$producttype->name);
	$permalink_articledetail = get_permalink( get_option('spreadshop_article_detail_page'));
	echo '<li class="article">';
	echo '<div><a title="'.$producttype->name.'" alt="'.$producttype->name.'" href="'.add_query_arg( $arr_params_designer,$permalink_designer ).'?article='.$article->attributes()->id.'&article-name='.$article->name.'&producttype-name='.$producttype->name.'" title="'.$article->name.'"></div>';
	echo '<div><img src="'.$article->resources->resource->attributes('http://www.w3.org/1999/xlink').',width=280,height=280"></a></div>';
	echo '<div>'.$producttype->name.'</div>';
	echo '<div>'.$article->name.'</div>';
	echo '<div>'.$article->price->vatIncluded.'</div>';
	echo '<div><a href="'.add_query_arg( $arr_params_designer,$permalink_designer ).'" title="'.$article->name.'">Artikel umgestalten</a></div>';
	echo '<div><a href="'.add_query_arg( $arr_params_articledetail,$permalink_articledetail ).'" title="'.$article->name.'">Artikeldetails</a></div>';
	
	echo '<form id="add_to_basket" class="article" action="">';
	
	
	echo   '<select name="size" ';
foreach ($producttype->sizes->size as $size)
	{
	echo '<option class="size" value="'.$size->attributes()->id.'">'.$size->name.'</option>';
		}
    echo '</select>';
	echo '<input name="articleID" value="'.$article->attributes()->id.'"></input>';
	echo '<input name="appearanceID" value="'.$article->product->appearance->attributes()->id.'"></input>';
    echo '<input  type="submit" id="add_to_basket"/>';
	echo '</form>';
	echo '</li>';
	}
	;
echo '</ul>';
echo '</div>';

}	
?>