if(getCookie('token')) {
    fetch(base_api+"user",
    {   method: 'GET',
        mode : 'same-origin',
        credentials: 'same-origin' ,
        headers : {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+getCookie('token'), 
        }
    })
    .then(function(response) {
       return response.json();
    }).then(function(text) {
       if(text.user) {
            window.location.href = base_url+"dashboard";
       }
    }).catch(err =>{
        console.log('Belum Login')
    });
}

$( "#isLogin" ).submit(function( event ) {
    jQuery('.alert-danger').hide();
    jQuery('.alert-danger').html('');
    event.preventDefault();

    const formData = new URLSearchParams(new FormData(this));
    fetch(base_api+"login",
    {   method: 'POST',
        mode : 'same-origin',
        credentials: 'same-origin' ,
        body : formData
    })
    .then(function(response) {
       if(response.status == 401) {
            jQuery('.alert-danger').show();
            jQuery('.alert-danger').append('<p>Username Atau Password Salah!</p>');
            return;
       } else {
            return response.json();
       }
    }).then(function(text) {
        if(text.token) {
            console.log(text.token);
            setCookie('token', text.token, 20);
            window.location.href = base_url+"dashboard";
        } else{
            jQuery.each(text.errors, function(key, value){
                jQuery('.alert-danger').show();
                jQuery('.alert-danger').append('<p>'+value+'</p>');
            });
        }
        
    }).catch(err =>{
        console.log(err)
    });
  });