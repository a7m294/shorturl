var pre_url = '';
$('#bnt_request_url').on('click', function(){
    var url = $('#request_url').val();
    if( url.length  < 1) {
        return false;
    }
    alert(url);
    alert(pre_url);
    if( pre_url  === url) {
        return false;
    }
    var _data = {
        'do':'make',
        'url':url
    };
    pre_url = url;
    $.ajax({
        type:'POST',
        url: '/index_do.php',
        async: true,
        data: _data,
        dataType:"json",
        beforeSend: function() {}
        , success:function(response, result) {
            if (response.code == '1') {
                $('#respone_url').val(decodeURIComponent(response.message))
            }
            else {
                alert(decodeURIComponent(response.message));
            }
        }
        , error: function(data, status, err) {alert("code:"+data.status+"\n"+"message:"+data.responseText+"\n"+"err:"+err);}
        , complete: function() {}
    });
});
