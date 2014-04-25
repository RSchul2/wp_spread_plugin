<?php
include('datahandler.php');
include('basket.php');
$currentpage=(isset($_GET['pageid'])?$_GET['pageid']:1);
$article_department_id=(isset($_GET['did'])?$_GET['did']:false);  
$article_category_id=(isset($_GET['cid'])?$_GET['cid']:false);  
$article_list_data =  get_article_list_data($currentpage,$article_department_id,$article_category_id);
write_article_list($article_list_data);

function write_article_list($article_list_data)
{
echo '<div id="spreadshop">';
echo '<ul>';
foreach ($article_list_data->article as $article)
	{
	$producttypeID= $article->product->productType->attributes()->id;
 	$producttype = get_producttype_data($producttypeID);
	$arr_params_designer = array( "articleid" => (string)$article->attributes()->id,"name" => (string)$article->name.'-'.$producttype->name);
	$permalink_designer = get_permalink( get_option('spreadshop_designer_page') );
	$arr_params_articledetail = array( "articleid" => (string)$article->attributes()->id,"name" => (string)$article->name.'-'.$producttype->name);
	$permalink_articledetail = get_permalink( get_option('spreadshop_article_detail_page'));
	echo '<li>';
	echo '<div><a title="'.$producttype->name.'" alt="'.$producttype->name.'" href="'.add_query_arg( $arr_params_designer,$permalink ).'?article='.$article->attributes()->id.'&article-name='.$article->name.'&producttype-name='.$producttype->name.'" title="'.$article->name.'"></div>';
	echo '<div><img src="'.$article->resources->resource->attributes('http://www.w3.org/1999/xlink').',width=280,height=280"></a></div>';
	echo '<div>'.$producttype->name.'</div>';
	echo '<div>'.$article->name.'</div>';
	echo '<div>'.$article->price->vatIncluded.'</div>';
	echo '<div><a href="'.add_query_arg( $arr_params_designer,$permalink_designer ).'" title="'.$article->name.'">Artikel umgestalten</a></div>';
	echo '<div><a href="'.add_query_arg( $arr_params_articledetail,$permalink_articledetail ).'" title="'.$article->name.'">Artikeldetails</a></div>';
	echo '</li>';
	}
	;
echo '</ul>';
echo '</div>';
}	
?>