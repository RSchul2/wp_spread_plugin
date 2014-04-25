jQuery( document ).ready(function() {
//function to get basket on document load								  
jQuery.get( "wp-content/plugins/spreadshop/basket.php?action=getBasket", function( data ) {});


jQuery(".article").click(function(event){
event.preventDefault();			
jQuery.post( "wp-content/plugins/spreadshop/basket.php?action=add",console.log (this), function( data ) {
																										
setCookie(data,30)
});
});

jQuery("#viewbasket").click(function(){
jQuery.get( "wp-content/plugins/spreadshop/basket.php?action=getBasket", function( data ) {
data=jQuery.parseJSON(data)
console.log(data["links"])
});

});



function setCookie(cvalue,exdays)
{
var d = new Date();
d.setTime(d.getTime()+(exdays*24*60*60*1000));
var expires = "expires="+d.toGMTString();
document.cookie = "basket" + "=" + cvalue + "; " + expires;
} 

function getCookie()
{
var name = "basket" + "=";
var ca = document.cookie.split(';');
for(var i=0; i<ca.length; i++)
  {
  var c = ca[i].trim();
  if (c.indexOf(name)==0) return c.substring(name.length,c.length);
  }
return "";
}

function loadBasket(basketURL)
{
jQuery.post( "wp-content/plugins/spreadshop/basket.php?action=getBasket",basketURL);	
}

});