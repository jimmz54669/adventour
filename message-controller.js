
//Direct Message from User Profile
$(document).on('click', '.user-direct-message', function(){
    var from_userid = $(this).data('fromuserid');
    var to_userid = $(this).data('touserid');


    $.ajax({
        url: 'message-controller.php',
        method: 'post',
        cache: false,
        data:{'func':'directmessage', 'fromuserid': from_userid, 'touserid': to_userid},
        success: function(data){
            window.location.href = "messages.php?uid="+to_userid;
        },
        error: function(data){
            console.log('There Something Wrong With Code!');
        }
    });
});



//Sends Chat Message to User
$(document).on('click', '.chat-submit', function(){
    
    var from_userid = $(this).data('fromuserid');
    var to_userid = $(this).data('touserid');
    var chat_message = $('.user-text-chat').val();

    if(chat_message !== ''){
        // alert(from_userid+' - '+to_userid+' - '+chat_message);
        //Ajax function to Send Message
        
        $.ajax({
            url: 'message-controller.php',
            method: 'post',
            cache: false,
            data:{'func':'sendmessage', 'fromuserid': from_userid, 'touserid': to_userid, 'chat_message': chat_message},
            success: function(data){
                $('.user-text-chat').val('');
                window.location.href = "messages.php?uid="+to_userid;
            
            },
            error: function(data){
                console.log('There Something Wrong With Code!');
            }
        });

    }else{
        alert('Please Type a Message');
    }

    
});

