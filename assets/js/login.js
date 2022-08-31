$('#user-login').submit(function(e) {
    e.preventDefault();
    var data = $(this).serialize();
$.ajax({
    url:siteurl+'/UserManagement/login',
    data:data,
    method:'post',
    dataType:'json',
    success: function(result) {
        console.log(result);
        if (result['status'] == 'true') {
            $('input[name=name],input[name=password]').css('border-color','rgb(209, 211, 226)');
            location.href = siteurl+'/UserManagement/startsession?u='+result['username'];
        } 
        if (result['status'] == 'falso') {
            $('#wrong-pass').remove();
            $('input[name=name],input[name=password]').css({'border-color':'#a00000'});
            
        }
        
    }
});
});