
//UPLOADS Profile Picture Jquery AJAX Function
$(document).on('change', '#prof_pic_input', function(){
  
     // Checks if theres is empty file  input
     if(document.getElementById("prof_pic_input").files.length !== 0){
        var ProfPic = document.getElementById("prof_pic_input").files[0].name;
        var UserId = $(this).data('userid');
        var OldProfPic = $(this).data('oldprofpic');

        var form_data = new FormData();
        var ext = ProfPic.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)  
        {
        alert("Invalid Image File");
        }

        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("prof_pic_input").files[0]);
        var f = document.getElementById("prof_pic_input").files[0];
        var fsize = f.size||f.fileSize;

        if(fsize > 10000000)
        {
        alert("Image File Size is very big");
        }
        else
        {
            form_data.append("profpic", document.getElementById('prof_pic_input').files[0]);
            form_data.append("oldprofpic", OldProfPic);
            form_data.append("userid", UserId);
            form_data.append("func", 'saveprofpic');

                $.ajax({
                    url: 'post-controller.php',
                    method: 'post',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data:form_data,
                    enctype: 'multipart/form-data',
                    success: function(data){
                        console.log('Success');
                        alert("Successfully Posted!");
                        location.reload();
                    },
                    error: function(data){
                        console.log('There Something Wrong With Code!');
                    }
                });
            
        }
       
     }
});//End Function




// Save Cover Photo Jquery Ajax Function
$(document).on('change','#btn_cover_upload',function(){
   
    // Checks if theres is empty file  input
    if(document.getElementById("btn_cover_upload").files.length !== 0){
        var CoverPic = document.getElementById("btn_cover_upload").files[0].name;
        var OldCoverPic = $(this).data('oldcoverpic');
        var UserId = $(this).data('userid');

        var form_data = new FormData();
        var ext = CoverPic.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)  
        {
        alert("Invalid Image File");
        }

        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("btn_cover_upload").files[0]);
        var f = document.getElementById("btn_cover_upload").files[0];
        var fsize = f.size||f.fileSize;

        if(fsize > 10000000)
        {
        alert("Image File Size is very big");
        }
        else
        {
            form_data.append("coverpic", document.getElementById('btn_cover_upload').files[0]);
            form_data.append("oldpcoverpic", OldCoverPic);
            form_data.append("userid", UserId);
            form_data.append("func", 'savecoverpic');

                $.ajax({
                    url: 'post-controller.php',
                    method: 'post',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data:form_data,
                    enctype: 'multipart/form-data',
                    success: function(data){
                        console.log('Success');
                        alert("Successfully Posted!");
                        location.reload();
                    },
                    error: function(data){
                        console.log('There Something Wrong With Code!');
                    }
                });
            
        }
       
     }
});




// Update User Info AJAX jquery FirstName
$(document).on('click','.edit-firstname',function(){   
    $('#old-first-name').hide();
    $('#new-first-name-edit').removeAttr('hidden');

    $('#new-first-name-edit').on('keypress', function(e){
        var userid = $(this).data('userid');
        var newfname = $('#new-first-name-edit').val();
        if(e.which == 13){
            $.ajax({
                url: 'profile-class.php',
                method: 'post',
                cache: false,
                data:{'func': 'updatefname', 'userid': userid, 'newfname': newfname},
                success: function(data){
                    console.log('Success');
                    alert("Successfully Updated!");
                    location.reload();
                },
                error: function(data){
                    console.log('There Something Wrong With Code!');
                }
            });

        }
    });
    

});

// Update User Info AJAX jquery LastName
$(document).on('click','.edit-lastname',function(){   
    $('#old-last-name').hide();
    $('#new-last-name-edit').removeAttr('hidden');

    $('#new-last-name-edit').on('keypress', function(e){
        var userid = $(this).data('userid');
        var newlname = $('#new-last-name-edit').val();
        if(e.which == 13){
            $.ajax({
                url: 'profile-class.php',
                method: 'post',
                cache: false,
                data:{'func': 'updatelname', 'userid': userid, 'newlname': newlname},
                success: function(data){
                    console.log('Success');
                    alert("Successfully Updated!");
                    location.reload();
                },
                error: function(data){
                    console.log('There Something Wrong With Code!');
                }
            });

        }
    });
    

});

// Update User Info AJAX jquery PhoneNumber
$(document).on('click','.edit-phonenumber',function(){   
    $('#old-phone-number').hide();
    $('#new-phone-number-edit').removeAttr('hidden');

    $('#new-phone-number-edit').on('keypress', function(e){
        var userid = $(this).data('userid');
        var newphonenumber = $('#new-phone-number-edit').val();
        if(e.which == 13){
            $.ajax({
                url: 'profile-class.php',
                method: 'post',
                cache: false,
                data:{'func': 'updatephonenumber', 'userid': userid, 'newphonenumber': newphonenumber},
                success: function(data){
                    console.log('Success');
                    alert("Successfully Updated!");
                    location.reload();
                },
                error: function(data){
                    console.log('There Something Wrong With Code!');
                }
            });

        }
    });
    

});

// Update User Info AJAX jquery BirthDay
$(document).on('click','.edit-birthday',function(){   
    $('#old-birthday').hide();
    $('#new-birthday-edit').removeAttr('hidden');

    $('#new-birthday-edit').on('keypress', function(e){
        var userid = $(this).data('userid');
        var newbirthday = $('#new-birthday-edit').val();
        if(e.which == 13){
            $.ajax({
                url: 'profile-class.php',
                method: 'post',
                cache: false,
                data:{'func': 'updatebirthday', 'userid': userid, 'newbirthday': newbirthday},
                success: function(data){
                    console.log('Success');
                    alert("Successfully Updated!");
                    location.reload();
                },
                error: function(data){
                    console.log('There Something Wrong With Code!');
                }
            });

        }
    });
    

});