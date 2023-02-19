
$(document).on('keyup','.site-search',function(e){
    var keysearch =  $('.site-search').val();
    
     if(keysearch !== ''){
    //     if(e.which == 13){
    //         alert(keysearch);
            $.ajax({
                url: 'profile-class.php',
                method: 'GET',
                dataType:'json',
                data:{'func': 'sitesearch', 'keysearch': keysearch},
                success: function(data){
                    //console.log(data);
                    //returns dropdown search list
                    //ajax result displays on page
                    var rows = '';
                    var imgsearch = '';
                    rows = rows + '<ul class="searchlistview" style="list-style-type: none;">';
                    $.each(data, function(key, value){
                        if(value.searchimg !== null){
                            imgsearch = value.searchimg;
                        }else{
                            imgsearch = 'images/pp.png';
                        }
                        rows = rows + '<li style="background: gray; border:1px solid black; height:60px; padding:5px,5px,5px;"><a style=" text-decoration: none; color: lightgrey;" href="'+value.link+'"> <img class="post-pic" src="'+imgsearch+'"/>'+value.stringsearch+'</a></li>';
                    });
                    rows = rows + '</ul>';
                    $('#searchlist').html(rows);
                },
                error: function(data){
                    console.log('There Something Wrong With Code!');
                }
            });
    //     }
    }else{
        $('#searchlist').html('');
    }
});