function check_pass(){
    let password = document.getElementById("password");
    let num = /(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/;
     if(!num.test(password.value)){
         window.alert("Invalid password");
         password.classList.add("invalid");
     }else{
         password.classList.remove("invalid");
     }
}

function check_email(){
    let email = document.getElementById("email");
    let em= /^\w+[\w-\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}$/;
    if(!em.test(email.value)){
        window.alert("Invalid email");
        email.classList.add("invalid");
    }else{
        email.classList.remove("invalid");
    }
        
}


function check_tell(){
    let telephone = document.getElementById("telephone");
    let tell= /^\d{3}-\d{3}-\d{4}$/;
    if(!tell.test(telephone.value)){
        window.alert("Invalid email");
        telephone.classList.add("invalid");
    }else{
        telephone.classList.remove("invalid");
    }
    
}