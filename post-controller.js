
// Add Post Jquery Ajax Function
$(document).on('click','#btn_sub', function(){
    var PostTxt =  $('#post-txt').val();
    var UserId = $(this).data('userid');

    var PostLocation = $('.mapboxgl-ctrl-geocoder--input').val();

    // Checks if theres is empty file  input
    if(document.getElementById("photo_post").files.length !== 0){

        var PostPic = document.getElementById("photo_post").files[0].name;

        var form_data = new FormData();
        var ext = PostPic.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)  
        {
        alert("Invalid Image File");
        }

        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("photo_post").files[0]);
        var f = document.getElementById("photo_post").files[0];
        var fsize = f.size||f.fileSize;

        if(fsize > 2000000)
        {
        alert("Image File Size is very big");
        }
        else
        {
            form_data.append("photo_post", document.getElementById('photo_post').files[0]);
            form_data.append("post-txt", PostTxt);
            form_data.append("userid", UserId);
            form_data.append('post-location', PostLocation);
            form_data.append("func", 'savepost');
            // Checks if the input for Post is not Empty
            if(PostTxt !== ''){
                $.ajax({
                    url: 'post-controller.php',
                    method: 'post',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data:form_data,
                    enctype: 'multipart/form-data',
                    success: function(data){
                        $('.post-text').val(''); //Clears the input after clicking the Post Button
                        console.log('Success');
                        alert("Successfully Posted!");
                        //location.reload();
                    },
                    error: function(data){
                        console.log('There Something Wrong With Code!');
                    }
                });
            }
        }
}else{
    //Checks if Posttext is not empty
    if(PostTxt !== ''){
        $.ajax({
            url: 'post-controller.php',
            method: 'post',
            cache: false,
            data:{'func':'savepost', 'post-txt': PostTxt, 'userid': UserId, 'post-location' : PostLocation},
            success: function(data){
                $('.post-text').val(''); //Clears the input after clicking the Post Button
                console.log(data);
                alert("Successfully Posted!");
                location.reload();
            },
            error: function(data){
                console.log('There Something Wrong With Code!');
            }
        });
    }else{
        alert ('No Post Input Found, No Selected File');
    }
    
}//end
});//end



//Modal Tag Location on Post
$('.post-location').on('click', function(){
    //check first if the post input not empty else excute do nothing
    if($('#post-txt').val() !== ''){
        //opens bootstrap modal
        $('#post-tag-location-modal').modal('show');
    }

});


//Edit Post Jquery Ajax Function
$(document).on('click', '.edit-update-post', function(){
    var postid = $(this).data('postid');
    var userid = $(this).data('postuserid');
    var picname = $(this).data('picname');

    $('#user-post-title-'+postid).hide();
    $('#edit-title-post-'+postid).removeAttr("hidden");
    $('#img-edit-post-'+postid).removeAttr("hidden");
        
    $('#edit-title-post-'+postid).on('keypress', function(e){
        if(e.which == 13){
            
            var editedpost = $('#edit-title-post-'+postid).val();
            var oldpost = $('#old-title-post-'+postid).val();
            
            if(document.getElementById('img_edit_post_'+postid).files.length !== 0){
                var PostEditPic = document.getElementById('img_edit_post_'+postid).files[0].name;
                var form_data = new FormData();
                var ext = PostEditPic.split('.').pop().toLowerCase();
                if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
                {
                alert("Invalid Image File");
                }

                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById('img_edit_post_'+postid).files[0]);
                var f = document.getElementById('img_edit_post_'+postid).files[0];
                var fsize = f.size||f.fileSize;

                if(fsize > 2000000)
                {
                alert("Image File Size is very big");
                }
                else
                {
                    form_data.append("editedpic", document.getElementById('img_edit_post_'+postid).files[0]);
                    form_data.append("postid", postid);
                    form_data.append("editedpost", editedpost);
                    form_data.append("userid", userid);
                    form_data.append("picname", picname);
                    form_data.append("func", 'editpost');

                    alert(editedpost + ' - ' + PostEditPic);

                    $.ajax({
                        url: 'post-controller.php',
                        method: 'post',
                        processData: false,
                        contentType: false,
                        cache: false,
                        data:form_data,
                        enctype: 'multipart/form-data',
                        success: function(data){
                            console.log(data);
                            alert("Successfully Updated Post!");
                            location.reload();
                        },
                        error: function(data){
                            console.log('There Something Wrong With Code!');
                        }
                    });

                }
                
            }else{
                alert(editedpost);
                $.ajax({
                    url: 'post-controller.php',
                    method: 'post',
                    cache: false,
                    data:{'func':'editpost', 'postid': postid, 'userid': userid, 'picname': picname, 'editedpost': editedpost},
                    success: function(data){
                        console.log(data);
                        alert("Successfully Updated Post!");
                        location.reload();
                    },
                    error: function(data){
                        console.log('There Something Wrong With Code!');
                    }
                });
            }
        }
    });

});//end function





//Delete Post Jquery Ajax Function
$(document).on('click', '.delete-user-post', function(){
    var postid = $(this).data('postid');
    var postuserid = $(this).data('postuserid');
    var picname = $(this).data('picname');

    let text = "Are you Sure to Delete This Post?";
    if(confirm(text) == true){
        $.ajax({
            url: 'post-controller.php',
            method: 'post',
            cache: false,
            data:{'func':'deletepost', 'postid': postid, 'userid': postuserid, 'picname': picname},
            success: function(data){
                console.log(data);
                alert("Successfully Deleted Post!");
                location.reload();
            },
            error: function(data){
                console.log('There Something Wrong With Code!');
            }
        });

    }else{
        alert('Not Deleted')
    }

});



// Adding Comment on Post
$(document).on('click', '.comment-btn', function(){
    var postid = $(this).data('postid');
    var userid = $(this).data('userid');
    var commenttxt = $('#comment-body-'+postid).val();
    

    if(commenttxt !== ''){
        $.ajax({
            url: 'post-controller.php',
            method: 'post',
            cache: false,
            data:{'func':'savecomment', 'postid': postid, 'userid': userid, 'commenttxt' :commenttxt},
            success: function(data){
                console.log(data);
                alert("Successfully Added Comment!");
                $('#comment-body-'+postid).val('');
                 location.reload();
            },
            error: function(data){
                console.log('There Something Wrong With Code!');
            }
        });
    }

});

