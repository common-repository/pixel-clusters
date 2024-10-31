// JavaScript Document

jQuery(document).ready(function(){
	
	jQuery('#cat').on('change', function() {
  		pixel_cluster_code();
	});
	
	jQuery('#tag').on('change', function() {
  		pixel_cluster_code();
	});

});

function pixel_cluster_change_type()
{
	var type = jQuery('#type').val();
	
	jQuery('.type-select').hide();
	
	jQuery('#type'+ type).fadeIn();
	
	pixel_cluster_code();
}

function pixel_cluster_code()
{
	var type = pixel_cluster_variable( jQuery('#type').val() );
	var mode = pixel_cluster_variable( jQuery('#mode').val() );
	var number = pixel_cluster_variable( jQuery('#number').val() );
	var tag_id = '';
	
	if(type == 1)
	{
		tag_id = pixel_cluster_variable( jQuery('#cat').val() );
	}
	else if(type == 2)
	{
		tag_id = pixel_cluster_variable( jQuery('#tag').val() );
	}
	
	jQuery('#code-generate').html('[cluster type="'+ type +'" tag_id="'+ tag_id +'"  modo="'+ mode +'" numero="'+ number +'"]');	
}

function pixel_cluster_variable(data)
{
	if(data === null)
	{
		data = '';
	}
	
	return data;
}

function pixel_copyToClipboard(elemento) 
{
	var temp = jQuery("<input>")
	jQuery("body").append(temp);
	temp.val(jQuery(elemento).text()).select();
	document.execCommand("copy");
	temp.remove();
	
	jQuery('#success').html('').show();
	jQuery('#success').html('Shortcode was copied!').fadeOut(2000);
}