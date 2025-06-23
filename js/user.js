

fetch("/api/users/profile.php").then(res=>{
    if(res.ok){
        return res.json()
    }else{
        if(res.status == 401)
        {alert("Not Allowed");
            if(data.result){
                window.location = "/index.html";
            }
        }
        else
        {alert("Error")}
    }
}).then((data)=>{
    if(data.result){
        init(data.data)
    }
})
var _user = null;
var handle = document.getElementById("edit_handle");

function init(user){
    _user= user;
    var id = document.getElementById("id");
    var email = document.getElementById("email");
    var username_content = document.querySelectorAll(".content-user-name");
    var userimg_content = document.querySelectorAll(".content-user-img");

    id.innerText = user.id;
    email.innerText = user.email;

    username_content.forEach(element => {
    element.innerHTML = user.fullname
    });

    userimg_content.forEach(element => {
    element.src = user.profile_img
    });
}

function edit_profile(){
    handle.classList.remove("hide")
}

function _close(){
    handle.classList.add("hide")
}
function save(){
    handle.classList.add("hide")
}