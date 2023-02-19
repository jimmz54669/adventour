

//View Users Profile
$(document).on('click','.user-direct-profile',function(){
    var userid = $(this).data('userid');

    $.ajax({
        url: 'viewprofile-controller.php',
        method: 'post',
        cache: false,
        data:{'func':'viewuserprof', 'userid': userid},
        success: function(data){
            console.log(data);
            window.location.href = "viewprofile.php?uid="+userid;
        },
        error: function(data){
            console.log('There Something Wrong With Code!');
        }
    });
});



//View Users Photos
$(document).on('click', '.user-direct-photos', function(){
    var userid = $(this).data('userid');
    $.ajax({
        url: 'viewprofile-controller.php',
        method: 'post',
        cache: false,
        data:{'func':'viewuserphotos', 'userid': userid},
        success: function(data){
            console.log(data);
            window.location.href = "viewphotos.php?uid="+userid;
        },
        error: function(data){
            console.log('There Something Wrong With Code!');
        }
    });
});
