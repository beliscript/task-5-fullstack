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
        setCookie('full_name', text.user.name, 20);
        $('.full_name').html(text.user.name);
       } else {

        window.location.href = "/";
       }
    }).catch(err =>{
        window.location.href = "/";
    });
}

const isLogout = () => {
    fetch(base_api+"logout",
    {   method: 'POST',
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
       if(text.status) {
        window.location.href = "/";
       } else {
        alert(text.message);
       }
    }).catch(err =>{
        alert(err);
    });
}