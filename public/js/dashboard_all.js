function showRequestCover(formData, jqForm, options) { 
	
} 
function showResponseCover(response, statusText, xhr, $form)  { 
	$('#cover_picture_container').html("");
	$('#cover_picture_container').append($('#cover_picture'));
	$('#cover_pic_preview').attr("src", response.file);
	$('#cover_photo').val(response.file);
}

$(document).ready(function() {
	var options = { 
        beforeSubmit:  showRequestCover,
		success:       showResponseCover,
		dataType: 'json' 
        }; 

 	$('body').delegate('#cover_picture','change', function(){

 		$('#file_upload').attr("checked", "checked");
 		//move file
 		$('#upload').append($('#cover_picture'));
 		$('#cover_picture_container').append("<img src='/uploads/ajax-loader.gif'/>");
 		$('#upload').ajaxForm(options).submit();  		
 	});
 	
 	$('#meta_add_btn').click(function() {
 		$('#meta_modal_label').html("Add Meta");

 		$('#meta_edit_mode').val(0);
 		$('#meta_id').val("");
 		$('#meta_type').val("");
 		$('#meta_value').val("");
 		$('#meta_content').val("");
 	})

 	$('.edit-meta-btn').click(function() {
 		$('#meta_modal_label').html("Edit Meta");

 		$('#meta_edit_mode').val(1);
 		meta_sel = $(this).parent().parent();
 		$('#meta_id').val(meta_sel.find('td:eq(0)').html());
 		$('#meta_type').val(meta_sel.find('td:eq(1)').html());
 		$('#meta_value').val(meta_sel.find('td:eq(2)').html());
 		$('#meta_content').val(meta_sel.find('td:eq(3)').html());
 	})
});	

