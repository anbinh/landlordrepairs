
function add_to_album(obj_input) {
    $.ajax({
      type: "POST",
      url: "/dashboard/addphoto",
      data: {description: obj_input.attr("data"),img_url: obj_input.attr("data"), album_id: $('#album_id_input').val()},
      success: function(result) {
        obj_input.prop('checked', false);
        obj_append = obj_input.parent().clone();
        obj_append.find('.chosen_pics').attr("photo_id", result.photo_id);
        obj_append.appendTo("#album_photos_list");

        $('#add_to_album').show();
        $('#add_to_album').next().remove();

      },
      dataType: "json"
    });
}

$('#add_to_album').click(function() {
    $(this).hide();
    $(this).parent().append("<img src='/uploads/ajax-loader.gif'/>");
    num = $('.chosen_pics:checked').length;

    for(i=0;i<num;i+=1) {
        obj_input = $('.chosen_pics:checked:eq('+i+')');
        add_to_album(obj_input);
    }
});

$('#edit_lyrics_btn').click(function() {
    lyrics = $('#lyrics').val();
    lyric_rows = lyrics.split("\n");
    for (i=0; i<lyric_rows.length; i+=1) {
        if(lyric_rows[i].trim() != "") {
            lyric_temp = $('#lyric_btn_template').html();
            lyric_temp = lyric_temp.replace("[[lyric]]", lyric_rows[i].trim());
            $('#lyric_show_btn').append(lyric_temp);
        }
    }
});

// Get User
hello.on('auth.login', function(auth){

    // Get Profile
    hello.api(auth.network+':me', function(r){
        if(!r||r.error){
            return;
        }
        //document.getElementById(auth.network).innerHTML = "Get Albums from " + r.name + " at "+auth.network+"";
    });
});

// Initiate hellojs
//CLIENT_IDS.flickr = FLICKR_CLIENT_ID;
hello.init( CLIENT_IDS_ALL, {
    scope: "files, photos",
    redirect_uri : "/redirect.html",
    oauth_proxy : OAUTH_PROXY_URL
});

function getAlbums(network){

    $('#album_photo_container').html("");
    $('#message_error_box_msg').remove();
    var list;
    //
    // Setting force:false means we'll only trigger auth flow if the user is not already signed in with the correct credentials
    //alert("ddd");
    hello( network ).login({
        force:true
    },function(auth){

        // Get albums
        hello.api( network+':me/albums', function(r){

            if(!r||r.error){
                message(list, "Could not open albums from "+network+", try resigning in");
                return;
            }
            else if(!r.data||r.data.length===0){
                message(list, "There are no albums in the users account");
                return
            }

            // Build buttons with the albums
            for(var i=0;i<r.data.length;i++){
                buildAlbumBtn( r.data[i], network );
            }
        });
    });

}

// Create a button selecting the album
function buildAlbumBtn(item, network){

    // Target where to put the list of albums
    var list = document.getElementById('album_photo_container');

    // construct the button
    var o = document.createElement('button');
    o.className = "btn btn-info";
    o.style.margin = "3px 3px 3px 3px";
    o.innerHTML = item.name;

    // Add the controls
    o.onclick = function(){
        // Trigger get 
        getPhotos( network, item.id );
        //alert(network + item.id);
    };

    // Append to the list
    list.appendChild(o);
}

function getPhotos(network, id){
    $('#album_photo_container').html("");
    var list = $('#album_photo_container').append("<ul id='album_photo_container_list' style='padding:0px'></ul>");
    list = $('#album_photo_container_list');
    list.innerHTML = 'ffs'; // flush its content

    var path;
    var params;
    if (network == "flickr") {
        path = '/';
        params = {
            method : 'flickr.photosets.getPhotos',
            photoset_id : id,
            format : 'json',
            id: id,
            limit:100
        };
    }

    if (network == "facebook") {
        path = 'me/album';
        params = {
            id: id,
            limit:100
        };
    }

    hello( network ).api(path, params, function(r){
        //alert(JSON.stringify(r));
        if(r.error){
            message(list, r.error.message);
            return;
        }
        else if(!r.data||r.data.length===0){
            message(list, "There are no photos in this album");
            return
        }

        if(r.data.length == 0) {
            message(list, "There are no photos in this album");
        }

        // Create a new image in the DOM, give it some randomness and insert it into the dom.
        for(var i=0;i<r.data.length;i++){
            buildPhotoThumnail( r.data[i] );
        }       

    });
}

function buildPhotoThumnail(item){
    //alert(JSON.stringify(item));

    var list = $('#album_photo_container_list');

    template = $('.photo_item_template').html();

    template = template.replace("[[title]]", item.name);
    template = template.replace("[[title]]", item.name);
    template = template.replace("[[src]]", item.source);
    template = template.replace("[[src]]", item.source);

    /*
    var o = document.createElement('img');
    o.src = item.thumbnail;
    o.title = item.name;
    o.className = "photo-thumnail";
    */

    // Append to the list
    //alert(template);
    list.append(template);
}

function buildPhotoThumnailPhotoAlbum(item){
    //alert(JSON.stringify(item));
    item= jQuery.parseJSON(item);

    var list = $('#album_photos_list');

    template = $('#album_photo_item_template').html();

    template = template.replace("[[url]]", item.url);
    template = template.replace("[[url]]", item.url);
    template = template.replace("[[photo_id]]", item.photo_id);

    //alert(template);

    /*
    var o = document.createElement('img');
    o.src = item.thumbnail;
    o.title = item.name;
    o.className = "photo-thumnail";
    */

    // Append to the list
    //alert(template);
    list.append(template);
}

