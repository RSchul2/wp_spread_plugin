
<?php
include('datahandler.php');
include('basket.php');
// store get parameters to define content to be displayed
$currentpage=(isset($_GET['pageid'])?$_GET['pageid']:1);
$current_department_id=(isset($_GET['did'])?$_GET['did']:"all");  
$current_category_id=(isset($_GET['cid'])?$_GET['cid']:"all");  
$itemcount=0;
global $itemcount;
//$assortment_navi_data= get_assortment_navi_data();
write_assortment_navigation();
write_producttype_list(get_list_of_producttypes($current_department_id,$current_category_id,$currentpage));
write_assortment_pagination($currentpage);



// function to get a list of producttypes (id only), based on department and/or category - list of id's can later be handed to function to get and actually render the data
function get_list_of_producttypes($current_department_id,$current_category_id,$currentpage)
{
$data = array();
global $itemcount;
if($current_department_id!="all")
	{
	$temp_data=get_producttype_list_by_department($current_department_id);
		foreach($temp_data->categories->category as $category)
		{
		if ($assortment_category_id=="all" || $current_category_id==$category->attributes()->id)
			{
			foreach ($category->productTypes->productType as $productType )
				{
				array_push($data,$productType->attributes()->id);
				}
			}
		}
	
	}
else
	{
	$temp_data=get_producttype_list($currentpage);
	foreach($temp_data->productType as $productType)
		{
		array_push($data,$productType->attributes()->id);
		}
	}



$itemcount=sizeof($data);
return $data;	
}



function write_assortment_navigation()
{
$departmentrequest = get_department_list();
echo '<ul id="menu">';
foreach ($departmentrequest->productTypeDepartment as $departmentID)
{
$departmentnamerequest= get_department_data($departmentID->attributes()->id);
$did=(string)$departmentID->attributes()->id;
$arr_params = array( "did" => $did);
echo '<li><a  rel="tab" title="Produkte f&uuml;r '.$departmentnamerequest->name.' selber gestalten und bedrucken lassen" href="'.add_query_arg( $arr_params ).'">'.$departmentnamerequest->name.'</a>'; 
echo '<ul class="departmentsubnavi"id="department-'.$departmentID->attributes()->id.'" style="display:inline;">';
foreach($departmentnamerequest->categories->category as $category)
	{
	$did=(string)$departmentID->attributes()->id;
	$cid=(string)$category->attributes()->id;
	$arr_params = array( "did" => $did, "cid" =>$cid);
	echo '<li  class="lhsNaviLevel2"><a rel="tab" title="Produkte f&uuml;r '.$departmentnamerequest->name.' aus der Kategorie -'.$category->name.'- im &Uuml;berblick" href="'.add_query_arg( $arr_params ).'">'.$category->name.'</a></li>';
	}
echo '</li></ul>';
} 
echo '</li></ul>';
}

function write_assortment_pagination($currentpage)
{

global $itemcount;
$number_pages=ceil($itemcount/get_option('spreadshop_items_per_page'));

echo '<div class="pagination">';
echo 'Seite:';
for ($i = 1; $i < $number_pages; $i++)
			{
			$did=(string)$deeplinkparameter;
			$pageID=(string)$i;
			$arr_params = array( "did" => $did, "pageID" => $pageID);
				
			if ($currentpage== $i)
				{
				echo '<a class="paginationactive" href="'.add_query_arg( $arr_params ).'">'.$i.'</a>';
				}
			else
				{
				echo '<a class="" href="'.add_query_arg( $arr_params ).'">'.$i.'</a>';
				}
			}
		echo '</div>';
		}



//-----------------------------------------------------------
function write_producttype_list($producttype_list)
{
echo '<div id="spreadshop">';
echo '<ul>';
foreach ($producttype_list as $value)
	{
 	$producttype = get_producttype_data($value);
	$arr_params_designer = array( "producttypeid" => (string)$producttype->attributes()->id,"name" => (string)$producttype->name.'-'.$producttype->name);
	$permalink_designer = get_permalink( get_option('spreadshop_designer_page') );
	$arr_params_producttypedetail = array( "producttypeid" => (string)$producttype->attributes()->id,"name" => (string)$producttype->name.'-'.$producttype->name);
	$permalink_producttypedetail = get_permalink( get_option('spreadshop_producttype_detail_page'));
	echo '<li>';
	echo '<div><a title="'.$producttype->name.'" alt="'.$producttype->name.'" href="'.add_query_arg( $arr_params_designer,$permalink ).'?producttype='.$producttype->attributes()->id.'&producttype-name='.$producttype->name.'&producttype-name='.$producttype->name.'" title="'.$producttype->name.'">';
	echo '<div><img src="'.$producttype->resources->resource->attributes('http://www.w3.org/1999/xlink').',width=280,height=280"></a></div>';
	echo '<div>'.$producttype->name.'</div>';
	echo '<div>'.$producttype->name.'</div>';
	echo '<div>'.$producttype->price->vatIncluded.'</div>';
	echo '<div><a href="'.add_query_arg( $arr_params_designer,$permalink_designer ).'" title="'.$producttype->name.'">Artikel umgestalten</a></div>';
	echo '<div><a href="'.add_query_arg( $arr_params_producttypedetail,$permalink_producttypedetail ).'" title="'.$producttype->name.'">Artikeldetails</a></div>';
echo '</li>';	
				}
echo '</ul>';
echo '</div>';		
			}
		
	
	

?>