// Report any notifications to the containing element
function message(target, str){
    $('#message_error_box').prepend('<div class="alert alert-danger alert-dismissable" id="message_error_box_msg"><button type="button" class="close" data-dismiss="alert" aria-hidden="false">×</button>' + str + "</div>");
    $('#message_error_box').fadeIn(20);
}

    var $dropzone = $('.image_picker'),
    $droptarget = $('.drop_target'),
    $dropinput = $('#up_album_photo'),
    $dropimg = $('.image_preview'),
    $remover = $('[data-action="remove_current_image"]');

$dropzone.on('dragover', function() {
  $droptarget.addClass('dropping');
  return false;
});

$dropzone.on('dragend dragleave', function() {
  $droptarget.removeClass('dropping');
  return false;
});

$dropzone.on('drop', function(e) {
  $droptarget.removeClass('dropping');
  $droptarget.addClass('dropped');
  $remover.removeClass('disabled');
  e.preventDefault();
  
  var file = e.originalEvent.dataTransfer.files[0],
      reader = new FileReader();

  reader.onload = function(event) {
    $dropimg.css('background-image', 'url(' + event.target.result + ')');
  };
  
  console.log(file);
  reader.readAsDataURL(file);

  return false;
});

$dropinput.change(function(e) {
  $droptarget.addClass('dropped');
  $remover.removeClass('disabled');
  $('.image_title input').val('');
  
  var file = $dropinput.get(0).files[0],
      reader = new FileReader();
  
  reader.onload = function(event) {
    $dropimg.css('background-image', 'url(' + event.target.result + ')');
  }
  
  reader.readAsDataURL(file);
});

$remover.on('click', function() {
  $dropimg.css('background-image', '');
  $droptarget.removeClass('dropped');
  $remover.addClass('disabled');
  $('.image_title input').val('');
});

$('.image_title input').blur(function() {
  if ($(this).val() != '') {
    $droptarget.removeClass('dropped');
  }
});//@ sourceURL=pen.js

function showRequestAlPh(formData, jqForm, options) { 
    
} 
function showResponseAlPh(response, statusText, xhr, $form)  { 
    $('#upload_to_album_btn').show();
    $('#upload_to_album_btn').next().remove();

    var list = $('#album_photos_list');

    template = $('.photo_item_template').html();

    template = template.replace("[[title]]", response.description);
    template = template.replace("[[title]]", response.description);
    template = template.replace("[[src]]", response.url);
    template = template.replace("[[src]]", response.url);
    template = template.replace("[[photo_id]]", response.photo_id);

    /*
    var o = document.createElement('img');
    o.src = item.thumbnail;
    o.title = item.name;
    o.className = "photo-thumnail";
    */

    // Append to the list
    //alert(template);
    list.append(template);
}

$(document).ready(function() {
    var options = { 
        beforeSubmit:  showRequestAlPh,
        success:       showResponseAlPh,
        dataType: 'json' 
        }; 

    $('body').delegate('#upload_to_album_btn','click', function(){
        $('#upload_to_album_btn').parent().append("<img src='/uploads/ajax-loader.gif'/>");
        $('#upload_to_album_btn').hide();
        $('#photo_upload_form').ajaxForm(options).submit();         
    });

    $('#del_from_album').click(function() {
        num = $('#album_photos_list').find('.chosen_pics:checked').length;

        if(num == 0) {
            alert("Please select images to delete");
            return;
        }
        if(!confirm("Are you sure to delete " + num + " photos from this album?")) {
            return;
        }

        for(i=0;i<num;i+=1) {
            obj_input = $('#album_photos_list').find('.chosen_pics:checked:eq('+i+')');
            del_from_album(obj_input);
        }
    });

    function del_from_album(obj_input) {
        $.ajax({
          type: "POST",
          url: "/dashboard/delphoto",
          data: {photo_id: obj_input.attr("photo_id"), album_id: $('#album_id_input').val()},
          success: function(result) {
            obj_input.parent().remove();
          },
          dataType: "json"
        });
    }

    $('#load_lyrics_btn').click(function() {
        //alert("here");
        $.ajax({
          type: "GET",
          url: "/dashboard/findlyrics/" + $('#music_link').val(),
          success: function(result) {
            if(result.error) {
                alert("No lyrics found.");
                return;
            }
            $('#lyrics').html(result.lyrics);
          },
          error: function() {
            alert("No lyrics found.");
          },
          dataType: "json"
        });        
    });

    $('#set_cover_album').click(function() {
        num = $('#album_photos_list').find('.chosen_pics:checked').length;
        if(num == 0) {
            alert("Please select one picture.");
            return;
        }
        if(num > 1) {
            alert("You can only select one picture.");
            return;
        }


        obj_input = $('#album_photos_list').find('.chosen_pics:checked:eq(0)');
        img_url = obj_input.attr("data");
        $('#cover_pic_preview').attr('src', img_url);

        $('#cover_photo').val(img_url);

    });

    $('#update_cover_btn').click(function() {
        $('#update_form_btn').click();
    });

    var myDropzone = new Dropzone("#my-dropzone");
    myDropzone.on("addedfile", function(file) {
        /* Maybe display some more file information on your page */
    });
    myDropzone.on("success", function(file, response) {
        //alert(response);
        buildPhotoThumnailPhotoAlbum(response);
        //myDropzone.removeFile(file);
    });

    $('#lyrics_fetch_btn').click(function() {
        $.ajax({
          type: "POST",
          url: "/dashboard/findlyricsbytitle",
          data: {song_title: $('#song_title').val(), song_artist: $('#song_artist').val()},
          success: function(result) {
            if(result.error) {
                alert("No lyrics found.");
                return;
            }
            $('#lyrics').html(result.lyrics);
            //alert(result.lyrics);
            $('#lyrics_fetch_modal').modal('hide');

          },
          dataType: "json"
        });        
        
    });

}); 
